<?php
/**
 * 
 */

namespace SiInteractions\Actions\Worker\Sync;

use App\Logic\Tools\Databases\Mysql\Mysql as MysqlTool;
use Siravel\Models\Digital\Infra\Token;
use Siravel\Models\Digital\Infra\SshKey;
use App\Logic\Tools\Programs\Git\Admin as GitManiputor;
use Siravel\Models\Digital\Code\Project as ProjectModel;
class Project
{

    protected $project = false;

    public function __construct(ProjectModel $project)
    {
        $this->project = $project;
    }

    public function execute()
    {
        // $this->project;

        SshKey::defaultById(4);

        if (!$this->project->repositoryIsCloned()){
            $repository = GitManiputor::cloneTo($this->project->getRepositoryPath(), $this->project->getRepository());
            dd($repository);
        }
        $repository = GitManiputor::init($this->project->getRepositoryPath());
    }
}
