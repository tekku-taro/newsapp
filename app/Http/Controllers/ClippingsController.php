<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Folder;
use App\Service\ArticleManager;
use App\Service\PrinterService;
use Illuminate\Support\Collection;

class ClippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ArticleManager $articleManager)
    {
        $newsData = [];
        $folder = null;
        $search_key = '';
        // あれば検索キーを取得
        if ($request->has('key')) {
            $search_key = $request->query('key');
            setOld('key', $request->query('key'));
        }
        // フォルダIDを取得
        if ($request->has('folder_id')) {
            $folder = Folder::findOrFail($request->query('folder_id'));
            // Folderのメソッドで
            // 検索キーとフォルダIDから記事データを取得
            $newsData = $folder->getClippings($search_key)->paginate(5);
            $newsData = $folder->addId($newsData);
        } else {
            $folders = $request->user()->folders;
            $folderIds = $folders->pluck('id');
            // dd($folderIds);
            $newsData = Article::getClippingsFromFolderIds($search_key, $folderIds)
            ->orderBy('created_at', 'desc')->paginate(5);
            foreach ($folders as $oneFolder) {
                $newsData = $oneFolder->addIdIfExist($newsData);
            }
        }
        // ☆評価を取得して追加
        $newsData =$articleManager->decorateArticles($request->user(), $newsData, false);
        // フォルダリストを取得
        $folderList = $articleManager->getFolderList($request->user());
        // dd($folder);
        // フォルダリストと整理したデータをviewに渡す
        return view('pages.clip_news', [
            'newsData'=> $newsData,
            'folderList'=>$folderList,
            'folder'=>$folder
            ]);
    }

    public function print(Request $request, PrinterService $printer)
    {
        $newsData = [];
        $folder = null;
        $search_key = '';
        // あれば検索キーを取得
        if ($request->has('key')) {
            $search_key = $request->query('key');
        }
        // フォルダIDを取得
        if ($request->has('folder_id') && !empty($request->query('folder_id'))) {
            $folder = Folder::findOrFail($request->query('folder_id'));
            // Folderのメソッドで
            // 検索キーとフォルダIDから記事データを取得
            $newsData = $folder->getClippings($search_key)->get()->all();
        } else {
            $folders = $request->user()->folders;
            foreach ($folders as $key => $eachfolder) {
                $articles = $eachfolder->getClippings($search_key)->get();
                if ($articles) {
                    $newsData =array_merge($newsData, $articles->all());
                }
            }
        }
        $printData = $newsData;
            
        $headers = array_keys($printData[0]->toArray());

        // news_list.xlsxに書き込む
        return $printer->exportEXCEL($printData, $headers);
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
    public function store(Request $request)
    {
        $folder = Folder::find($request->input('folder_id'));
        
        $result = $folder->clipArticle($request->input('article_id'), $request->input('old_folder_id'));

        if ($result) {
            $request->session()->flash('success', 'フォルダに保存しました');
        } else {
            $request->session()->flash('failure', 'フォルダに保存できませんでした。');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, ArticleManager $articleManager)
    {
        // 記事IDから記事データを取得
        $article = Article::with(['comments','comments.user'])->findOrFail($id);
        // ☆評価を取得して追加
        // ユーザのフォルダに記事があるか、あればフォルダIDを追加
        $article =$articleManager->decorateArticle($request->user(), $article);
        $folder = Folder::find($article->folderId);
        // フォルダリストを取得
        $folderList = $articleManager->getFolderList($request->user());
        // 閲覧履歴に追加
        $request->user()->addHistory($article->id);
        // dump($article);
        // コメントデータ、フォルダリストと整理したデータをviewに渡す
        return view('pages.clip_article', [
            'article'=> $article,
            'folderList'=>$folderList,
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
    public function destroy(Request $request)
    {
        // 記事IDから記事データを取得
        $article = Article::findOrFail($request->input('article_id'));

        $article->delete();

        return redirect('/clippings')->with('success', 'クリップ記事を削除しました。');
    }
}
