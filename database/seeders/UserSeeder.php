<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'ali.hassan@gmail.com'], [
            'name' => 'علي حسن',
            'email' => 'ali.hassan@gmail.com',
            'avatar' => 'assets/media/avatars/300-1.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('doctor');

        User::firstOrCreate(['email' => 'sara.mohamed@gmail.com'], [
            'name' => 'سارة محمد',
            'email' => 'sara.mohamed@gmail.com',
            'avatar' => 'assets/media/avatars/300-2.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'ahmed.ali@gmail.com'], [
            'name' => 'أحمد علي',
            'email' => 'ahmed.ali@gmail.com',
            'avatar' => 'assets/media/avatars/300-3.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'reem.khalid@gmail.com'], [
            'name' => 'ريم خالد',
            'email' => 'reem.khalid@gmail.com',
            'avatar' => 'assets/media/avatars/300-4.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'omar.saad@gmail.com'], [
            'name' => 'عمر سعد',
            'email' => 'omar.saad@gmail.com',
            'avatar' => 'assets/media/avatars/300-5.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'laila.ahmed@gmail.com'], [
            'name' => 'ليلى أحمد',
            'email' => 'laila.ahmed@gmail.com',
            'avatar' => 'assets/media/avatars/300-6.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'khaled.nasser@gmail.com'], [
            'name' => 'خالد ناصر',
            'email' => 'khaled.nasser@gmail.com',
            'avatar' => 'assets/media/avatars/300-7.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'amal.rashid@gmail.com'], [
            'name' => 'أمل رشيد',
            'email' => 'amal.rashid@gmail.com',
            'avatar' => 'assets/media/avatars/300-8.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'youssef.farid@gmail.com'], [
            'name' => 'يوسف فريد',
            'email' => 'youssef.farid@gmail.com',
            'avatar' => 'assets/media/avatars/300-9.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');

        User::firstOrCreate(['email' => 'hassan.mostafa@gmail.com'], [
            'name' => 'حسن مصطفى',
            'email' => 'hassan.mostafa@gmail.com',
            'avatar' => 'assets/media/avatars/300-11.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
        ])->assignRole('student');
    }
}
