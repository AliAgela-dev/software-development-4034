<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manager::create([
            'name' => 'Test Manager',
            'username' => 'testmanager',
            'phone_number' => '1234567890',
            'password' => Hash::make('password'),
            'schoolID' => 1,
        ]);
    }
}
