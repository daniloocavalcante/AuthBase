<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrivilegesTableSeeder extends Seeder{
   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('privileges')->insert([
            [
                'name' => 'administrador',
                'badge_color' => 'primary',
                'actions' => 'create user, show user, update user',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
            [
                'name' => 'usuario comum',
                'badge_color' => 'secondary',
                'actions' => 'show user,',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
        ]);
    }
    
}
