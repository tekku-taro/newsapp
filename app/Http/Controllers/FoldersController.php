<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

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
        // nameを受け取り、フォルダを新規作成

        $request->validate([
            'name'=>'required|string|max:191'
        ]);
     
        $folder = $request->user()->folders()->create($request->all());

        return back()->with('success', 'フォルダを新規作成しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

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
        //idを受け取り該当するフォルダに記事があるか確認無ければ削除
        $folder = Folder::find($request->input('folder_id'));

        if ($folder->articles()->count() > 0) {
            return back()->with('failure', 'このフォルダ内に記事があるので削除できませんでした。');
        }

        $folder->delete();

        return back()->with('success', 'フォルダを削除しました。');
    }
}
