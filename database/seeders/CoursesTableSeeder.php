<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Course::create([
                'name' => "Course $i",
                'is_paid' => rand(0, 1),
                'price' => rand(10, 100),
                'overview' => "Overview of Course $i",
                'language' => 'English',
                'number_of_lessons' => rand(10, 20),
                'hours' => rand(5, 10),
                'what_you_will_learn' => "You will learn things in Course $i",
                'video_url' => null,
                'file_url' => null,
            ]);
        }
    }
}
