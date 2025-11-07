<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'name' => 'Test School',
            'address' => '123 Test St',
            'status' => 'active',
            'type' => 'male',
            'level' => 'primary',
        ]);
    }
}
