<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    // timestamp
    public function testCreateComment(): void
    {
        $comment = new Comment();
        $comment->email = 'rio@gmail.com';
        $comment->title = 'kritik';
        $comment->comment = 'elek cok';
        $comment->save();

        self::assertNotNull($comment->id);
    }

    //default attributes values
    public function testDav(): void
    {
        $comment = new Comment();
        $comment->email = 'rio@gmail.com';
        $comment->save();

        self::assertNotNull($comment->id);
    }


}
