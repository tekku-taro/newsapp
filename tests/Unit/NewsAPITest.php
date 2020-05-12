<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Api\NewsAPI;

class NewsAPITest extends TestCase
{
    public function setUp():void
    {
        $this->api = new NewsAPI();
    }

    /**
     * testGetNewsGetData
     *
     * @return void
     */
    public function testGetNews()
    {
        $queryArray = [
            'country'=>'us',
            'category'=>'business',
            'sources'=>null,
            'q'=>null,
            'pageSize'=>null,
            'page'=>null,
            'apiKey'=>'7b58a86bb41a4e60bdf933f01caa8d8e',
        ];

        $news = $this->api->getNews($queryArray);
    }
    /**
     * testGetNewsGetData
     *
     * @return void
     */
    public function testGetNewsReturnFalse()
    {
        $queryArray = [
            'country'=>'us',
            'category'=>'business',
            'sources'=>'test',
            'q'=>null,
            'pageSize'=>null,
            'page'=>null,
            'apiKey'=>'7b58a86bb41a4e60bdf933f01caa8d8e',
        ];

        $news = $this->api->getNews($queryArray);
        $this->assertFalse($news);
    }
}
