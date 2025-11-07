<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schools_teachers')->insert([
            'schoolID' => 1,
            'teacherID' => 1,
            'gradeID' => 1,
            'year' => rand(2020, 2024),
        ]);
    }
}
