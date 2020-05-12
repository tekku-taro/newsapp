@extends('layouts.app')

@section('title','NewsClippings')

@section('contents')
    <div class="d-flex" id="page-contents-1">
        @include('sidebars.clip_menu')
        <main id="main-1" class="contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><span>クリップ記事</span></a></li>
                                <li class="breadcrumb-item"><a href="#"><span>科学</span></a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form class="form form-inline search-form"><div class="input-group">
                        <input class="form-control" type="search" placeholder="Search" name="text" />
                        <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                        </div>    
                        </div></form>
                    </div>
                </div>
                <section id="headline-section">
                    <div class="row page-title">
                        <div class="col-sm-10">
                            <h2>科学のフォルダ</h2>
                        </div>
                        <div class="col-sm-2 text-right">
                            <div class="btn-group" role="group"><button class="btn btn-warning btn-sm" type="button"><i class="fa fa-file-text" style="color: rgb(255,255,255);"></i></button></div>
                        </div>
                    </div>
                    <div class="card headline-card">
                        <div class="card-body">
                            <div class="media"><img class="mr-3" src="assets/img/Placeholder.png">
                                <div class="media-body">
                                    <h5><button class="btn btn-success btn-sm border rounded-circle" type="button" data-toggle="modal" data-target="#folder-selection-dialog"><i class="fa fa-check"></i></button><a href="#">国際ニュース２<small>2020/04/21</small></a></h5>
                                    <p
                                        class="text-secondary">政治</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus nisl ac diam feugiat, non vestibulum libero posuere. Vivamus pharetra leo non nulla egestas, nec malesuada orci finibus. </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="media"><img class="mr-3" src="assets/img/Placeholder.png">
                                <div class="media-body">
                                    <h5><button class="btn btn-success btn-sm border rounded-circle" type="button" data-toggle="modal" data-target="#folder-selection-dialog"><i class="fa fa-check"></i></button><a href="#">国際ニュース３<small>2020/04/21</small></a></h5>
                                    <p
                                        class="text-secondary">政治</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus nisl ac diam feugiat, non vestibulum libero posuere. Vivamus pharetra leo non nulla egestas, nec malesuada orci finibus. </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="media"><img class="mr-3" src="assets/img/Placeholder.png">
                                <div class="media-body">
                                    <h5><button class="btn btn-success btn-sm border rounded-circle" type="button" data-toggle="modal" data-target="#folder-selection-dialog"><i class="fa fa-check"></i></button><a href="#">国際ニュース４<small>2020/04/21</small></a></h5>
                                    <p
                                        class="text-secondary">政治</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus nisl ac diam feugiat, non vestibulum libero posuere. Vivamus pharetra leo non nulla egestas, nec malesuada orci finibus. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <div class="modal fade" role="dialog" tabindex="-1" id="create-folder-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">新規フォルダの作成</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group"><input class="form-control" type="text" placeholder="フォルダ名を入力"></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button><button class="btn btn-primary" type="button">保存</button></div>
                </div>
            </div>
        </div>
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
        <div class="modal fade" role="dialog" tabindex="-1" id="delete-folder-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">フォルダを削除する</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group"><select class="form-control"><optgroup label="削除するフォルダ"><option value="一時保存" selected="">一時保存</option><option value="13">This is item 2</option><option value="14">This is item 3</option></optgroup></select></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button><button class="btn btn-danger" type="submit">削除</button></div>
                </div>
            </div>
        </div>
    </div>    
@endsection