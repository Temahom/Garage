<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            "name"=>"Mediapex",
            "email"=>"azizmohamet@gmail.com",
            "role_id"=>(1),
            "password"=>bcrypt(12345678)
        ]);

        \App\Models\User::create([
            "name"=>"Moussa",
            "email"=>"medounehild@gmail.com",
            "role_id"=>(2),
            "password"=>bcrypt(12345678)
        ]);

        \App\Models\User::create([
            "name"=>"Ndeye",
            "email"=>"amarymoustapha@gmail.com",
            "role_id"=>(3),
            "password"=>bcrypt(12345678)
        ]);

        \App\Models\Role::create([
            'id'=>(1),
            'role'=>'Admin'
        ]);
        \App\Models\Role::create([
            'id'=>(2),
            'role'=>'Raf'
        ]);
        \App\Models\Role::create([
            'id'=>(3),
            'role'=>'Manager'
        ]);
    }
}
