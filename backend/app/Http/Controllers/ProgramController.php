<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($identifier = null, $type = null)
    {
        $query = Program::query();
    
        if ($type === 'username') {
            if ($identifier) {
                $query->whereHas('users', function ($q) use ($identifier) {
                    $q->whereHas('user', function ($q) use ($identifier) {
                        $q->where('username', $identifier);
                    });
                });
            }
        } elseif ($type === 'id') {
            if ($identifier) {
                $query->where('programs.id', $identifier);
            }
        }

        $programs = $query
            ->join('program_authors', 'programs.id', '=', 'program_id')
            ->join('users', 'users.id', '=', 'user_id')
            ->select(
                'programs.id AS id',
                'users.name AS author',
                \DB::raw('REPLACE(
                    programs.title,
                    " ",
                    "-"
                    ) AS titleUrl'),
                'programs.title AS title',
                'programs.description AS description',
                \DB::raw('CONCAT(
                    MONTHNAME(programs.date),
                    " ",
                    DAY(programs.date),
                    ", ",
                    YEAR(programs.date)
                    ) AS date'),
                \DB::raw('CONCAT(
                    MONTHNAME(programs.created_at),
                    " ",
                    DAY(programs.created_at),
                    ", ",
                    YEAR(programs.created_at)
                    ) AS created_at'),
            )
            ->orderBy('programs.date', 'desc')
            ->orderBy('programs.created_at', 'desc')
            ->get();
    
        return response()->json($programs);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'image' => 'image|mimes:jpeg,jpg|max:2048',
    //     ]);
    
    //     $program = Program::create($validatedData);
    
    //     $imagePath = "images/departments/programs/{$program->id}.jpg";
    //     Storage::putFileAs('public', $request->file('image'), $imagePath);
    
    //     return response()->json([
    //         'message' => 'Program created successfully',
    //         'program' => $program
    //     ], 201);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Create the program record without an image field
        $program = Program::create($validatedData);
    
        // Handle image upload and save to the desired directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$program->id}.jpg"; // Customize the image name
        
            // Define the desired directory path
            // $imagePath = public_path("/images/departments/programs/");
        
            // Move the uploaded image to the custom directory with the specified file name
            // $image->move($imagePath, $imageName);
            $image->move(public_path(`/images/departments/programs/$imageName`));
        }
        
    
        return response()->json([
            'message' => 'Program created successfully',
            'program' => $program
        ], 201);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update($programId, Request $request)
    {
        $program = Program::find($programId);
        
        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $program->update($validatedData);

        // Handle image upload and save to the desired directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = public_path("images/departments/programs/{$program->id}.jpg");
            $image->move(public_path('images/departments/programs'), "{$program->id}.jpg");
        }
    
        return response()->json([
            'message' => 'Program updated successfully',
            'program' => $program
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($programId)
    {
        $program = Program::find($programId);
        
        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }
    
        $program->delete();
        
        return response()->json(['message' => 'Program deleted successfully']);
    }
}
