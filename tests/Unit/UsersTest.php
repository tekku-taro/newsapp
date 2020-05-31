<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    public function tearDown():void
    {
        // DB::table('favorites')->truncate();
        // DB::table('comments')->truncate();
        parent::tearDown();
    }

    /**
     * testFavorite
     *
     * @return void
     */
    public function testFavorite()
    {
        $article = Article::all()->random()->first();
        $stars = 5;
        $user = \App\User::first();
        $retval = $user->addFavorite($article->id, $stars);

        $this->assertDatabaseHas('favorites', [
            'user_id'=>$user->id,
            'article_id'=>$article->id,
            'stars'=>$stars
        ]);

        $retval = $user->getFavoriteScore($article->id);

        $this->assertEquals($stars, $retval);


        $retval = $user->removeFavorite($article->id);

        $this->assertDatabaseMissing('favorites', [
            'user_id'=>$user->id,
            'article_id'=>$article->id,
            'stars'=>$stars
        ]);
    }

    /**
     * testAddFavorite
     *
     * @return void
     */
    public function testCreateComment()
    {
        $article = Article::all()->random()->first();
        $title = 'my title';
        $body = 'this is a body';
        $user = \App\User::first();
        $retval = $user->createComment($article->id, $title, $body);

        $this->assertDatabaseHas('comments', [
            'user_id'=>$user->id,
            'title'=>$title,
            'body'=>$body,
            'article_id'=>$article->id
        ]);
    }



    /**
     * testHistory
     *
     * @return void
     */
    public function testHistory()
    {
        $articles = Article::all()->random()->limit(3)->get();
        $user = \App\User::first();
        $retval = $user->addHistory($articles[0]->id);

        $this->assertDatabaseHas('histories', [
            'user_id'=>$user->id,
            'article_id'=>$articles[0]->id
        ]);
        $article = Article::all()->random()->first();
        $retval = $user->addHistory($articles[1]->id);
        
        $article = Article::all()->random()->first();
        $retval = $user->addHistory($articles[2]->id);


        $retval = $user->newestHistories(3);

        $this->assertInstanceOf(Article::class, $retval[0]);

        $this->assertCount(3, $retval);
    }
}
