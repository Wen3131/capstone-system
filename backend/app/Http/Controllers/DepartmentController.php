<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = User::where('id', '!=', 1)
                ->orderBy('name', 'asc')
                ->get();
            return response()->json($departments);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Unable to retrieve departments.'], 500);
        }
    }

    public function getDepartmentById(Request $request, $id)
    {
        try {
            $department = User::findOrFail($id);
            return response()->json($department);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Department not found.'], 404);
        }
    }

    public function getDepartmentByUsername($username)
    {
        try {
            $department = User::where('username', $username)->firstOrFail();
            return response()->json($department);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Department not found.'], 404);
        }
    }

    public function getDepartmentsByLevel($level)
    {
        if (!in_array($level, [1, 2, 3])) {
            return response()->json(['error' => 'Invalid department level.'], 400);
        }
    
        try {
            $departments = User::where('level', $level)->get();
            return response()->json($departments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to retrieve departments.'], 500);
        }
    }
}
