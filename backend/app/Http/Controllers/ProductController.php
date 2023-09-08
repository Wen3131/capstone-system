<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
    
        $products = $query->get();
    
        return response()->json($products);
    }

    public function getProductsByCategory($category)
    {
        if (!in_array($category, [1, 2, 3])) {
            return response()->json(['error' => 'Invalid product category.'], 422);
        }
    
            $products = Product::where('category', $category)->get();
            return response()->json($products);
    }

    public function getProductById(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            return response()->json(['product' => $product]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'other_name' => 'nullable|string|max:255',
            'category' => ['required', 'in:1,2,3'], // 1=fruit,2=vegetable, 3=fertilizer
            'amount' => 'required|between:0,999999.99',
            'kilos' => 'required|between:0,999999.99',
        ]);

        $product = Product::create($validatedData);

        // Handle image upload and save to the desired directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = public_path("/images/products/{$product->id}.jpg");
            $image->move(public_path('/images/products'), "{$product->id}.jpg");
        }

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($productId, Request $request)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'other_name' => 'nullable|string|max:255',
            'category' => ['required', 'in:1,2,3'], // 1=fruit,2=vegetable, 3=fertilizer
            'amount' => 'required|between:0,999999.99',
            'kilos' => 'required|between:0,999999.99',
        ]);
    
        $product->update($validatedData);

        // Handle image upload and save to the desired directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = public_path("/images/products/{$product->id}.jpg");
            $image->move(public_path('/images/products'), "{$product->id}.jpg");
        }
    
        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    public function updateKilos($productId, Request $request)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        
        $validatedData = $request->validate([
            'kilos' => 'required|between:0,999999.99',
        ]);
    
        $product->update($validatedData);
    
        return response()->json([
            'message' => 'Product kilos updated successfully',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $product->delete();
        
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
