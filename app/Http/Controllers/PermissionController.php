<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $permissions = Permission::all();
        return view('backend.modules.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('backend.modules.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'for'=>'required'
          ]);
          $permission = new Permission;
          $permission->name = $request->name;
          $permission->for = $request->for;
          $permission->save();
          session()->flash('cls', 'success');
         session()->flash('msg', 'permission Created SuccessFully');
         return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permission = Permission::find($permission->id);
        
        return view('backend.modules.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'for'=>'required'
          ]);

          $permission = Permission::find($permission->id);
          $permission->name = $request->name;
          $permission->for = $request->for;
          $permission->save();
          session()->flash('cls', 'success');
         session()->flash('msg', 'Permission Updated SuccessFully');
         return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'Permission Deleted SuccessFully');
      return redirect()->route('permission.index');
    }
}
