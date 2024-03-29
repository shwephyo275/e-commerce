<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Mg Mg",
            'email' => 'mgmg@a.com',
            'password' => Hash::make('password'),
            'phone' => '0989',
            'delivery_address' => 'address'
        ]);
        User::create([
            'name' => "Aye Aye",
            'email' => 'ayeaye@a.com',
            'password' => Hash::make('password'),
            'phone' => '0989',
            'delivery_address' => 'address'
        ]);
        Admin::create([
            'name' => "Admin",
            'email' => 'admin@a.com',
            'password' => Hash::make('password'),
        ]);
    }
}
