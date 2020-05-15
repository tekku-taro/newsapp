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
                                            <td>{{ $newsSite->details }}</td>
                                            <td>{{ $newsSite->category->name }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button class="btn btn-secondary" type="button">編集</button>
                                                    <button class="btn btn-danger" type="button">削除</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>AP通信</td>
                                        <td>http://ap tuchin</td>
                                        <td>時事</td>
                                        <td>国際ニュース配信</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('news_sites.edit',['id'=>$newsSite->id]) }}" class="btn btn-secondary"></a>
                                                {{-- <button class="btn btn-secondary" type="button">編集</button> --}}
                                                <form action="{{ route('news_sites.destroy', ['id' => $newsSite->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">削除</button>
                                                </form>
                                            </div>                                            
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        {{ $newsSites->links() }}
                        {{-- <nav style="margin-top: 22px;">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                            </ul>
                        </nav> --}}
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
    </div>
    
@endsection