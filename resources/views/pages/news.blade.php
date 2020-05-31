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
                                <li class="breadcrumb-item"><a href="{{ route('news.index',['sources'=>$newsSite->id]) }}"><span>{{ $newsSite->name }}</span></a></li>
                                <li class="breadcrumb-item"><span>ヘッドライン</span></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('news.index',['sources'=>$newsSite->id]) }}" class="form form-inline search-form">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search" name="key" value="{{ old('key') }}" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
                <section id="headline-section">
                    <div class="row page-title">
                        <div class="col-sm-10">
                            <h2>{{ (isset($newsSite->name))? $newsSite->name:"" }} のヘッドライン</h2>
                        </div>
                        <div class="col-sm-2 text-right">
                            <div class="btn-group" role="group">
                                <a class="btn btn-warning btn-sm" href="{{ route('news.print',['sources'=>$newsSite->id, 'key'=>old('key')]) }}">
                                    <i class="fa fa-file-text" style="color: rgb(255,255,255);"></i>
                                </a>
                                {{-- <button class="btn btn-warning btn-sm" type="button">
                                    <i class="fa fa-file-text" style="color: rgb(255,255,255);"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card headline-card">
                        @foreach ($newsData as $article)
                        <div class="card-body">
                            <div class="media"><img class="mr-3" src="{{ $article->url_to_image }}">
                                <div class="media-body">
                                    <h5 class="d-flex justify-content-between">
                                        <a href="{{ route('news.show',[$article->id]) }}">{{ $article->title }}<small>{{ $article->published_at }}</small></a>
                                        <div>
                                            <button class="btn {{ ($article->folderId) ? 'btn-success': 'btn-secondary' }} btn-sm clip-modal-open" type="button" 
                                            data-id="{{ $article->id }}" data-folder-id="{{ ($article->folderId) ? $article->folderId: '' }}"
                                            data-toggle="modal" data-target="#folder-selection-dialog">
                                                <i class="fa fa-bookmark"></i>
                                            </button>
                                        </div>
                                    </h5>
                                    <p class="text-secondary">{{ ($article->newsSite->category()->exists())?
                                        $article->newsSite->category->name_jp : '' }}</p>
                                    <p>{{ $article->description }}</p>
                                </div>
                            </div>
                        </div>                            
                        @endforeach

                    </div>
                    {{ $newsData->appends(Arr::except(Request::query(), ['page']))->links() }}
                </section>
            </div>
        </main>
        @include('components.select_folder')
    </div>

@endsection