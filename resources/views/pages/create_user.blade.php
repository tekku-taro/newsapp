@extends('layouts.app')

@section('title','Users')

@section('content')
<div class="d-flex" id="page-contents">
    @include('sidebars.users_menu')
    <main id="main" class="container contents mt-3 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><span>ユーザ設定</span></a></li>
                            <li class="breadcrumb-item"><span>新規登録</span></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h2 class="d-flex">&nbsp;<i class="fas fa-globe-americas" style="color: rgb(52,143,249);"></i>&nbsp;ユーザ 新規登録</h2>
            </div>
            <form method="post" action="{{ route('users.store') }}" class="form">
                @csrf                
            <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">保存</button></div>
            <h4 class="form-heading">基本情報</h4>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="name">名前</label>
                            <div class="col col-md-9"><input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                @enderror
                            </div>                        
                        </div>
                        <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="email">Email</label>
                            <div class="col col-md-9"><input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror                                
                            </div>                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="password">パスワード</label>
                            <div class="col col-md-9"><input class="form-control" type="text" id="password" name="password" required>
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                @enderror                                
                            </div>                            
                        </div>
                        <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="notes">備考</label>
                            <div class="col col-md-9"><textarea class="form-control" id="notes" name="notes" rows="6">{{ old('notes') }}</textarea></div>
                        </div>
                    </div>
                </div>
                <h4 class="form-heading">アプリ設定</h4>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="comment-to-public">コメント・評価の設定</label>
                            <div class="col col-md-9">
                                <select class="form-control" id="comment-to-public" name="comment_to_public">
                                    <optgroup label="公開設定の選択">
                                        <option value="1" {{ (old('comment_to_public') == 1)? 'selected': '' }}>公開</option>
                                        <option value="0" {{ (old('comment_to_public') == 0)? 'selected': '' }}>非公開</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row page-title">
                    <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">保存</button></div>
                </div>
            </form>
        </div>
    </main>
</div>    
@endsection