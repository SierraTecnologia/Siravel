<?php

namespace Siravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Siravel\Models\User;
use Siravel\Models\Components\Code\Project;
use Siravel\Models\Components\Code\Issue;
use Siravel\Models\Identity\Business\Collaborator;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->mainDashboard();
    }


    public function mainDashboard()
    {
        $businesses = Business::count();
        $tokens = Token::count();
        $issues = Issue::count();

        $projects = Project::all();

        return view(
            'dashboards.home',
            compact(
                'businesses',
                'tokens',
                'projects',
                'issues'
            )
        );
    }

    public function businessDashboard($business)
    {
        $collaborators = Collaborator::count();
        $projects = Project::count();
        $libs = Lib::count();
        $issues = Issue::count();
        $sshKeys = User::count();

        return view(
            'dashboards.home',
            compact(
                'collaborators',
                'projects',
                'libs',
                'issues',
                'sshKeys'
            )
        );
    }
}
