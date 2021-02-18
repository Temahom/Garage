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
            "name"=>"Mohamet_mediapex",
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
        /**
         * Seeder pour les voitures
         */
        include('VoitureSeed.php');
        /**
         * Seeder pour le poduits 
         */
        include('ProduitSeed.php');
        /**
         * Seeder pour les Codes d'erreur 
         */
        include('ErreurSeed.php');
 }
}
