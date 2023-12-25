<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;
    protected $table = 'user_progress';  // Specify the table name if different from the model name

    protected $fillable = [
        'user_id',
        'course_id',
        'page_id'
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
