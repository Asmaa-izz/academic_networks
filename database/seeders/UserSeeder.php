<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'D.Haithem@gmail.com'], [
            'name' => 'Haithem mezni',
            'email' => 'D.Haithem@gmail.com',
            'avatar' => 'avatar/1.jpeg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('doctor');

        User::firstOrCreate(['email' => 'RAYAN@gmail.com'], [
            'name' => ' RAYAN ABDULMOEN ALMUGHAZWI',
            'email' => 'RAYAN@gmail.com',
            'avatar' => 'avatar/2.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'JAWAD@gmail.com'], [
            'name' => 'JAWAD TALAL Al-Juhani',
            'email' => 'JAWAD@gmail.com',
            'avatar' => 'avatar/3.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'Ghassan@gmail.com'], [
            'name' => 'Ghassan Al-Ahmadi',
            'email' => 'Ghassan@gmail.com',
            'avatar' => 'avatar/4.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'Ibrahim@gmail.com'], [
            'name' => 'Ibrahim Muhammad Al-Harbi',
            'email' => 'Ibrahim@gmail.com',
            'avatar' => 'avatar/5.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');



        User::firstOrCreate(['email' => 'mohamed@gmail.com'], [
            'name' => 'Mohamed',
            'email' => 'mohamed@gmail.com',
            'avatar' => 'avatar/6.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'khaled.nasser@gmail.com'], [
            'name' => 'khaled',
            'email' => 'khaled.nasser@gmail.com',
            'avatar' => 'avatar/7.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'rashid@gmail.com'], [
            'name' => 'rashid',
            'email' => 'amal.rashid@gmail.com',
            'avatar' => 'avatar/8.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'youssef.farid@gmail.com'], [
            'name' => 'youssef',
            'email' => 'youssef.farid@gmail.com',
            'avatar' => 'avatar/9.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'mostafa@gmail.com'], [
            'name' => 'mostafa',
            'email' => 'hassan.mostafa@gmail.com',
            'avatar' => 'avatar/10.png',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');
    }
}
