<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public $title = 'permissions';

    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        if(!Auth::user()->can('permission:view')){
            abort(403, 'Forbidden!');
        }

        $items = Permission::get();

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

        if(!Auth::user()->can('permission:add')){
            abort(403, 'Forbidden!');
        }
       
        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'add');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!Auth::user()->can('permission:add')){
            abort(403, 'Forbidden!');
        }

        $item = new Permission();
        $item->name = $request->name;
        $item->save();

        return redirect('/permissions');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        if(!Auth::user()->can('permission:update')){
            abort(403, 'Forbidden!');
        }

        $item = Permission::find($id);
        

        return view(strtolower($this->title).'.add_edit')
            ->with('action', 'edit')
            ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if(!Auth::user()->can('permission:update')){
            abort(403, 'Forbidden!');
        }

        $permission = Permission::find($id);
        $permission->name = $request->name;


        $permission->save();

        return redirect('/permissions');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        if(!Auth::user()->can('permission:delete')){
            abort(403, 'Forbidden!');
        }

        $permission = Permission::find($id)->delete();

        return redirect('/permissions');


    }
}
