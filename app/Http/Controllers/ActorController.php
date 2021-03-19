<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Intervention;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
       // $this->authorize('create', User::class);
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
            'email'=>'required|unique:users',
            'role_id'=>'required',
            'image' => 'sometimes|required|max:5000',
          ]);
          $password=bcrypt(12345678);
          $name =  $request->input('name');
          $email = $request->input('email');
          $role_id = $request->input('role_id');
          $image = $request->file('image');
          if(!empty($image))
         { 
          $imageName = time().'.'.$image->extension();
          $image->move(public_path('images'),$imageName);
         }
         else $imageName =null;

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
        $interventions_manager = $user->interventions()->paginate(15);
        // dd($interventions_manager );
        $interventions_technicien = Intervention::where('technicien','=',$id)->paginate(15);
        // dd($interventions_technicien);
        $role = Role::find($user->role_id);
        return view('actors.show',compact('user', 'interventions_manager', 'interventions_technicien', 'role'));
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
        $user= User::find($id);
        
        $data= request()->validate([
            'name'=>'required',
            'email'=>['required', Rule::unique('users')->ignore($user->id)],
            'role_id'=>'required',
          ]);
          $password=bcrypt(12345678);
          $name =  $request->input('name');
          $email = $request->input('email');
          $role_id = $request->input('role_id');
        //   $image = $request->file('image');
        //   if(!empty($image))
        //  { 
        //   $imageName = time().'.'.$image->extension();
        //   $image->move(public_path('images'),$imageName);
        //  }
        //  else $imageName =null;

          
          $user->name = $name;
          $user->email = $email;
          $user->role_id = $role_id;
          $user->password = $password;
        //   $user->image = $imageName;
          $user->save();
          return redirect(route('actors.index'));
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
