<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;

class FoldersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // nameを受け取り、フォルダを新規作成

        $request->validate([
            'name'=>'required|string|max:191'
        ]);
     
        $folder = $request->user()->folders()->create($request->all());

        return back()->with('success', 'フォルダを新規作成しました。');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //idを受け取り該当するフォルダに記事があるか確認無ければ削除
        $folder = Folder::find($request->input('folder_id'));

        if ($folder->articles()->count() > 0) {
            return back()->with('failure', 'このフォルダ内に記事があるので削除できませんでした。');
        }

        $folder->delete();

        return back()->with('success', 'フォルダを削除しました。');
    }
}
