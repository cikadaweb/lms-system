<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ["correct_answer", "incorrect_answers", "question", "type", "test_id" ];

    public $timestamps = false;

    public function test() {
        return $this->belongsTo(Test::class);
    }
}