<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::with('curriculums.contents')->get(), 200);
    }

    public function show($id)
    {
        $course = Course::with('curriculums.contents')->findOrFail($id);
        return response()->json($course, 200);
    }

    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json($course, 200);
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return response()->json(null, 204);
    }

    public function purchase(Request $request)
    {
        try {
            $request->validate([
                'course_id' => 'required',
            ]);
            $check_purchase = Purchase::whereUserId(auth()->id())->whereCourseId($request->course_id)->first();
            if(!empty($check_purchase)) {
                return response([
                    'message' => 'Already purchased'
                ], 400);
            }

            Purchase::create([
                'user_id' => auth()->id(),
                'course_id' => $request->course_id
            ]);

            return response([
                'message' => 'successful'
            ], );

        }catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
