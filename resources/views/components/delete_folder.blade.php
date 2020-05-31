<div class="modal fade" role="dialog" tabindex="-1" id="delete-folder-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">フォルダを削除する</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form id="folder-selection-form" action="{{ route('folders.destroy') }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">

                    <div class="form-group">
                        <select class="form-control" name="folder_id" id="folder-id">
                            <optgroup label="削除するフォルダ">
                                {{-- <option value="一時保存" selected="">一時保存</option> --}}
                                @foreach ($folderList as $folderId => $folderName)
                                <option value="{{ $folderId }}">{{$folderName}}</option>
                                @endforeach
                                {{-- <option value="14">This is item 3</option> --}}
                            </optgroup>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">閉じる</button>
                    <button class="btn btn-primary" type="submit">削除</button>
                </div>
            </form>
        </div>
    </div>
</div>
