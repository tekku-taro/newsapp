<button class="btn btn-warning btn-sm star-modal-open" type="button" 
data-id="{{ $article->id }}" data-stars="{{ ($article->stars) ? $article->stars: '' }}"
data-toggle="modal" data-target="#rate-stars-dialog">
    @if (!empty($article->stars))
        @for ($i = 0; $i < $article->stars; $i++)
        <i class="fa fa-star rating-star"></i>
        @endfor      
    @else                          
    <i class="fa fa-question rating-star"></i>
    @endif
</button>