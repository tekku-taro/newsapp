<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.users', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create_user');
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
            'password'=>'required|string|min:6',
        ]);
        $saveData = $request->all();

        $saveData['password'] = Hash::make($saveData['password']);

        
        User::create($saveData);

        return redirect('/users')->with('success', '新規ユーザを登録しました。');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.edit_user', ['user'=>$user]);
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
            'name'=>'required|string|min:3',
            'email'=>'required|email',
            'password'=>'sometimes|nullable|min:6',
        ]);
        $saveData = $request->all();
        if (!empty($saveData['password'])) {
            $saveData['password'] = Hash::make($saveData['password']);
        } else {
            unset($saveData['password']);
        }
        
        $user = User::findOrFail($id);
        $user->fill($saveData)->save();

        return redirect('/users')->with('success', 'ユーザ情報を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'ユーザを削除しました');
    }
}
