@extends('layouts.app')

@section('title','NewsApp')

@section('content')
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
                <h3>最新ヘッドライン&nbsp;<small>{{ (new DateTime())->format('Y/m/d') }}</small></h3>
                <div class="row articles">
                    @foreach ($tierOne as $article)
                    <div class="col-sm-6 col-md-6 item">
                        <a href="{{ route('news.show',[$article->id]) }}"><img class="img-fluid" src="{{ $article->url_to_image }}"></a>
                        <h5 class="name">{{ $article->title }}</h5>
                        <p class="text-secondary">{{ ($article->newsSite->category()->exists())?
                            $article->newsSite->category->name_jp : '' }}</p>
                        <p class="description">{{ $article->description }}</p><a class="action" href="#"></a>
                    </div>
                        
                    @endforeach
                </div>
                <div class="row articles">
                    @foreach ($tierTwo as $article)
                    <div class="col-sm-6 col-md-4 item">
                        <a href="{{ route('news.show',[$article->id]) }}"><img class="img-fluid" src="{{ $article->url_to_image }}"></a>
                        <h5 class="name">{{ $article->title }}</h5>
                        <p class="text-secondary">{{ ($article->newsSite->category()->exists())?
                            $article->newsSite->category->name_jp : '' }}</p>
                        <p class="description">{{ $article->description }}</p><a class="action" href="#"></a>
                    </div>                        
                    @endforeach
                </div>
            </section>
            <hr>
            <section>
                <div class="row">
                    <div class="col-md-6 offset-md-0">
                        <h4>新着コメント</h4>
                        <ul class="list-group" id="commentlist">
                            @foreach ($comments as $comment)
                            <li class="list-group-item">
                                <h6><a href="{{ route('news.show',[$comment->article->id]) }}">{{$comment->article->title}}</a></h6>
                                <div class="media">
                                    <div><span><i class="fa fa-user-circle-o"></i></span></div>
                                    <div class="media-body">
                                        <h5>{{ $comment->user->name }}<small>{{ $comment->created_at }}</small></h5>
                                        <p>{{ $comment->title }}</p>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                            </li>                                
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4>閲覧履歴</h4>
                        <div class="card history-card">
                            @foreach ($histories as $history)
                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="{{ route('news.show',[$history->id]) }}">{{ $history->title }}</a>
                                </h6>
                                <h5 class="text-muted card-subtitle mb-2">
                                    {{ $history->newsSite->name }}
                                    <small>{{ $history->pivot->created_at }}</small>
                                </h5>
                                <p class="card-text">{{ $history->description }}</p>
                            </div>                                
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>    
@endsection