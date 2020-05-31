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
        'apiKey'=> null,
    ];

    public $requiredProperties = [
        'source'=>'source',
        'author'=>'author',
        'title'=>'title',
        'description'=>'description',
        'url'=>'url',
        'urlToImage'=>'url_to_image',
        'publishedAt'=>'published_at',
        'content'=>'content',
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
            // dd($url);
            $rawdata = file_get_contents($url, false, stream_context_create($this->context));
    
            $rawdata = json_decode($rawdata);
            if (!$this->checkRawData($rawdata)) {
                return false;
            }
            // dd($rawdata);
            $this->extractData($rawdata);
        } else {
            return false;
        }
        
        // dump($this->newsData[0]);
        return $this->newsData;
    }

    protected function checkRawData($rawdata)
    {
        if (isset($rawdata->status) && $rawdata->status == 'error') {
            $this->status = ['status' => $rawdata->status,'message'=>$rawdata->message];
            return false;
        } elseif (count($rawdata->articles) == 0) {
            $this->status = ['status' => $rawdata->status,'message'=>'記事が取得できませんでした。'];
            return false;
        }


        return true;
    }

    protected function extractData($rawdata)
    {
        $this->status = ['status' => $rawdata->status,'count'=>$rawdata->totalResults];

        foreach ($rawdata->articles as $key => $article) {
            $raw = [];
            foreach ($article as $key => $value) {
                if (array_key_exists($key, $this->requiredProperties)) {
                    $raw[$this->requiredProperties[$key]] = $value;
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

        $this->setAPIKey();
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

    private function setAPIKey()
    {
        $this->queryArray['apiKey'] = env('API_KEY');
    }
}
