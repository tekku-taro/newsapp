@extends('layouts.app')

@section('title','NewsSites')

@section('contents')
    <div class="d-flex" id="page-contents">
        @include('sidebars.newssites_menu')
        <main id="main" class="contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('news_sites.index') }}"><span>配信サイト</span></a></li>
                                <li class="breadcrumb-item"><span>新規登録</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h2 class="d-flex">&nbsp;<i class="fas fa-globe-americas" style="color: rgb(52,143,249);"></i>&nbsp;配信サイト 新規登録</h2>
                </div>
                <form method="post" action="{{ route('news_sites.store') }}" class="form">
                <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">保存</button></div>
                <h4 class="form-heading">基本情報</h4>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="url">URL</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="url" name="url" required><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="name">サイト名称</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="name" name="name" required><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="details">詳細</label>
                                <div class="col col-md-9"><textarea class="form-control" id="details" name="details" rows="6"></textarea></div>
                            </div>
                        </div>
                    </div>
                    <h4 class="form-heading">WebAPI情報</h4>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="sources">ソース</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="sources" name="sources">
                                    <small class="form-text text-danger">Please enter a correct email address.</small>
                                </div>
                            </div>
                            <p style="font-size: 13px;color: rgb(46,88,130);">ソースか国名・カテゴリのどちらか入力必須</p>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="country">国名</label>
                                        <div class="col col-md-9"><input class="form-control" type="text" id="country" name="country"><small class="form-text text-danger">Please enter a correct email address.</small></div>
                                    </div>
                                    <div class="form-group row"><label class="col-form-label col-md-3" for="category">カテゴリ</label>
                                        <div class="col col-md-9">
                                            <select class="form-control" id="category" name="category">
                                                <optgroup label="カテゴリを選択">
                                                    <option value="business" selected="">ビジネス</option>
                                                    <option value="entertainment">This is item 2</option>
                                                    <option value="14">This is item 3</option>
                                                </optgroup>
                                            </select>
                                            <small
                                                class="form-text text-danger">Please enter a correct email address.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="pagesize">表示数</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="pagesize" name="pagesize"></div>
                            </div>
                            <div class="form-group row col-md-12"><label class="col-form-label col-md-3" for="page">ページ数</label>
                                <div id="page" class="col col-md-9" name="page"><input class="form-control" type="text" id="title" name="title"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row page-title">
                        <div class="col-sm-12 text-right"><button class="btn btn-primary btn-sm save-btn" type="submit">保存</button></div>
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