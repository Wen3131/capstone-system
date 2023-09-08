<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramAuthor;
use Illuminate\Http\Request;

class ProgramAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($programId)
    {
        $programAuthors = ProgramAuthor::where('program_id', $programId)->get();
        
        return response()->json($programAuthors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($programId, Program $program, Request $request)
    {
        $user = auth()->user();

        $programAuthor = ProgramAuthor::create([
            'program_id' => $programId,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'ProgramAuthor created successfully',
            'program_author' => $programAuthor
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Program $program, ProgramAuthor $programAuthor, Request $request)
    {
        // Make sure the program author belongs to the specified program
         if ($programAuthor->program_id !== $program->id) {
            return response()->json(['message' => 'ProgramAuthor not found for this program'], 404);
        }

        // Validate any additional attributes you want to update in the pivot table
        $validatedData = $request->validate([
            'some_attribute' => 'required|string',
            // Add other attributes as needed...
        ]);

        // Update the program author in the pivot table
        $programAuthor->update($validatedData);

        return response()->json([
            'message' => 'ProgramAuthor updated successfully',
            'program_author' => $programAuthor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program, ProgramAuthor $programAuthor)
    {
        if ($programAuthor->program_id !== $program->id) {
            return response()->json(['message' => 'ProgramAuthor not found for this program'], 404);
        }

        // Delete the program author
        $programAuthor->delete();

        return response()->json(['message' => 'ProgramAuthor deleted successfully']);
    }
}
