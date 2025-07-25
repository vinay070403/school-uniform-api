<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Uniform;

class UniformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Uniform::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'color' => 'nullable|string',
        ]);
        $uniform = Uniform::create($request->all());
        return response()->json($uniform, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $uniform = Uniform::find($id);
        if (!$uniform) {
            return response()->json(['message' => 'Uniform not found'], 404);
        }
        return $uniform;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $uniform = Uniform::find($id);
        if (!$uniform) {
            return response()->json(['message' => 'Uniform not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'size' => 'sometimes|required|string',
            'color' => 'nullable|string',
        ]);
        $uniform->update($request->all());
        return response()->json($uniform, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $uniform = Uniform::find($id);
        if (!$uniform) {
            return response()->json(['message' => 'Uniform not found'], 404);
        }

        $uniform->delete();
        return response()->json(null, 204);
    }
}
