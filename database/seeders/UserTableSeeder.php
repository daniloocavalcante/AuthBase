<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Danilo',
                'surname' => 'Cavalcante',
                'birth' => '2000-08-15',
                'gender' => 'Masculino',
                'email' => 'danilo.cs10@icloud.com',
                'password' => Hash::make('danilo123'),
                'photo_id' => 1,
                'privilege_id' => 1,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
            [
                'name' => 'Danilo',
                'surname' => 'Silva',
                'birth' => '2000-08-15',
                'gender' => 'Masculino',
                'email' => 'danilo.cs10@gmail.com',
                'password' => Hash::make('danilo123'),
                'photo_id' => 1,
                'privilege_id' => 2,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
        ]);
    }
}
