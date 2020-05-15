@extends('layouts.app')

@section('title','Users')

@section('contents')
    <div class="d-flex" id="page-contents">
        @include('sidebars.users_menu')
        <main id="main" class="contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><span>ユーザ設定</span></a></li>
                                <li class="breadcrumb-item"><span>情報編集<br></span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h2 class="d-flex">&nbsp;<i class="fas fa-globe-americas" style="color: rgb(52,143,249);"></i>&nbsp;ユーザ 情報編集</h2>
                </div>
                <form method="post" action="{{ route('users.update', ['id' => $user->id]) }}" class="form">
                <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">更新</button></div>
                <h4 class="form-heading">基本情報</h4>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="name">名前</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" required><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="email">Email</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" required><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="password">パスワード</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="password" name="password" required><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="notes">備考</label>
                                <div class="col col-md-9"><textarea class="form-control" id="notes" name="notes" rows="6"> {{ $user->notes }}</textarea></div>
                            </div>
                        </div>
                    </div>
                    <h4 class="form-heading">アプリ設定</h4>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="comment-to-public">コメント・評価の設定</label>
                                <div class="col col-md-9">
                                    <select class="form-control" id="comment-to-public" name="comment_to_public" value="{{ $user->comment_to_public }}">
                                        <optgroup label="公開設定の選択">
                                            <option value="true" selected="">公開</option>
                                            <option value="false">非公開</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row page-title">
                        <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">更新</button></div>
                    </div>
                </form>
            </div>
        </main>
        <div class="modal fade" role="dialog" tabindex="-1" id="folder-selection-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">クリップフォルダを選択</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group"><select class="form-control"><optgroup label="保存先フォルダ"><option value="一時保存" selected="">一時保存</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button><button class="btn btn-primary" type="submit">保存</button></div>
                </div>
            </div>
        </div>
    </div>
    
@endsection