<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pages()
    {
        return $this->hasMany(Page::class,'course_id');
    }
}
