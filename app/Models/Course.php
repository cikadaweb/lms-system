<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ["title", "img", "preview", "is_active", "description"];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function test() {
        return $this->hasOne(Test::class);
    }

    public function scopeFindBySearch($query, $title)
    {
        return $query->where("title", "like", "%".$title."%")->orderBy('created_at', 'desc')->get();
    }
    public function scopeFindById($query, $id)
    {
        return $query->where('id', $id)->firstOrFail();
    }
}