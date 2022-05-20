<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ["title", "img", "preview", "description"];

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function scopeFindBySearch($query, $title)
    {
        return $query->where("title", "like", "%".$title."%")->orderBy('created_at', 'desc')->get();
    }
}