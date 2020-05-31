<?php

namespace Tests\Unit;

use App\Article;
use Tests\TestCase;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;

class CommentTest extends TestCase
{
    private $user;
    // use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        factory(Comment::class, 10)->create();
    }

    public function tearDown():void
    {
        DB::table('comments')->truncate();
        parent::tearDown();
    }
    /**
     * testDeleteComment
     *
     * @return void
     */
    public function testDeleteComment()
    {
        $comment = Comment::all()->random()->first();

        $retval = $comment->deleteComment($comment->id);

        $this->assertTrue($retval);
        $this->assertDatabaseMissing('comments', [
            'id'=>$comment->id
        ]);
    }

    /**
     * testGetComments
     *
     * @return void
     */
    public function testGetComments()
    {
        $comment = Comment::all()->random()->first();
        $article = Article::all()->random()->first();

        $retval = $comment->getComments($article->id);

        $this->assertInstanceOf(Comment::class, $retval[0]);
        $this->assertInstanceOf(User::class, $retval[0]->user);
    }
}
