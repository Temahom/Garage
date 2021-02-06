<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = User::orderBy('created_at','DESC')->paginate(3);
        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role, User $user)
    {
        $roles= Role::all();
        return view('actors.create',compact('roles', 'role', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= request()->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
          ]);
          $password=['password'=>bcrypt(12345678)];
          $data = array_merge($data, $password);
           $actor = User::create($data);
           return redirect()->route('actors.show', ['actor' => $actor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::find($id);
        return view('actors.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles= Role::all();
        $user= User::find($id);
        return view('actors.edit', compact('user', 'roles'));
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
        $actor= User::find($id);
        $data= request()->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
          ]);
          $password=['password'=>bcrypt(12345678)];
          $data = array_merge($data, $password);
         $actor->update($data);
         return redirect ('/actors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
