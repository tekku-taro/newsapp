@extends('layouts.app')

@section('title','Users')

@section('content')
<div class="d-flex" id="page-contents">
    @include('sidebars.users_menu')
    <main id="main" class="container contents mt-3 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><span>ユーザ設定</span></a></li>
                            <li class="breadcrumb-item"><span>一覧</span></li>
                        </ol>
                    </div>
                </div>
            </div>
            <section>
                <div class="row page-title">
                    <div class="col-sm-10">
                        <h2><i class="fas fa-globe-americas"></i>&nbsp;ユーザ　一覧</h2>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col">
                    <div class="table-responsive table-bordered">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ユーザ名</th>
                                    <th>Email</th>
                                    <th>コメント</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {{ ($user->comment_to_public)? "公開": "非公開" }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-secondary">編集</a>
                                                <form action="{{ route('users.destroy', [$user->id]) }}" method="post">
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
                    {{ $users->links() }}
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
