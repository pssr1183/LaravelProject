<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'content','image_path', 'course_id'];
    use HasFactory;
    // Page.php
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
