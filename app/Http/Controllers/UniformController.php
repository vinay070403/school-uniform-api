<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Uniform;

class UniformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)        //parameter pass for request send
    {
        //return Uniform::all();
        $query = Uniform::query();

        if ($request->has('size')) {
            $query->where('size', $request->size);
        }

        if ($request->has('color')) {
            $query->where('color', $request->color);
        }

        return $query->get();
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        //$uniform = Uniform::create($request->all());
        //return response()->json($uniform, 201);

        $data = $request->only(['name', 'description', 'price', 'size', 'color']);      // here add image data

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uniforms', 'public');          // new line of code
        }

        $uniform = Uniform::create($data);                          // this one too

        return response()->json($uniform, 201);                    // or this  afetr this

        //Setup File Storage (if needed) php artisan storage:link
        //http://127.0.0.1:8000/storage/uniforms/filename.jpg
        

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