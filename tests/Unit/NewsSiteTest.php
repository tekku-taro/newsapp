<?php

namespace Tests\Unit;

use App\Article;
use App\NewsSite;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsSiteTest extends TestCase
{
    use DatabaseTransactions;
    // protected $bbc = [
    //     'name'=>'BBC NEWS',
    //     'sources'=>'bbc-news',
    //     'url'=>'https://www.bbc.com',
    //     'category_id'=>1,
    //     'country_id'=>1
    // ];
    
    protected $articles = [
        [
            'title'=>'title1',
            'description'=>'desc1',
            'content'=>'content1',
            'url'=>'https://apnews.com/',
        ],
        [
            'title'=>'title2',
            'description'=>'desc2',
            'content'=>null,
            'url'=>'https://apnews2.com/'
        ],
        [
            'title'=>'title3',
            'description'=>'desc3',
            'content'=>'content3',
            'url'=>'https://apnews3.com/'
        ],
    ];

    protected $newsSite;

    public function setUp():void
    {
        parent::setUp();
        
        $this->newsSite = NewsSite::find(1);
        // factory(NewsSite::class, 10)->create();
        // factory(Article::class, 10)->create(['news_site_id'=>$newsSite->id]);
    }

    public function tearDown():void
    {
        parent::tearDown();
    }

    /**
     * testSaveAndGetArticles
     *
     * @return void
     */
    public function testSaveAndGetArticles()
    {
        $data =[
            "source" => 'testsource',
            "author" => null,
            "title" => "黒川弘務氏の訓告処分に石破茂氏「もういい加減にしてもらいたい」 - ライブドアニュース - livedoor",
            "description" => "石破茂氏が22日、黒川弘務氏の辞任・訓告処分についてブログで私見を述べた。戒告ではなかったことに、「このままでは政治に対する不信は高まる」と言及。「正直言って『もういい加減にしてもらいたい』との思い」だと憤った",
            "url" => "https://news.livedoor.com/article/detail/18301644/",
            "urlToImage" => "https://image.news.livedoor.com/newsimage/stf/7/9/79f2e_50_5600b4e6_09ba13e9.jpg",
            "publishedAt" => "2020-05-22T12:52:00Z",
            "content" => "ishiba-shigeru.cocolog-nifty.com",
          ];
        // $this->articles = array_map(function ($article) {
        //     $article['news_site_id'] = $this->newsSite->id;
        //     return $article;
        // }, $this->articles);
        $article = new Article($data);
        $this->articles[0] =  $article->toArray();


        
        $retval = $this->newsSite->saveAndGetArticles($this->articles);

        $this->assertDatabaseHas('articles', [
            'title'=>$article->title,
        ]);
        $this->assertDatabaseHas('articles', [
            'title'=>'title3',
        ]);
        $this->assertDatabaseMissing('articles', [
            'title'=>'title2',
        ]);
    }
    /**
     * testSaveArticles
     *
     * @return void
     */
    public function testSaveArticles()
    {
        // $this->articles = array_map(function ($article) {
        //     $article['news_site_id'] = $this->newsSite->id;
        //     return $article;
        // }, $this->articles);

        $retval = $this->newsSite->saveArticles($this->articles);

        $this->assertDatabaseHas('articles', [
            'title'=>'title1',
        ]);
        $this->assertDatabaseHas('articles', [
            'title'=>'title3',
        ]);
        $this->assertDatabaseMissing('articles', [
            'title'=>'title2',
        ]);
    }


    /**
     * testGetQueryArray
     *
     * @return void
     */
    public function testGetQueryArray()
    {
        $expected =   [
            'country'=>$this->newsSite->country->code,
            'category'=>$this->newsSite->category->name,
            'sources'=>$this->newsSite->sources,
            'pageSize'=>20,
            'page'=>3,
        ];

        $retval = $this->newsSite->getQueryArray($this->newsSite->id);

        $this->assertEquals($expected, $retval);
    }
}
