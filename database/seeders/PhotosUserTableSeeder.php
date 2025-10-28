<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhotosUserTableSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('photos_users')->insert([
            [
                'filename' => 'dafault.jpeg',
                'mime_type' => 'image/jpeg',
                'path' => 'storage/photos_users/default.jpeg',
                'size' => 16265,
                'uploader_user_id' => 1,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
        ]);
    }
    
}
