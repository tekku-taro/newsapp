<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // title,bodyを受け取り、Userメソッドで新規作成
        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string',
            'article_id'=>'required|int'
        ]);

        $result = $request->user()->createComment(
            $request->input('article_id'),
            $request->input('title'),
            $request->input('body')
        );

        if ($result) {
            $request->session()->flash('success', 'コメントを作成しました');
        } else {
            $request->session()->flash('failure', 'コメントを作成できませんでした。');
        }

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //idを受け取りUserメソッドで削除
        $comment = Comment::findOrFail($id);

        
        if ($comment->delete()) {
            $request->session()->flash('success', 'コメントを削除しました');
        } else {
            $request->session()->flash('failure', 'コメントを削除できませんでした。');
        }
        return back();
    }
}
