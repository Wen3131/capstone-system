<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($newsId = null)
    {
        $query = News::query();

        if ($newsId) {
            $query->where('id', $newsId);
        }
    
        $news = $query->select(
            '*',
            \DB::raw('REPLACE(
                news.title,
                " ",
                "-"
                ) AS titleUrl'),
            \DB::raw('CONCAT(
                MONTHNAME(news.date),
                " ",
                DAY(news.date),
                ", ",
                YEAR(news.date)
                ) AS date'),
            \DB::raw('CONCAT(
                MONTHNAME(news.created_at),
                " ",
                DAY(news.created_at),
                ", ",
                YEAR(news.created_at)
                ) AS created_at'),
        )
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();
    
        return response()->json($news);
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

        $news = News::create($validatedData);

        // Handle image upload and save to the desired directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = public_path("images/news/{$news->id}.jpg");
            $image->move(public_path('images/news'), "{$news->id}.jpg");
        }

        return response()->json([
            'message' => 'News created successfully',
            'news' => $news
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($newsId, Request $request)
    {
        $news = News::find($newsId);
        
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $news->update($validatedData);
    
        return response()->json([
            'message' => 'News updated successfully',
            'news' => $news
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($newsId)
    {
        $news = News::find($newsId);
        
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
    
        $news->delete();
        
        return response()->json(['message' => 'News deleted successfully']);
    }
}
