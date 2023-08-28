<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.modules.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('backend.modules.users.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',


        ]);
        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        
   
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        //$user->syncRoles($request->roles);
        //$user->roles()->attach($request->input('roles'));
        $user->save();
        
        session()->flash('cls', 'error');
      session()->flash('msg', 'User Created SuccessFully');
        return redirect()->route('users.index');
         //$user_data = $request->all();
         //$user_data['user_id'] = Auth::id();
        // $user = User::create($user_data);
         //return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        $roles=Role::all();
        return view('backend.modules.users.edit',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email,'.$user->id,
            'password' => 'required|min:6',
            'roles' => 'required',

        ]);
        $user->update($request->all());

        //$user->name = $request->name;

        //$user->email = $request->email;

        
   
        //$user->password = bcrypt($request->password);
        $user->roles()->sync($request->input('roles'));
        //$user->save();
        session()->flash('cls', 'error');
      session()->flash('msg', 'User Updated SuccessFully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'User Deleted SuccessFully');
      return redirect()->route('users.index');
    }
}
