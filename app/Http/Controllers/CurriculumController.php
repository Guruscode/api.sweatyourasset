<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index($course_id)
    {
        return response()->json(Curriculum::where('course_id', $course_id)->get(), 200);
    }

    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return response()->json($curriculum, 200);
    }

    public function store(Request $request, $course_id)
    {
        $curriculum = new Curriculum($request->all());
        $curriculum->course_id = $course_id;
        $curriculum->save();
        return response()->json($curriculum, 201);
    }

    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->update($request->all());
        return response()->json($curriculum, 200);
    }

    public function destroy($id)
    {
        Curriculum::destroy($id);
        return response()->json(null, 204);
    }
}
