<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ["category", "course_id"];

    public $timestamps = false;

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function scopeFindById($query, $id)
    {
        return $query->with('questions')->where('id', $id)->firstOrFail();
    }
}