<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($identifier = null, $type = null)
    {
        $query = Research::query();
    
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
                $query->where('research.id', $identifier);
            }
        }
    
        $researches = $query
            ->join('research_authors', 'research.id', '=', 'research_id')
            ->join('users', 'users.id', '=', 'user_id')
            ->select(
                'research.id AS id',
                'users.name AS author',
                \DB::raw('REPLACE(
                    research.title,
                    " ",
                    "-"
                    ) AS titleUrl'),
                'research.title AS title',
                'research.description AS description',
                \DB::raw('CONCAT(
                    MONTHNAME(research.date),
                    " ",
                    DAY(research.date),
                    ", ",
                    YEAR(research.date)
                    ) AS date'),
                \DB::raw('CONCAT(
                    MONTHNAME(research.created_at),
                    " ",
                    DAY(research.created_at),
                    ", ",
                    YEAR(research.created_at)
                    ) AS created_at'),
            )
            ->orderBy('research.date', 'desc')
            ->orderBy('research.created_at', 'desc')
            ->get();
    
        return response()->json($researches);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $research = Research::create($validatedData);

        // Handle image upload and save to the desired directory
        if ($request->hasFile('pdf')) {
            $image = $request->file('pdf');
            $imagePath = public_path("images/departments/researches/{$research->id}.pdf");
            $image->move(public_path('images/departments/researches'), "{$research->id}.pdf");
        }

        return response()->json([
            'message' => 'Research created successfully',
            'research' => $research
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($researchId, Request $request)
    {
        $research = Research::find($researchId);
        
        if (!$research) {
            return response()->json(['message' => 'Research not found'], 404);
        }
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $research->update($validatedData);
    
        return response()->json([
            'message' => 'Research updated successfully',
            'research' => $research
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($researchId)
    {
        $research = Research::find($researchId);
        
        if (!$research) {
            return response()->json(['message' => 'Research not found'], 404);
        }
    
        $research->delete();
        
        return response()->json(['message' => 'Research deleted successfully']);
    }
}
