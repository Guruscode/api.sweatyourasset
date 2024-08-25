<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Content;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('curriculums.contents')->get();
        $courses = CourseResource::collection($courses);
        return response([
            'courses' => $courses,
        ], 200);
    }

    public function getContent($curriculum_id, $course_id)
    {
        try {
            $check = Purchase::whereCourseId($course_id)->whereUserId(auth()->id())->first();
            if(empty($check)) {
                return response([
                    'message' => 'Unauthorized'
                ], 500);
            }
            $contents = Content::where('curricula_id', $curriculum_id)->get();
            return response([
                'contents' => $contents
            ], 200);
        }catch(\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
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
                'user_id' => 'required',
                'course_id' => 'required',
            ]);
            $check_purchase = Purchase::whereUserId($request->user_id)->whereCourseId($request->course_id)->first();
            if(!empty($check_purchase)) {
                return response([
                    'message' => 'Already purchased'
                ], 400);
            }

            Purchase::create([
                'user_id' => $request->user_id,
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
