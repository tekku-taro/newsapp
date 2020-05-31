<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\NewsAPI;
use App\Article;
use App\Comment;
use App\NewsSite;
use App\Service\ArticleManager;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index(Request $request, NewsAPI $api, ArticleManager $articleManager)
    {
        if (!Auth::check()) {
            return view('welcome');
        }

        $newsData = [];
        $newsSite = NewsSite::defaultSite()->first();
        $keys = $newsSite->getQueryArrayBySources('', null, 5);
        // $apidata = false;
        // NewsAPIにキーを渡す
        $apidata = $api->getNews($keys);
        // dd($apidata);
        // 返された記事データを未保存ならArticleで保存する。
        if ($apidata) {
            $newsData = $newsSite->saveAndGetArticles($apidata);
            
            $newsData = collect($articleManager->decorateArticles($request->user(), $newsData));
        } else {
            // debug
            $newsData = Article::limit(5)->latest()->get();
        }
        // サイト一覧を取得
        $siteList = NewsSite::all();
        // Commentメソッドで新着コメントを取得
        $comments = Comment::latestComments(5);
        // Userメソッドで閲覧履歴を取得
        $histories = $request->user()->newestHistories(5);

        // 新着コメント・閲覧履歴
        // サイト一覧と整理したデータをviewに渡す
        return view('top', [
            'tierOne'=> $newsData->take(2),
            'tierTwo'=> $newsData->slice(2),
            'comments'=>$comments,
            'histories'=>$histories,
            'siteList'=>$siteList,
            'status'=>$api->status
            ]);
    }
}
