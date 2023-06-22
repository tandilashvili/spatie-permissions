<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public $title = 'users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Auth::user()->can('user:view')){
            abort(403, 'Forbidden!');
        }

        $users = User::get();

        return view(strtolower($this->title).'.view')
            ->with('users', $users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!Auth::user()->can('user:add')){
            abort(403, 'Forbidden!');
        }

        $roles = Role::orderBy('name', 'ASC')->get();

        $permissions = Permission::orderBy('name', 'ASC')->get();

        $roleIds = [];
        
        
        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'add')
            ->with('roles', $roles)
            ->with('roleIds', $roleIds)
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!Auth::user()->can('user:add')){
            abort(403, 'Forbidden!');
        }

        $roles = [];

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $role_ids = $request->role_ids;

        foreach ($role_ids as $role_id) {

            $role = Role::find($role_id);

            array_push($roles, $role);

        }

        $user->syncRoles($roles);

        $user->save();

        return redirect('/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->can('user:update')){
            abort(403, 'Forbidden!');
        }

        $roles = Role::orderBy('name', 'ASC')->get();

        $permissions = Permission::orderBy('name', 'ASC')->get();

        $item = User::find($id);

        
        $roleIds = $item->roles->pluck('id')->toArray();

     
        
        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'edit')
            ->with('roles', $roles)
            ->with('item', $item)
            ->with('roleIds', $roleIds)
            ->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('user:update')){
            abort(403, 'Forbidden!');
        }

        $roles = [];

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $role_ids = $request->role_ids;

        foreach ($role_ids as $role_id) {

            $role = Role::find($role_id);

            array_push($roles, $role);

        }

        $user->syncRoles($roles);

        $user->save();

        return redirect('/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('user:delete')){
            abort(403, 'Forbidden!');
        }

        $user = User::find($id)->delete();

        
    }

    
}
