<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ["title", "img", "preview", "body", "is_active"];

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

        return $this->created_at->diffForHumans();

        // $carbondate = Carbon::parse( $this->created_at); 
        // $past = $carbondate->toDateString('d-m-Y');
        // return $past;

        //наш формат
        // $carbondate = Carbon::createFromFormat("Y-m-d H:i:s", $this->created_at)->format("d.m.Y"); 
        // return $carbondate;
    }

    public function scopeLastLimit($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->limit($numbers)->get();
    }

    public function scopeAllPaginate($query, $numbers)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->paginate($numbers);
    }
        
    public function scopeAllArticles($query)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->get();
    }

    public function scopeFindBySearch($query, $numbers, $title)
    {
        return $query->with('tags', 'state')->where("title", "like", "%".$title."%")->orderBy('created_at', 'desc')->paginate($numbers);
    }

    public function scopeFindById($query, $id)
    {
        return $query->with('comments','tags', 'state')->where('id', $id)->firstOrFail();
    }
}