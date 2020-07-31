<?php

namespace Siravel\Http\Controllers\Admin\Travel;

use Siravel\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = \Siravel\Models\Room::all();

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rooms.create');
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
        $room = new \Siravel\Models\Room();

        $validation = Validator::make(Input::all(), \Siravel\Models\Room::rules());

        $room->name = $request->name;
        $room->code = $request->code;

        if ($validation->passes()) {
            $room->save();

            return redirect('rooms');
        }

        return Redirect::to('rooms.edit')
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
    public function edit($id)
    {
        $room = \Siravel\Models\Room::findOrfail($id);

        return view('admin.rooms.edit', compact('room'));
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
        $room = \Siravel\Models\Room::findOrfail($request->room_id);

        $validation = Validator::make(Input::all(), \Siravel\Models\Room::rules());

        $room->name = $request->name;
        $room->code = $request->code;

        if ($validation->passes()) {
            $room->save();

            return redirect('rooms');
        }

        return Redirect::to('rooms.edit')
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
    public function destroy($id)
    {
        $room = \Siravel\Models\Room::findOrfail($id);

        $room->delete();

        return redirect('rooms');
    }
}
