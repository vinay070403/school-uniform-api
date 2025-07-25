<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Student;
use App\Models\Uniform;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::with(['student', 'uniform'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'uniform_id' => 'required|exists:uniforms,id',
            'quantity'   => 'required|integer|min:1',
        ]);
        $uniform = Uniform::find($request->uniform_id);
        $totalPrice = $uniform->price * $request->quantity;

        $order = Order::create([
            'student_id'  => $request->student_id,
            'uniform_id'  => $request->uniform_id,
            'quantity'    => $request->quantity,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $order = Order::with(['student', 'uniform'])->find($id);
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,delivered',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(null, 204);
    }
}
