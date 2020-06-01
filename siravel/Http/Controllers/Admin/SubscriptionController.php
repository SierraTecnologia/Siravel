<?php

namespace Siravel\Http\Controllers\Admin;

use Siravel\Http\ControllersController;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = \Siravel\Models\Subscription::all();

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscriptions.create');
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
        $subscription = new \Siravel\Models\Subscription();

        $subscription->email = $request->email;
        $subscription->name = $request->name;
        $subscription->password = Hash::make($request->password);

        $subscription->save();

        return redirect('subscriptions');
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
        $subscription = \Siravel\Models\Subscription::findOrfail($id);
        $roles = Role::all()->pluck('name');
        $permissions = Permission::all()->pluck('name');
        $subscriptionRoles = $subscription->roles;
        $subscriptionPermissions = $subscription->permissions;

        return view('admin.subscriptions.edit', compact('subscription', 'roles', 'permissions', 'subscriptionRoles', 'subscriptionPermissions'));
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
        $subscription = \Siravel\Models\Subscription::findOrfail($request->subscription_id);

        $subscription->email = $request->email;
        $subscription->name = $request->name;
        $subscription->password = Hash::make($request->password);

        $subscription->save();

        return redirect('subscriptions');
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
        $subscription = \Siravel\Models\Subscription::findOrfail($id);

        $subscription->delete();

        return redirect('subscriptions');
    }

    /**
     * Assign Role to subscription.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        $subscription = \Siravel\Models\Subscription::findOrfail($request->subscription_id);
        $subscription->assignRole($request->role_name);

        return redirect('subscriptions/edit/'.$request->subscription_id);
    }

    /**
     * Assign Permission to a subscription.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function addPermission(Request $request)
    {
        $subscription = \Siravel\Models\Subscription::findorfail($request->subscription_id);
        $subscription->givePermissionTo($request->permission_name);

        return redirect('subscriptions/edit/'.$request->subscription_id);
    }

    /**
     * revoke Permission to a subscription.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function revokePermission($permission, $subscription_id)
    {
        $subscription = \Siravel\Models\Subscription::findorfail($subscription_id);

        $subscription->revokePermissionTo(str_slug($permission, ' '));

        return redirect('subscriptions/edit/'.$subscription_id);
    }

    /**
     * revoke Role to a a subscription.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function revokeRole($role, $subscription_id)
    {
        $subscription = \Siravel\Models\Subscription::findorfail($subscription_id);

        $subscription->removeRole(str_slug($role, ' '));

        return redirect('subscriptions/edit/'.$subscription_id);
    }
}
