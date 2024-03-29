<?php namespace Siravel\Http\Controllers\Writelabel;

use Siravel\Http\Controllers\Features\Girl\GirlController;
use App\Models\Model;
use App\Http\Requests\Admin\ModelRequest;
use DataTables as Datatables;
use Illuminate\Http\Request;


class ModelController extends Controller
{


    public function __construct()
    {
        view()->share('type', 'model');
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
        return view('features.house.model.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('features.house.model.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(ModelRequest $request): void
    {

        $model = new Model($request->except('password', 'password_confirmation'));
        $model->password = bcrypt($request->password);
        $model->confirmation_code = str_random(32);
        $model->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $model
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Model $model)
    {
        return view('features.house.model.create_edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $model
     *
     * @return void
     */
    public function update(ModelRequest $request, Model $model): void
    {
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $model->password = bcrypt($password);
            }
        }
        $model->update($request->except('password', 'password_confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $model
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Model $model)
    {
        return view('features.house.model.delete', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $model
     *
     * @return void
     */
    public function destroy(Model $model): void
    {
        $model->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $models = Model::select(array('models.id', 'models.name', 'models.email', 'models.confirmed', 'models.created_at'));

        return Datatables::of($models)
            ->editColumn('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->addColumn(
                'actions', '@if ($id!="1")<a href="{{{ url(\'girl/model/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("girl/modal.edit") }}</a>
                    <a href="{{{ url(\'girl/model/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("girl/modal.delete") }}</a>
                @endif'
            )
            ->removeColumn('id')
            ->make();
    }

}
