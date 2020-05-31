<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\NewsAPI;
use App\Api\APIPaginator;
use App\Article;
use App\NewsSite;
use App\Folder;
use App\Service\ArticleManager;
use App\Service\PrinterService;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, NewsAPI $api, ArticleManager $articleManager)
    {
        $newsData = [];
        $newsSite = null;
        if ($request->has('sources')) {
            $newsSite = NewsSite::find($request->query('sources'));
        } else {
            $newsSite = NewsSite::defaultSite()->first();
        }
        $page = $request->query('page')? $request->query('page'):1;
        $keys = $newsSite->getQueryArrayBySources(
            $request->query('key'),
            $page
        );
        // dd($keys);
        // $apidata = false;
        setOld('key', $request->query('key'));
        $apidata = $api->getNews($keys);
        if ($apidata) {
            $newsData = $newsSite->saveAndGetArticles($apidata);
        
            $newsData =$articleManager->decorateArticles($request->user(), $newsData);
        } else {
            $request->session()->flash('failure', $api->status['message']);
            // debug
            // $newsData = Article::limit(5)->latest()->get();
            // $newsData =$articleManager->decorateArticles($request->user(), $newsData);
        }

        $folderList = $articleManager->getFolderList($request->user());
        $siteList = NewsSite::all();
        // dd($siteList, $newsSite->sources);

        // custom pagination
        $paginator = APIPaginator::make($request, $newsData, $api, $page);
        // dump($paginator);
        return view('pages.news', [
            'newsData'=> $paginator,
            'folderList'=>$folderList,
            'siteList'=>$siteList,
            'newsSite'=>$newsSite,
            'status'=>$api->status
            ]);
    }

    public function print(
        Request $request,
        NewsAPI $api,
        PrinterService $printer
    ) {
        $newsSite = null;
        if ($request->has('sources')) {
            $newsSite = NewsSite::find($request->query('sources'));
        } else {
            $newsSite = NewsSite::defaultSite()->first();
        }

        // if ($request->has('sources')) {
        $keys = $newsSite->getQueryArrayBySources(
            $request->query('key'),
            $request->query('page')? $request->query('page'):1
        );
        $apiData = $api->getNews($keys);
        $newsData = $newsSite->getArticles($apiData);

        $printData = $newsData;
            
        $headers = array_keys($printData[0]->toArray());

        // news_list.xlsxに書き込む
        return $printer->exportEXCEL($printData, $headers);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, ArticleManager $articleManager)
    {
        // 記事IDから記事データを取得
        $article = Article::with(['newsSite','comments','comments.user'])->findOrFail($id);
        // ☆評価を取得して追加
        // ユーザのフォルダに記事があるか、あればフォルダIDを追加
        $article =$articleManager->decorateArticle($request->user(), $article);
        $folder = Folder::find($article->folderId);
        // フォルダリストを取得
        $folderList = $articleManager->getFolderList($request->user());
        // サイトリスト
        $siteList = NewsSite::all();
        // 閲覧履歴に追加
        $request->user()->addHistory($article->id);
        // dump($article);
        // コメントデータ、フォルダリストと整理したデータをviewに渡す
        return view('pages.news_article', [
            'article'=> $article,
            'folderList'=>$folderList,
            'siteList'=>$siteList,
            'newsSite'=>$article->newsSite,
            'folder'=>$folder
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
