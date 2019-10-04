<?php

namespace SiWeapons\Integrations\Jira;

use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Models\Code\CodeIssueLink;
use App\Models\Calendar\Spent;
use App\Models\Calendar\Estimate;
use App\Models\Calendar\Event;

use App\Models\Code\Release;
use App\Models\Code\Issue;
use App\Models\Code\Field as FieldModel;
use App\Models\Code\Project as ProjectModel;

use JiraRestApi\Project\ProjectService;
use JiraRestApi\JiraException;
use JiraRestApi\Field\Field;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\Version;
use JiraRestApi\Field\FieldService;


class Import extends Jira
{
    public function bundle($command = false)
    {
        Log::info('Importando Jira...');
        $this->getFields($command);
        $this->getProjects($command);
        $this->getInfoFromIssues($command);
    }

    public function getProjects($command = false)
    {
        Log::info('Importando Projetos do Jira...');
        try {
            $proj = new ProjectService($this->getConfig($this->_token));
        
            $prjs = $proj->getAllProjects();
            Log::info(print_r($prjs, true));
        
            foreach ($prjs as $p) {
                Log::info(print_r($p, true));
                // Project Key:USS, Id:10021, Name:User Shipping Service, projectCategory: Desenvolvimento
                if (!$projModel = ProjectModel::where('slug', $p->key)->first()){
                    $projModel = ProjectModel::create([
                        'name' => $p->name,
                        'slug' => $p->key,
                    ]);
                }
                $this->projectVersions($projModel);

                $this->getIssuesFromProject($projModel);
                // echo sprintf("Project Key:%s, Id:%s, Name:%s, projectCategory: %s\n",
                //     $p->key, $p->id, $p->name, $p->projectCategory['name']
                // );			
            }			
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }

    public function getInfoFromIssues($command = false)
    {
        $chunkNumber = 10;
        $object = $this;
        // Trata os Outros Dados dos Usuários                                                                                                                                                    
        Issue::chunk($chunkNumber, function($issues) use ($command, $object, $chunkNumber) {                                                                                                                               
            foreach ($issues as $issue) {                                                                                                                                                          
                if ($command) {                                                                                                                                                                  
                    $command->returnOutput()->progressAdvance($chunkNumber);                                                                                                                                 
                }
                $object->issueTimeTracking($issue->key_name);
                $object->issueWorklog($issue->key_name);
                $object->comment($issue->key_name);
                $object->getIssueRemoteLink($issue->key_name);
            }
        });
    }

    public function getIssuesFromProject($project)
    {
        // $jql = 'status = Documentação ORDER BY created DESC';
        // $jql = 'project IN ('.$project->getSlug().')';
        $jql = 'project='.$project->getSlug();
        $paginate = $this->getPaginate(1);
        $result = $this->searchIssue($jql, $paginate);
        if (!empty($result->issues)){
            foreach ($result->issues as $issue) {
                if (!Issue::where(['key_name' => $issue->key])->first()) {       
                    Issue::create([
                        'key_name' => $issue->key,
                        'url' => $issue->self,
                    ]);
                    if (!empty($issue->fields)){
                        foreach($issue->fields as $field) {
                            var_dump($field);
                        }
                    }
                }
            }
        }
    }

    public function searchIssue($jql = false, $paginate = false)
    {
        if (!$jql) {
            $jql = 'project not in (TEST)  and assignee = currentUser() and status in (Resolved, closed)';
        }

        // $jql = str_replace(" ", "%20", $jql);
        $jql = str_replace(" ", "+", $jql);
        $jql = str_replace(" ", "\\u002f", $jql);

        try {
            return (new IssueService($this->getConfig($this->_token)))->search($jql); //, $paginate);
            // return (new IssueService($this->getConfig($this->_token)))->search($jql);
        } catch (JiraException $e) {
            $this->setError('testSearch Failed : '.$e->getMessage());
        }
    }

    public function project($project)
    {
        Log::info('Importando Projeto do Jira...');
        try {
            $proj = new ProjectService($this->getConfig($this->_token));
        
            $p = $proj->get($project->getSlug());
            
            var_dump($p);			
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }

    public function issueTimeTracking($issueKey = 'TEST-961'){

        try {
            $issueService = new IssueService($this->getConfig($this->_token));
            
            // get issue's time tracking info
            $rets = $issueService->getTimeTracking($issueKey);
            if (!empty($rets)){
                foreach ($rets as $ret) {
                    var_dump($ret);
                    Spent::firstOrCreate([
                        'name' => $ret->name
                    ]);
                }
            }
            
            // $timeTracking = new TimeTracking;

            // $timeTracking->setOriginalEstimate('3w 4d 6h');
            // $timeTracking->setRemainingEstimate('1w 2d 3h');
            
            // // add time tracking
            // $ret = $issueService->timeTracking($issueKey, $timeTracking);
            // var_dump($ret);
        } catch (JiraException $e) {
            $this->setError('testSearch Failed : '.$e->getMessage());
        }
    }

    public function issueWorklog($issueKey = 'TEST-961'){

        try {
            $issueService = new IssueService($this->getConfig($this->_token));
            
            // get issue's all worklog
            $worklogs = $issueService->getWorklog($issueKey)->getWorklogs();
            if (!empty($worklogs)) {
                foreach ($worklogs as $worklog) {
                    var_dump($worklog);
                    Spent::firstOrCreate([
                        'name' => $worklog->name
                    ]);
                }
            }
            
            // // get worklog by id
            // $wlId = 12345;
            // $wl = $issueService->getWorklogById($issueKey, $wlId);
            // var_dump($wl);
            
        } catch (JiraException $e) {
            $this->setError('testSearch Failed : '.$e->getMessage());
        }
    }

    public function issueLinkType()
    {
        try {
            $ils = new IssueLinkService($this->getConfig($this->_token));
        
            $rets = $ils->getIssueLinkTypes();
            foreach($rets as $ret) {
                var_dump($ret);
                CodeIssueLink::firstOrCreate([
                    'name' => $ret->name
                ]);
            }
            
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }

    public function getIssueRemoteLink($issueKey = 'TEST-316')
    {
        try {
            $issueService = new IssueService($this->getConfig($this->_token));

            $rils = $issueService->getRemoteIssueLink($issueKey);
            foreach($rils as $ril) {
                var_dump($ril);
                CodeIssueLink::firstOrCreate([
                    'name' => $ril->name
                ]);
            }
        } catch (JiraException $e) {
            $this->setError($e->getMessage());
        }
    }

    public function getFields($command = false)
    {
        try {
            $fieldService = new FieldService($this->getConfig($this->_token));
        
            // return custom field only. 
            $fields = $fieldService->getAllFields(Field::CUSTOM); 
            foreach($fields as $field) {
                FieldModel::firstOrCreate([
                    'name' => $field->name
                ]);
            }
            
        } catch (JiraException $e) {
            $this->setError('testSearch Failed : '.$e->getMessage());
        }
    }

    public function comment($issueKey = "TEST-879")
    {

        try {
            $issueService = new IssueService($this->getConfig($this->_token));
        
            $comments = $issueService->getComments($issueKey);
            foreach($comments as $comment) {
                var_dump($comment);
                Coment::firstOrCreate([
                    'name' => $comment->name
                ]);
            }
        
        
        } catch (JiraException $e) {
            $this->setError('get Comment Failed : '.$e->getMessage());
        }
    }

    public function getFieldInfo($issueKey = "TEST-879")
    {
        try {
            $issueService = new IssueService($this->getConfig($this->_token));
            
            $queryParam = [
                'fields' => [  // default: '*all'
                    'summary',
                    'comment',
                ],
                'expand' => [
                    'renderedFields',
                    'names',
                    'schema',
                    'transitions',
                    'operations',
                    'editmeta',
                    'changelog',
                ]
            ];
                    
            $issue = $issueService->get($issueKey, $queryParam);
            
            var_dump($issue->fields);	
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }

    public function projectVersions($projInstance)
    {
        try {
            $proj = new ProjectService($this->getConfig($this->_token));
        
            $vers = $proj->getVersions($projInstance->getSlug());
        
            foreach ($vers as $v) {
                // $v is  JiraRestApi\Issue\Version
                if (!Release::where([
                        'name' => $v->name,
                        'code_project_id' => $projInstance->id
                    ])->first()){
                    Release::create([
                        'name' => $v->name,
                        // 'start' => $v->startDate,
                        'release' => $v->releaseDate,
                        'code_project_id' => $projInstance->id
                    ]);
                }
            }
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }

    public function projectType()
    {
        try {
            $proj = new ProjectService($this->getConfig($this->_token));
        
            // get all project type
            $prjtyps = $proj->getProjectTypes();
        
            foreach ($prjtyps as $pt) {
                var_dump($pt);
            }
        
            // get specific project type.
            $pt = $proj->getProjectType('software');
            var_dump($pt);
        
        } catch (JiraException $e) {
            $this->setError("Error Occured! " . $e->getMessage());
        }
    }
}
