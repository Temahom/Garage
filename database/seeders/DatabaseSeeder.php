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
            "email"=>"fatoubibi96@gmail.com",
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
            "name"=>"Amary",
            "email"=>"abdouazizmoustapha@gmail.com",
            "role_id"=>(3),
            "password"=>bcrypt(12345678)
        ]);

        \App\Models\Role::create([
            'id'=>(1),
            'role'=>'admin'
        ]);
        \App\Models\Role::create([
            'id'=>(2),
            'role'=>'raf'
        ]);
        \App\Models\Role::create([
            'id'=>(3),
            'role'=>'manager'
        ]);
    }
}
