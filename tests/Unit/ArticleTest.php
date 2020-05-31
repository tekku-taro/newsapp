<?php

namespace Tests\Unit;

use App\Comment;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    public function tearDown():void
    {
        parent::tearDown();
    }

    /**
     * testNewestComments
     *
     * @return void
     */
    public function testNewestComments()
    {
        $article = Article::first();
        $comments1 =factory(Comment::class, 3)->create(['article_id'=>$article->id, 'created_at'=>'2020-5-30']);
        $comments2 =factory(Comment::class, 2)->create(['article_id'=>$article->id, 'created_at'=>'2020-5-31']);

        $retval = $article->newestComments(2);

        $this->assertInstanceOf(Comment::class, $retval[0]);

        $this->assertCount(2, $retval);

        $this->assertEquals($comments2->pluck('id'), $retval->pluck('id'));
    }

    /**
     * testGetArticle.
     *
     * @return void
     */
    public function testGetArticle()
    {
        $article = Article::with(['newsSite','newsSite.category'])->first();
        $url = $article->url;
        $id = $article->id;


        $retval = $article->getArticle($url);

        $this->assertEquals($article, $retval);
        $this->assertInstanceOf('App\Article', $retval);

        $retval = $article->getArticle($id);

        $this->assertEquals($article, $retval);
        $this->assertInstanceOf('App\Article', $retval);

        $retval = $article->getArticle('no record key');

        $this->assertFalse($retval);
    }


    /**
     * testCalcReadingLength
     *
     * @return void
     */
    public function testCalcReadingLength()
    {
        $article = new Article();
        // 500 letters / min
        $article->content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大き';
        $article->calcReadingLength($article->content);
        $this->assertEquals(2, $article->readingLength);
        
        $article->content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章';
        $retval = $article->calcReadingLength($article->content);
        $this->assertEquals(0.5, $article->readingLength);
        $article->content = '';
        $retval = $article->calcReadingLength($article->content);
        $this->assertEquals(0, $article->readingLength);


        $article->content = '<article><div>この文章はダミーです。<div>文字の大きさ</div></div>、量、字間、<div>行間等を確認するために入れています。</div>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、<div><div>行間等を確認するた</div></div>めに入れています。この文章</article>';
        $retval = $article->calcReadingLength($article->content, true);
        $this->assertEquals(0.5, $article->readingLength);
    }
}
