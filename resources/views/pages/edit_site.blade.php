@extends('layouts.app')

@section('title','NewsSites')

@section('content')
    <div class="d-flex" id="page-contents">
        @include('sidebars.newssites_menu')
        <main id="main" class="container contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><span>配信サイト</span></a></li>
                                <li class="breadcrumb-item"><span>情報編集</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h2 class="d-flex">&nbsp;<i class="fas fa-globe-americas"></i>&nbsp;配信サイト 情報編集</h2>
                </div>
                <form method="post" action="{{ route('news_sites.update', [$newsSite->id]) }}" class="form">
                    @method('PUT')
                    @csrf
                <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">更新</button></div>
                <h4 class="form-heading">基本情報</h4>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="name">サイト名称</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="name" name="name" value="{{ $newsSite->name }}" required>
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div> 
                            </div>                           
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="url">URL</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="url" name="url" value="{{ $newsSite->url }}" required>
                                    @error('url')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                             
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="details">詳細</label>
                                <div class="col col-md-9"><textarea class="form-control" id="details" name="details" rows="6">{{ $newsSite->details }}</textarea></div>
                            </div>
                        </div>
                    </div>
                    <h4 class="form-heading">WebAPI情報</h4>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="sources">ソース</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="sources" name="sources" value="{{ $newsSite->sources }}">
                                    @error('sources')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                              
                            </div>
                            <p class="form-warning">ソースか国名・カテゴリのどちらか入力必須</p>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="country">国名</label>
                                        <div class="col col-md-9">
                                            <select class="form-control" id="country" name="country_id" >
                                                <optgroup label="国名の選択">
                                                    <option value="">--</option>
                                                    @foreach ($lists['countries'] as $id => $country)
                                                    <option value="{{ $id }}" {{ (isset($newsSite->country) && $newsSite->country->id == $id)? 'selected': '' }}>{{ $country }}</option>                                                        
                                                    @endforeach
                                                </optgroup>
                                            </select>                                            
                                            {{-- <input class="form-control" type="text" id="country" name="country" value="{{ $newsSite->country->code }}" required> --}}
                                            @error('country')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>                                     
                                    </div>
                                    <div class="form-group row"><label class="col-form-label col-md-3" for="category">カテゴリ</label>
                                        <div class="col col-md-9">
                                            <select class="form-control" id="category" name="category_id" >
                                                <optgroup label="カテゴリの選択">
                                                    <option value="">--</option>
                                                    @foreach ($lists['categories'] as $id => $category)
                                                    <option value="{{ $id }}" {{ (isset($newsSite->category) && $newsSite->category->id == $id)? 'selected': '' }}>{{ $category }}</option>                                                        
                                                    @endforeach
                                                </optgroup>
                                            </select>                                             
                                            {{-- <input class="form-control" type="text" id="category" name="category" value="{{ $newsSite->category->name }}" required> --}}
                                            @error('category')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="pagesize">表示数</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="pagesize" name="pagesize" value="{{ $newsSite->pagesize }}" required>
                                    @error('pagesize')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
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