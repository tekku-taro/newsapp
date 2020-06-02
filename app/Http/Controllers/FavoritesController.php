<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stars'=>'required|int',
            'article_id'=>'required|int',
        ]);

        $stars = $request->input('stars');
        $articleId = $request->input('article_id');

        $request->user()->addFavorite($articleId, $stars);
        $request->session()->flash('success', '☆評価を保存しました');


        return back();
    }
}
