<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Service\ArticleManager;

class ExternalWebController extends Controller
{
    // url先のウェブコンテンツを取得する
    public function show(Request $request, $article_id, ArticleManager $articleManager, Article $article)
    {
        $article = Article::findOrFail($article_id);
        // dd($url);
        $originalPage = $articleManager->getOriginalPage($article->url);
        // Articleメソッドで読書時間を計測
        $readingLength = $article->calcReadingLength($originalPage);

        return response()->json(
            [
                'originalPage' => $originalPage,
                'readingLength' => $readingLength
            ]
        );
    }
}
