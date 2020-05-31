<div class="modal fade" role="dialog" tabindex="-1" id="folder-selection-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">クリップフォルダを選択</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="folder-selection-form" action="{{ route('clippings.store') }}" method="post">
                @csrf
                <div class="modal-body">

                        <input type="hidden" name="article_id" id="article-id" value=""/>
                        <input type="hidden" name="old_folder_id" id="old-folder-id" value=""/>
                        <div class="form-group">
                            <select class="form-control" name="folder_id" id="folder-id">
                                <optgroup label="保存先フォルダ">
                                    {{-- <option value="一時保存" selected="">一時保存</option> --}}
                                    @foreach ($folderList as $folderId => $folderName)
                                    <option value="{{ $folderId }}" >{{$folderName}}</option>                                            
                                    @endforeach
                                    {{-- <option value="14">This is item 3</option> --}}
                                </optgroup>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" id="del-article-btn"  type="button">この記事を削除</button>

                    <button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button>
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </form>
            <form action="{{ route('clippings.destroy') }}" id="del-article-form" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="article_id" id="del-article-id" value=""/>
            </form>
        </div>
    </div>
</div>