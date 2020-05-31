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
                                <li class="breadcrumb-item"><a href="{{ route('news_sites.index') }}"><span>配信サイト</span></a></li>
                                <li class="breadcrumb-item"><span>一覧</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="row page-title">
                        <div class="col-sm-10">
                            <h2><i class="fas fa-globe-americas" style="color: rgb(52,143,249);"></i>&nbsp;配信サイト　一覧</h2>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive table-bordered">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>サイト名</th>
                                        <th>URL</th>
                                        <th>カテゴリ</th>
                                        <th>詳細</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsSites as $newsSite)
                                        <tr>
                                            <td>{{ $newsSite->name }}</td>
                                            <td>{{ $newsSite->url }}</td>
                                            <td>{{ (isset($newsSite->category))? $newsSite->category->name: '' }}</td>
                                            <td>{{ $newsSite->details }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('news_sites.edit',[$newsSite->id]) }}" class="btn btn-secondary">編集</a>
                                                    <form action="{{ route('news_sites.destroy', [$newsSite->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit" onclick="if(!confirm('本当に削除しますか？')){return false;}">削除</button>
                                                    </form>
                                                </div> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $newsSites->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    
@endsection