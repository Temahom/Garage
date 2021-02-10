<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Auth;
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
        $actors = User::orderBy('created_at','DESC')->paginate(10);
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
            'image' => 'sometimes|required|max:5000',
          ]);
          $password=bcrypt(12345678);
          $name =  $request->input('name');
          $email = $request->input('email');
          $role_id = $request->input('role_id');
          $image = $request->file('image');
          $imageName = time().'.'.$image->extension();
          $image->move(public_path('images'),$imageName);

          $user = new User();
          $user->name = $name;
          $user->email = $email;
          $user->role_id = $role_id;
          $user->password = $password;
          $user->image = $imageName;
          $user->save();
          return redirect()->route('actors.show', ['actor' => $user]);
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
        $interventions = $user->interventions()->paginate(3);
        return view('actors.show',compact('user','interventions'));
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
        
        $data= request()->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'image' => 'sometimes|required|max:5000'
          ]);
          $password=bcrypt(12345678);
          $name =  $request->input('name');
          $email = $request->input('email');
          $role_id = $request->input('role_id');
          $image = $request->file('image');
          $imageName = time().'.'.$image->extension();
          $image->move(public_path('images'),$imageName);

          $user= User::find($id);
          $user->name = $name;
          $user->email = $email;
          $user->role_id = $role_id;
          $user->password = $password;
          $user->image = $imageName;
          $user->save();
          return back();
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
