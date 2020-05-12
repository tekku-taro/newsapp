@extends('layouts.app')

@section('title','NewsApp')

@section('contents')
<div class="d-flex" id="page-contents">
    @include('sidebars.news_menu')
    <main id="main" class="contents mt-3 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div></div>
                </div>
            </div>
            <section id="headline-section">
                <h3>最新ヘッドライン&nbsp;<small>2020/05/05</small></h3>
                <div class="row articles">
                    <div class="col-sm-6 col-md-6 item"><a href="#"><img class="img-fluid" src="assets/img/desk.jpg"></a>
                        <h5 class="name">記事タイトル</h5>
                        <p class="text-secondary">AP通信　政治</p>
                        <p class="description">記事要約<br>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus . . .<br></p><a class="action" href="#"></a></div>
                    <div class="col-sm-6 col-md-6 item"><a href="#"><img class="img-fluid" src="assets/img/building.jpg"></a>
                        <h5 class="name">記事タイトル<br></h5>
                        <p class="text-secondary">AP通信　政治</p>
                        <p class="description">記事要約<br>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus . . .<br></p><a class="action" href="#"></a></div>
                </div>
                <div class="row articles">
                    <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/desk.jpg"></a>
                        <h5 class="name">記事タイトル</h5>
                        <p class="text-secondary">AP通信　政治</p>
                        <p class="description">記事要約<br>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus . . .<br></p><a class="action" href="#"></a></div>
                    <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/building.jpg"></a>
                        <h5 class="name">記事タイトル<br></h5>
                        <p class="text-secondary">AP通信　政治</p>
                        <p class="description">記事要約<br>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus . . .<br></p><a class="action" href="#"></a></div>
                    <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/loft.jpg"></a>
                        <h5 class="name">記事タイトル<br></h5>
                        <p class="text-secondary">AP通信　政治</p>
                        <p class="description">記事要約<br>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus . . .<br></p><a class="action" href="#"></a></div>
                </div>
            </section>
            <hr>
            <section>
                <div class="row">
                    <div class="col-md-6 offset-md-0">
                        <h4>新着コメント</h4>
                        <ul class="list-group" id="commentlist">
                            <li class="list-group-item">
                                <h6><a href="#">国際ニュース記事１<br></a></h6>
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body">
                                        <h5>yamada taro<small>2020/04/21<br></small></h5>
                                        <p>注目の記事！</p>
                                        <p>これはコメント部分です。</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h6><a href="#">国際ニュース記事１<br></a></h6>
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body">
                                        <h5>yamada taro<small>2020/04/21<br></small></h5>
                                        <p>注目の記事！</p>
                                        <p>これはコメント部分です。</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h6><a href="#">国際ニュース記事１<br></a></h6>
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body">
                                        <h5>yamada taro<small>2020/04/21<br></small></h5>
                                        <p>注目の記事！</p>
                                        <p>これはコメント部分です。</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4>閲覧履歴</h4>
                        <div class="card history-card">
                            <div class="card-body">
                                <h4 class="card-title"><a href="#">記事タイトル<br></a></h4>
                                <h6 class="text-muted card-subtitle mb-2">BCC News<small>2020/04/21</small></h6>
                                <p class="card-text">記事の本文がここに入ります。</p>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><a href="#">記事タイトル<br></a></h4>
                                <h6 class="text-muted card-subtitle mb-2">BCC News<small>2020/04/21</small></h6>
                                <p class="card-text">記事の本文がここに入ります。</p>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><a href="#">記事タイトル<br></a></h4>
                                <h6 class="text-muted card-subtitle mb-2">BCC News<small>2020/04/21</small></h6>
                                <p class="card-text">記事の本文がここに入ります。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>    
@endsection