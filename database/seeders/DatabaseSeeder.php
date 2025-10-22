<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SchoolSeeder::class,
            ManagerSeeder::class,
            GradeSeeder::class,
            TeacherSeeder::class,
            FeeSeeder::class,
            UserSeeder::class,
            RatingSeeder::class,
            CommentSeeder::class,
            SchoolTeacherSeeder::class,
        ]);
    }
}
