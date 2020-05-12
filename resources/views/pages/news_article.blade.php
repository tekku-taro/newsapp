@extends('layouts.app')

@section('title','News')

@section('contents')
    <div class="d-flex" id="page-contents">
        @include('sidebars.news_menu')
        <main id="main" class="contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><span>ニュース</span></a></li>
                                <li class="breadcrumb-item"><a href="#"><span>AP通信</span></a></li>
                                <li class="breadcrumb-item"><a href="#"><span>記事の題名</span></a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right">2020/04/21</p>
                    </div>
                </div>
                <h4><i class="fas fa-globe-americas" style="color: rgb(52,143,249);"></i>&nbsp;サイト名　カテゴリ</h4>
                <div class="row page-title">
                    <div class="col-sm-8">
                        <h2>記事の題名</h2>
                    </div>
                    <div class="col-sm-4 text-right"><span><span class="badge badge-light" style="margin-bottom: 10px;margin-right: 10px;"><i class="fa fa-comments-o" style="font-size: 35px;"></i>&nbsp; 5 件</span></span>
                        <div class="btn-group" role="group"><button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#folder-selection-dialog"><i class="fa fa-bookmark"></i></button><button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#rate-stars-dialog"><i class="fa fa-star rating-star" style="color: rgb(255,255,255);"></i><i class="fa fa-star rating-star" style="color: rgb(255,255,255);"></i><i class="fa fa-star rating-star" style="color: rgb(255,255,255);"></i></button></div>
                    </div>
                </div>
                <p>読み終えるまで　2 分</p>
            </div>
            <div class="container">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <p class="text-center"> <span class="by">執筆者<a href="#">　Author Name</a></span></p>
                    <figure><img class="img-fluid figure-img" src="assets/img/desk.jpg">
                        <figcaption>Caption</figcaption>
                        <hr>
                        <article>
                            <div class="text">
                                <p class="lead">Sed lobortis mi. Suspendisse vel placerat ligula. <span style="text-decoration: underline;">Vivamus</span> ac sem lac. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum
                                    vel in justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                                <hr>
                                <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac lacus. <strong>Ut vehicula rhoncus</strong> elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit <em>pulvinar dict</em> vel in justo. Vestibulum
                                    ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                                <p>Suspendisse vel placerat ligula. Vivamus ac sem lac. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo. Vestibulum ante ipsum primis in faucibus orci luctus
                                    et ultrices posuere cubilia Curae.</p>
                            </div>
                        </article>
                    </figure>
                </div>
            </div>
            <hr>
            <h4 class="text-center">コメント</h4>
            <div class="container">
                <div class="row">
                    <div class="col col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body d-flex justify-content-between">
                                        <h5>yamada taro</h5><small class="d-flex">2020/04/21<br></small></div>
                                </div>
                                <h6 class="text-muted card-subtitle mb-2">注目の記事！<br></h6>
                                <p>これはコメント部分です。</p><a class="card-link" href="#" style="color: rgb(149,56,56);font-size: 14px;">削除</a></div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body d-flex justify-content-between">
                                        <h5>yamada kuniko</h5><small class="d-flex">2020/04/21<br></small></div>
                                </div>
                                <h6 class="text-muted card-subtitle mb-2">注目の記事！<br></h6>
                                <p>これはコメント部分です。</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
                        <form method="post">
                            <h4 class="text-center">コメントフォーム</h4>
                            <div class="form-group row"><label class="col-form-label col-md-3" for="title">タイトル</label>
                                <div class="col col-md-9"><input class="form-control" type="text" id="title" name="title"><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                            <div class="form-group row"><label class="col-form-label col-md-3" for="comment-body">本文</label>
                                <div class="col col-md-9"><textarea class="form-control" id="comment-body" name="body" rows="6"></textarea><small class="form-text text-danger">Please enter a correct email address.</small></div>
                            </div>
                            <div class="form-group text-center"><button class="btn btn-primary" type="submit" style="padding: 6px 25px;">投稿</button></div>
                        </form>
                    </div>
                </div>
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
        <div class="modal fade" role="dialog" tabindex="-1" id="rate-stars-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">星評価をする</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group"><select class="form-control"><optgroup label="保存先フォルダ"><option value="1" selected="">☆</option><option value="2">☆☆</option><option value="3">☆☆☆</option><option value="4">☆☆☆☆</option></optgroup></select></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button><button class="btn btn-primary" type="submit">保存</button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="article-clean"></div>    
@endsection