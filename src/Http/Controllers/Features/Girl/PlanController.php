<?php namespace Siravel\Http\Controllers\Features\Girl;

use Siravel\Http\Controllers\Features\Girl\GirlController;
use App\Models\Plan;
use App\Http\Requests\Admin\PlanRequest;
use DataTables as Datatables;
use Illuminate\Http\Request;


class PlanController extends GirlController
{


    public function __construct()
    {
        view()->share('type', 'plan');
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
        return view('features.girl.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('features.girl.plan.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(PlanRequest $request): void
    {

        $plan = new Plan($request->except('password', 'password_confirmation'));
        $plan->password = bcrypt($request->password);
        $plan->confirmation_code = str_random(32);
        $plan->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $plan
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Plan $plan)
    {
        return view('features.girl.plan.create_edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $plan
     *
     * @return void
     */
    public function update(PlanRequest $request, Plan $plan): void
    {
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $plan->password = bcrypt($password);
            }
        }
        $plan->update($request->except('password', 'password_confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $plan
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Plan $plan)
    {
        return view('features.girl.plan.delete', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $plan
     *
     * @return void
     */
    public function destroy(Plan $plan): void
    {
        $plan->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $plans = Plan::select(array('plans.id', 'plans.name', 'plans.email', 'plans.confirmed', 'plans.created_at'));

        return Datatables::of($plans)
            ->editColumn('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->addColumn(
                'actions', '@if ($id!="1")<a href="{{{ url(\'girl/plan/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("girl/modal.edit") }}</a>
                    <a href="{{{ url(\'girl/plan/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("girl/modal.delete") }}</a>
                @endif'
            )
            ->removeColumn('id')
            ->make();
    }

}
