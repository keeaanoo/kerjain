<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// BACKEND: Eloquent model for Todo entity
// DATABASE: Defines database table structure and relationships
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed',
        'due_date'
    ];

    // Cast due_date to Carbon instance
    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
