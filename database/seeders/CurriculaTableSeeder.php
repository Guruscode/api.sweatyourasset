<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurriculaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve existing course IDs
        $courseIds = Course::pluck('id')->toArray();

        // Generate curricula for each course
        foreach ($courseIds as $courseId) {
            for ($i = 1; $i <= 10; $i++) {
                Curriculum::create([
                    'course_id' => $courseId,
                    'title' => "Curriculum $i for Course $courseId",
                    'content' => "Content of Curriculum $i for Course $courseId",
                    'video_url' => null,
                    'file_url' => null,
                ]);
            }
        }
    }
}
