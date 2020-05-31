<?php
namespace App\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Api\NewsAPI;

class APIPaginator
{
    public static function make(Request $request, $articles, NewsAPI $api, $page)
    {
        $pageSize = $api->queryArray['pageSize'];
        $parameters = Arr::except($request->query(), ['page']);
        $path = url('/') . '/news';// . $parameters;
        if (!empty($articles)) {
            $totalCount = $api->status['count'];
        } else {
            $totalCount = 0;
        }
                
        $paginator = new LengthAwarePaginator($articles, $totalCount, $pageSize, $page);
        return $paginator->withPath($path);
    }
}
