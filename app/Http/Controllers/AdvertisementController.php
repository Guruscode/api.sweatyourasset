<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function index()
    {
        return response()->json(Advertisement::all(), 200);
    }

    public function show($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return response()->json($advertisement, 200);
    }

    public function store(Request $request)
    {
        $advertisement = Advertisement::create($request->all());
        return response()->json($advertisement, 201);
    }

    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update($request->all());
        return response()->json($advertisement, 200);
    }

    public function destroy($id)
    {
        Advertisement::destroy($id);
        return response()->json(null, 204);
    }
}
