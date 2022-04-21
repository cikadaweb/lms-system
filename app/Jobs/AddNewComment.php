<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use App\Models\Comment;


class AddNewComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $body;
    protected $article_id;


    public function __construct($body, $article_id)
    {
        $this->body = $body;
        $this->article_id = $article_id;
    }

    public function handle()
    {
        $comment = Comment::create([
            'body' => $this->body,
            'article_id' => $this->article_id
        ]);
    }
}