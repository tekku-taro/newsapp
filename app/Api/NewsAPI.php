<?php
namespace App\Api;

class NewsAPI
{
    public $apiURL = 'http://newsapi.org/v2/top-headlines';

    public $status = [];

    public $newsData;

    public $queryArray = [
        'country'=>null,
        'category'=>null,
        'sources'=>null,
        'q'=>null,
        'pageSize'=>null,
        'page'=>null,
        'apiKey'=>'7b58a86bb41a4e60bdf933f01caa8d8e',
    ];

    public $requiredProperties = [
        'source',
        'author',
        'title',
        'description',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
    ];

    protected $context = [
        "http" => [
            "protocol_version" => "1.1",
            // "method"  => "POST",
            // "header"  => implode("\r\n", $header),
            // "content" => $req,
            "ignore_errors" => true
        ]
    ];

    public function getNews($keys)
    {
        $keys = array_filter($keys);

        if ($this->validateKeys($keys)) {
            $url = $this->makePath($keys);
            // print($url);
            $rawdata = file_get_contents($url, false, stream_context_create($this->context));
    
            $rawdata = json_decode($rawdata);

            $this->extractData($rawdata);
        } else {
            return false;
        }
        
        dump($this->newsData[0]);
        return $this->newsData;
    }

    protected function extractData($rawdata)
    {
        $this->status = ['status' => $rawdata->status,'count'=>$rawdata->totalResults];

        foreach ($rawdata->articles as $key => $article) {
            $raw = [];
            foreach ($article as $key => $value) {
                if (in_array($key, $this->requiredProperties)) {
                    $raw[$key] = $value;
                }
            }
            $this->newsData[] = $raw;
        }
    }

    protected function makePath($keys)
    {
        $this->injectKeyData($keys);

        $queryString = http_build_query($this->queryArray);

        if (empty($queryString)) {
            $url = $this->apiURL;
        } else {
            $url = $this->apiURL . '?' . $queryString;
        }

        return $url;
    }

    protected function injectKeyData($keys)
    {
        foreach ($keys as $key => $value) {
            if (array_key_exists($key, $this->queryArray)) {
                $this->queryArray[$key] = $value;
            }
        }
    }

    protected function validateKeys($keys)
    {
        $hasCategoryCountry = (array_key_exists('country', $keys) || array_key_exists('category', $keys));
        $hasSources = array_key_exists('sources', $keys);

        if ($hasCategoryCountry && $hasSources) {
            return false;
        }

        return true;
    }
}
