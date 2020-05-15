<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsSite;

class NewsSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsSites = NewsSite::paginate(10);
        return view('pages.news_sites', ['newsSites'=>$newsSites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.create_site');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|password',
        ]);

        NewsSite::create($request->all());

        return redirect('/news_sites')->with('success', '新規ユーザを登録しました。');
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
    public function edit($id)
    {
        $newsSite = NewsSite::findOrFail($id);

        return view('pages.edit_site', ['newsSite'=>$newsSite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|password',
        ]);
        $newsSite = NewsSite::findOrFail($id);
        $newsSite->fill($request->all())->save();

        return redirect('/news_sites')->with('success', 'ユーザ情報を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsSite = NewsSite::findOrFail($id);
        $newsSite->delete();

        return redirect('/news_sites')->with('success', 'ユーザを削除しました');
    }
}
