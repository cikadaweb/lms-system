<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ["title", "img", "body"];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function state() {
        return $this->hasOne(State::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function createdAtForHumans(){
        $carbondate = Carbon::parse( $this->created_at); 
        $past = $carbondate->toDateString('d-m-Y');
        return $past;
    }

    public function scopeAllPaginate($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->paginate($numbers);
    }

    public function scopeLastLimit($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->limit($numbers)->get();
    }
}