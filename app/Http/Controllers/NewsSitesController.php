<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
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
        $newsSites = NewsSite::whereNotNull('url')->paginate(10);
        return view('pages.news_sites', ['newsSites'=>$newsSites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = $this->getFormList();

        return view('pages.create_site', [
            'lists'=>$lists
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string',
            'url'=>'required|url'
        ]);

        NewsSite::create($request->all());

        return redirect('/news_sites')->with('success', '新規配信サイトを登録しました。');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsSite = NewsSite::findOrFail($id);

        $lists = $this->getFormList();
        // dd($lists);
        return view('pages.edit_site', [
            'newsSite'=>$newsSite,
            'lists'=>$lists
            ]);
    }

    protected function getFormList()
    {
        $data = [
            'countries' => Country::all()->pluck('name', 'id'),
            'categories' => Category::all()->pluck('name_jp', 'id')
        ];
        return $data;
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
            'url'=>'required|url',
        ]);
        $newsSite = NewsSite::findOrFail($id);
        $newsSite->fill($request->all())->save();

        return redirect('/news_sites')->with('success', '配信サイト情報を編集しました');
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

        return redirect('/news_sites')->with('success', '配信サイトを削除しました');
    }
}
