<button class="btn {{ ($article->folderId) ? 'btn-success': 'btn-secondary' }} btn-sm clip-modal-open" type="button" 
data-id="{{ $article->id }}" data-folder-id="{{ ($article->folderId) ? $article->folderId: '' }}"
data-toggle="modal" data-target="#folder-selection-dialog">
    <i class="fa fa-bookmark"></i>
</button> 