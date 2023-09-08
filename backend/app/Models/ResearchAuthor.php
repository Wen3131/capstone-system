<?php

namespace App\Models;

use App\Models\Research;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchAuthor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'research_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function research()
    {
        return $this->belongsTo(Research::class);
    }
}
