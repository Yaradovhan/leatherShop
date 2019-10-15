@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->getFullName() }}</strong>
        <p>{{ $comment->comment }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('products.comments.addComment', $product) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('products.comments.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
