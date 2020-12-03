<?php

namespace Siravel\Http\Controllers\Admin\Travel;

use Siravel\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class TravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $travels = \Siravel\Models\Travel::all();

        return view('admin.travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $travel = new \Siravel\Models\Travel();

        $validation = Validator::make(Input::all(), \Siravel\Models\Travel::rules());

        $travel->destine = $request->destine;
        $travel->date_init = Carbon::createFromFormat('d/m/Y', $request->dateInit)->toDateString();
        $travel->date_end = Carbon::createFromFormat('d/m/Y', $request->dateEnd)->toDateString();
        $travel->adults = $request->adults;
        $travel->chieldren = $request->chieldren;
        $travel->rooms = $request->rooms;
        $travel->email = $request->email;

        if ($validation->passes()) {
            $travel->save();

            return redirect('travels');
        }

        return Redirect::to('travels.edit')
            ->withInput()
            ->withErrors($validation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $travel = \Siravel\Models\Travel::findOrfail($id);

        return view('admin.travels.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $travel = \Siravel\Models\Travel::findOrfail($request->travel_id);

        $validation = Validator::make(Input::all(), \Siravel\Models\Travel::rules());

        $travel->destine = $request->destine;
        $travel->date_init = Carbon::createFromFormat('d/m/Y', $request->dateInit)->toDateString();
        $travel->date_end = Carbon::createFromFormat('d/m/Y', $request->dateEnd)->toDateString();
        $travel->adults = $request->adults;
        $travel->chieldren = $request->chieldren;
        $travel->rooms = $request->rooms;
        $travel->email = $request->email;

        if ($validation->passes()) {
            $travel->save();

            return redirect('travels');
        }

        return Redirect::to('travels.edit')
            ->withInput()
            ->withErrors($validation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $travel = \Siravel\Models\Travel::findOrfail($id);

        $travel->delete();

        return redirect('travels');
    }
}
