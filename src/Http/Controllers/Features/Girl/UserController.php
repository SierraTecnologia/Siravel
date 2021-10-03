<?php namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\Girl\GirlController;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use DataTables as Datatables;
use Illuminate\Http\Request;


class UserController extends GirlController
{


    public function __construct()
    {
        view()->share('type', 'user');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Show the page
        return view('features.girl.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('features.girl.user.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(UserRequest $request): void
    {

        $user = new User($request->except('password', 'password_confirmation'));
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('features.girl.user.create_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     *
     * @return void
     */
    public function update(UserRequest $request, User $user): void
    {
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->update($request->except('password', 'password_confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(User $user)
    {
        return view('features.girl.user.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     *
     * @return void
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $users = User::select(array('users.id', 'users.name', 'users.email', 'users.confirmed', 'users.created_at'));

        return Datatables::of($users)
            ->editColumn('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->addColumn(
                'actions', '@if ($id!="1")<a href="{{{ url(\'girl/user/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("girl/modal.edit") }}</a>
                    <a href="{{{ url(\'girl/user/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("girl/modal.delete") }}</a>
                @endif'
            )
            ->removeColumn('id')
            ->make();
    }

}
