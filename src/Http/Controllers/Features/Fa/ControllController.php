<?php

/**
 * Bdsm
 */

namespace Siravel\Http\Controllers\Features\Fa;

use Illuminate\Http\Request;

class ControllController extends Controller
{

    public function index(Request $request)
    {
        // Captura Pontos do Controll
        $points = Article::paginate(5);
        $points->setPath('points/');

        return view('features.fa.index', compact('points'));
    }
    public function points()
    {
        // Captura Pontos do Controll
        $points = Point::paginate(5);
        $points->setPath('points/');

        return view('features.fa.points', compact('points'));
    }

    public function tasks()
    {
        // Captura Pontos do Controll
        $tasks = Task::paginate(5);
        $tasks->setPath('tasks/');

        return view('features.fa.tasks', compact('tasks'));
    }

}
