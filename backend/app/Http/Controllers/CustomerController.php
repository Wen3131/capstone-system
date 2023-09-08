<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();
    
        $query->orderBy('created_at', 'desc');
    
        $customer = $query->get();
    
        return response()->json($customer);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create($validatedData);

        return response()->json([
            'message' => 'Customer created successfully',
            'customer' => $customer
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($customerId, Request $request)
    {
        $customer = Customer::find($customerId);
        
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $customer->update($validatedData);
    
        return response()->json([
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($customerId)
    {
        $customer = Customer::find($customerId);
        
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    
        $customer->delete();
        
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
