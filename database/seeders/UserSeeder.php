<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => "Dhenna Mae Alferez",
            'level' => 'superuser',
            'email' => 'dhennamaealferez@gmail.com',
            'email_verified_at' => Carbon::now(),
            'username' => 'dhenna',
            'password' => Hash::make('dhenna123'),
            'profile_photo_path' => 'https://ui-avatars.com/api/?name='.'Dhenna Mae Alferez'.'&color=7F9CF5&background=EBF4FF',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
