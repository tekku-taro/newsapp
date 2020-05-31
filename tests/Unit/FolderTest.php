<?php

namespace Tests\Unit;

use App\Article;
use App\Folder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FolderTest extends TestCase
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
     * testClipArticle
     *
     * @return void
     */
    public function testClipArticle()
    {
        $article = Article::all()->random()->first();

        $folder = Folder::first();
        $retval = $folder->clipArticle($article->id);

        $this->assertDatabaseHas('folder_article', [
            'folder_id'=>$folder->id,
            'article_id'=>$article->id
        ]);

        $newFolder = Folder::where('id', '!=', $folder->id)->first();
        $retval = $newFolder->clipArticle($article->id, $folder->id);

        $this->assertDatabaseHas('folder_article', [
            'folder_id'=>$newFolder->id,
            'article_id'=>$article->id
        ]);

        $this->assertDatabaseMissing('folder_article', [
            'folder_id'=>$folder->id,
            'article_id'=>$article->id
        ]);
    }
    
    /**
     * testDeleteArticle
     *
     * @return void
     */
    public function testDeleteArticle()
    {
        $article = Article::all()->random()->first();

        $folder = Folder::first();
        $retval = $folder->clipArticle($article->id);

        $this->assertDatabaseHas('folder_article', [
            'folder_id'=>$folder->id,
            'article_id'=>$article->id
        ]);

        $retval = $folder->deleteArticle($article->id);


        $this->assertDatabaseMissing('folder_article', [
            'folder_id'=>$folder->id,
            'article_id'=>$article->id
        ]);
    }

    /**
     * testHasArticle
     *
     * @return void
     */
    public function testHasArticle()
    {
        $article = Article::all()->random()->first();

        $folder = Folder::first();
        $retval = $folder->clipArticle($article->id);

        $retval = $folder->hasArticle($article->id);

        $this->assertTrue($retval);

        $retval = $folder->hasArticle($article->id * 3);

        $this->assertFalse($retval);
    }
    
    /**
     * testGetClippings
     *
     * @return void
     */
    public function testGetClippings()
    {
        // $articles = Article::all()->random()->limit(5)->get();
        $articles =factory(Article::class, 3)->create(['title'=>'search in this title']);

        $folder = Folder::first();
        foreach ($articles as $key => $article) {
            $folder->clipArticle($article->id);
        }
        $searchKey = 'earch in';
        $retval = $folder->getClippings($searchKey);

        $this->assertInstanceOf(Article::class, $retval[0]);

        $this->assertCount(3, $retval);

        $searchKey = 'searc';
        $retval = $folder->getClippings($searchKey);

        $this->assertInstanceOf(Article::class, $retval[0]);

        $this->assertCount(3, $retval);

        $searchKey = 'no result';
        $retval = $folder->getClippings($searchKey);

        $this->assertCount(0, $retval);
    }
}
