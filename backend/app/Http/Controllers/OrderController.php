<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();
    
        $query->orderBy('created_at', 'desc');
    
        $order = $query->get();
    
        return response()->json($order);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Customer $customer, Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id'
        ]);

        $order = Order::create($validatedData);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($orderId, Customer $customer, Request $request)
    {
        $order = Order::find($orderId);
        
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        
        $validatedData = $request->validate([
            'customer_id' => $customer->id,
        ]);
    
        $order->update($validatedData);
    
        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Customer $customer, $orderId)
    {
        $order = Order::find($orderId);
        
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->customer_id !== $customer->id) {
            return response()->json(['message' => 'Order not found for this customer'], 404);
        }
    
        $order->delete();
        
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
