<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($identifier = null, $type = null)
    {
        $query = Sales::query();
    
        $query->orderBy('updated_at', 'desc');
    
        $sales = $query->get();
    
        return response()->json($sales);
    }

    public function search($searchTerm)
    {
        // Implement your search logic for products here
        $productResults = Product::where('name', 'like', "%$searchTerm%")->get();
    
        // Implement your search logic for customers here
        $customerResults = Customer::where('name', 'like', "%$searchTerm%")->get();
    
        // Combine both results into a single array
        $searchResults = [
            'products' => $productResults,
            'customers' => $customerResults,
        ];

        return response()->json(['searchResults' => $searchResults]);
    }

    public function salesData()
    {
        $salesData = DB::table('sales')
            ->join('orders', 'sales.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select(
                // sales.created_at
                \DB::raw('CONCAT(
                    MONTHNAME(sales.created_at),
                    " ",
                    DAY(sales.created_at),
                    ", ",
                    YEAR(sales.created_at)
                ) AS date'),
                // sales.id
                'sales.id AS id',
                // sales.order_id
                'sales.order_id AS order_id',
                // customers.customer_name
                'customers.name AS customer_name',
                // products.category
                \DB::raw('CASE 
                    WHEN products.category = 1 THEN "Fruit"
                    WHEN products.category = 2 THEN "Vegetables"
                    WHEN products.category = 3 THEN "Fertilizer"
                ELSE "Unknown" END AS product_category'),
                // products.product_name
                'products.name AS product_name',
                // products.product_amount
                'products.amount AS product_amount',
                // sales.kilos
                'sales.kilos AS kilos',
                // sales.total_amount
                \DB::raw('ROUND((sales.kilos * products.amount), 2) AS total_amount')
            )
            ->orderBy('sales.id', 'desc')
            ->get();
    
        return response()->json(['salesData' => $salesData]);
    }

    public function notificationData()
    {
        $notificationData = DB::table('sales')
            ->join('orders', 'sales.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select(
                // sales.created_at
                'sales.created_at AS sales_date',
                // products
                'products.updated_at AS product_date',
                // customers.customer_name
                'customers.name AS customer_name',
                // products.name
                'products.name AS product_name',
                // products.kilos
                'products.kilos AS product_kilos',
                // products.kilos_status
                \DB::raw('CASE 
                    WHEN products.kilos <= 5 THEN "below"
                    ELSE "Unknown" END AS product_kilos_status'),
                // products.amount
                'products.amount AS product_amount',
                // sales.kilos
                'sales.kilos AS kilos',
                // sales.total_amount
                \DB::raw('ROUND((sales.kilos * products.amount), 2) AS total_amount'),
                // purchase string
                \DB::raw('CONCAT(
                    customers.name,
                    " purchased ",
                    products.kilos,
                    " kilos of ",
                    products.name
                ) AS purchase'),
                // low_product string
                \DB::raw('CONCAT(
                    products.name,
                    " is now ",
                    (CASE 
                        WHEN products.kilos <= 5 THEN "below"
                        ELSE "Unknown" END),
                    " ",
                    products.kilos,
                    " kilos "
                ) AS low_product')
            )
            ->orderBy('sales.created_at', 'desc')
            ->orderBy('product_kilos', 'asc')
            ->get();

        return response()->json(['notificationData' => $notificationData]);
    }

    public function topSales()
    {
        $topSales = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select(
                // products.product_name
                'products.name AS product_name',
                // sales.kilos
                DB::raw('SUM(sales.kilos) AS kilos'),
                // sales.total_amount
                DB::raw('ROUND(SUM(sales.kilos * products.amount), 2) AS total_amount') // Calculate total amount here
            )
            ->groupBy('products.name')
            ->orderBy('total_amount', 'desc')
            ->take(3)
            ->get();    
    
        return response()->json(['topSales' => $topSales]);
    }

    public function overviewSales()
    {
        $overviewSales = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->selectRaw('ROUND(SUM(amount * sales.kilos), 2) AS total_amount')
            ->first();
    
        return response()->json(['overviewSales' => $overviewSales]);
    }

    public function overviewOrders()
    {
        $overviewOrders = DB::table('orders')
            ->selectRaw('COUNT(*) AS total_orders')
            ->first();
    
        return response()->json(['overviewOrders' => $overviewOrders]);
    }

    public function overviewCustomers()
    {
        $overviewCustomers = DB::table('customers')
            ->selectRaw('COUNT(*) AS total_customers')
            ->first();
    
        return response()->json(['overviewCustomers' => $overviewCustomers]);
    }

    public function overviewKilos()
    {
        $overviewKilos = DB::table('sales')
            ->selectRaw('SUM(sales.kilos) AS total_kilos')
            ->first();
    
        return response()->json(['overviewKilos' => $overviewKilos]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order, Product $product, Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => ['required', Rule::exists('orders', 'id')],
            'product_id' => ['required', Rule::exists('products', 'id')],
            'kilos' => 'required|between:0,999999.99',
        ]);

        $sales = Sales::create($validatedData);

        return response()->json([
            'message' => 'Sales created successfully',
            'sales' => $sales
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($salesId, Order $order, Product $product, Request $request)
    {
        $sales = Sales::find($salesId);
        
        if (!$sales) {
            return response()->json(['message' => 'Sales not found'], 404);
        }
        
        $validatedData = $request->validate([
            'order_id' => ['required', Rule::exists('orders', 'id')],
            'product_id' => ['required', Rule::exists('products', 'id')],
            'kilos' => 'required|between:0,999999.99',
        ]);
    
        $sales->update($validatedData);
    
        return response()->json([
            'message' => 'Sales updated successfully',
            'sales' => $sales
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product, Order $order, $salesId)
    {
        $sales = Sales::find($salesId);
        
        if (!$sales) {
            return response()->json(['message' => 'Sales not found'], 404);
        }

        if ($sales->product_id !== $product->id) {
            return response()->json(['message' => 'Sales not found for this product'], 404);
        }

        if ($sales->order_id !== $order->id) {
            return response()->json(['message' => 'Sales not found for this order'], 404);
        }
    
        $sales->delete();
        
        return response()->json(['message' => 'Sales deleted successfully']);
    }
}
