@extends('layouts.app')

@section('title','News')

@section('content')
    <div class="d-flex" id="page-contents">
        @include('sidebars.news_menu')
        <main id="main" class="container contents mt-3 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('news.index') }}"><span>ニュース</span></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('news.index',['sources'=>$article->newsSite->id]) }}"><span>{{ $article->newsSite->name }}</span></a></li>
                                <li class="breadcrumb-item"><span>{{ $article->title }}</span></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right">{{ $article->published_at->format('Y/m/d') }}</p>
                    </div>
                </div>
                <h4>
                    <i class="fas fa-globe-americas"></i>
                    &nbsp;{{ $article->newsSite->name }}　{{ ($article->newsSite->category()->exists())? $article->newsSite->category->name_jp : '' }}
                </h4>
                <div class="row page-title">
                    <div class="col-sm-8">
                        <h2><a href="{{ $article->url }}">{{ $article->title }}</a> </h2>
                    </div>
                    <div class="col-sm-4 text-right">
                        <span class="badge comment-badge badge-light"><i class="fa fa-comments-o"></i>&nbsp; {{ $article->comments->count() }} 件</span>
                        <div class="btn-group" role="group">
                            @include('components.bookmark_button')  
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <p class="text-center"> <span class="by">執筆者<a href="{{ $article->newsSite->url }}">　{{ $article->author }}</a></span></p>
                    <figure><img class="img-fluid figure-img lozad" src="{{ $article->url_to_image }}">
                        <figcaption></figcaption>
                        <hr>
                        <section>
                            <div class="text">
                                <p class="lead">{{ $article->description }}</p>
                                <hr>
                                @include('components.original_article')                            
                            </div>
                        </section>
                    </figure>
                </div>
            </div>
            <hr>
            <h4 class="text-center">コメント</h4>
            <div class="container">
                @include('components.comment_list')

                <hr>
                @include('components.comment_form')
            </div>
        </main>
        @include('components.select_folder')
    </div>
    <div class="article-clean"></div>
    <script>
        var idForUrl = @json($article->id);
    </script>
@endsection