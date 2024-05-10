<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'nip'=>'1234',
                'name'=>'doni',
                'email'=>'doni@gmail.com',
                'jabatan'=>'direktur',
                'password'=>Hash::make('123456')
            ],
            
            [
                'nip'=>'1235',
                'name'=>'dono',
                'email'=>'dono@gmail.com',
                'jabatan'=>'finance',
                'password'=>Hash::make('123456')
            ],
            [
                'nip'=>'1236',
                'name'=>'dona',
                'email'=>'dona@gmail.com',
                'jabatan'=>'staff',
                'password'=>Hash::make('123456')
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}