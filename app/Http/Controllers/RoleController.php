<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
    */

    public $title = 'roles';


    public function index()
    {
        if(!Auth::user()->can('role:view')){
            abort(403, 'Forbidden!');
        }

        $items = Role::get();

        return view(strtolower($this->title).'.view')
            ->with('items', $items);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!Auth::user()->can('role:add')){
            abort(403, 'Forbidden!');
        }

        $roles = Role::orderBy('name', 'ASC')->get();

        $permissions = Permission::orderBy('name', 'ASC')->get();
        
        
        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'add')
            ->with('roles', $roles)
            ->with('permissions', $permissions);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('role:add')){
            abort(403, 'Forbidden!');
        }

        $permissions = Permission::whereIn('name', $request->permissions)->get();
        

        $role = Role::findOrCreate($request->name);

        $role->syncPermissions($permissions);

        $role->save();

        return redirect('/roles');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        if(!Auth::user()->can('role:update')){
            abort(403, 'Forbidden!');
        }

        $permissions = Permission::orderBy('name', 'ASC')->get();
        $item = Role::find($id);
        
        $user_permission_ids = $item->permissions->pluck('id')->toArray();

        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'edit')
            ->with('permissions', $permissions)
            ->with('user_permission_ids', $user_permission_ids)
            ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::user()->can('role:update')){
            abort(403, 'Forbidden!');
        }

        $permissions = Permission::whereIn('name', $request->permissions)->get();

        $role = Role::find($id);

        $role->syncPermissions($permissions);
        
        $role->name = $request->name;

        $role->save();

        return redirect('/roles');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        if(!Auth::user()->can('role:delete')){
            abort(403, 'Forbidden!');
        }

        $role = Role::find($id)->delete();

        return redirect('/roles');


        
    }
}
