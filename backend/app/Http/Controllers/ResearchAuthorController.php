<?php

namespace App\Http\Controllers;

use App\Models\Research;
use App\Models\ResearchAuthor;
use Illuminate\Http\Request;

class ResearchAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($researchId)
    {
        $researchAuthors = ResearchAuthor::where('research_id', $researchId)->get();
        
        return response()->json($researchAuthors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($researchId, Research $research, Request $request)
    {
        $user = auth()->user();

        $researchAuthor = ResearchAuthor::create([
            'research_id' => $researchId,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'ResearchAuthor created successfully',
            'research_author' => $researchAuthor
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Research $research, ResearchAuthor $researchAuthor, Request $request)
    {
        // Make sure the research author belongs to the specified research
         if ($researchAuthor->research_id !== $research->id) {
            return response()->json(['message' => 'ResearchAuthor not found for this research'], 404);
        }

        // Validate any additional attributes you want to update in the pivot table
        $validatedData = $request->validate([
            'some_attribute' => 'required|string',
            // Add other attributes as needed...
        ]);

        // Update the research author in the pivot table
        $researchAuthor->update($validatedData);

        return response()->json([
            'message' => 'ResearchAuthor updated successfully',
            'research_author' => $researchAuthor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Research $research, ResearchAuthor $researchAuthor)
    {
        if ($researchAuthor->research_id !== $research->id) {
            return response()->json(['message' => 'ResearchAuthor not found for this research'], 404);
        }

        // Delete the research author
        $researchAuthor->delete();

        return response()->json(['message' => 'ResearchAuthor deleted successfully']);
    }
}
