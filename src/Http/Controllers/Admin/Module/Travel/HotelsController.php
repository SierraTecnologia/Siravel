<?php

namespace Siravel\Http\Controllers\Admin\Travel;

use Siravel\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Siravel\Http\Controllers\Admin\Controller as BaseController;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotels = \Siravel\Models\Hotel::all();

        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.create');
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
        $hotel = new \Siravel\Models\Hotel();

        $validation = Validator::make(Input::all(), \Siravel\Models\Hotel::rules());

        $hotel->name = $request->name;
        $hotel->code = $request->code;


        if ($validation->passes()) {
            $hotel->save();

            return redirect('hotels');
        }

        return Redirect::to('hotels.edit')
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
        $hotel = \Siravel\Models\Hotel::findOrfail($id);

        return view('admin.hotels.edit', compact('hotel'));
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
        $hotel = \Siravel\Models\Hotel::findOrfail($request->hotel_id);

        $validation = Validator::make(Input::all(), \Siravel\Models\Hotel::rules());

        $hotel->name = $request->name;
        $hotel->code = $request->code;

        if ($validation->passes()) {
            $hotel->save();

            return redirect('hotels');
        }

        return Redirect::to('hotels.edit')
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
        $hotel = \Siravel\Models\Hotel::findOrfail($id);

        $hotel->delete();

        return redirect('hotels');
    }
}
