<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'description', 'completed', 'priority', 
        'category_id', 'due_date', 'is_flagged', 'completed_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
