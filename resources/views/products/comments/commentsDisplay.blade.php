@foreach($comments as $comment)
    <div class="card-body"
         @if($comment->parent_id != null)
            style="margin-left:40px;"
        @endif
    >
        <p>{{ $comment->comment }}</p>
        <small class="text-muted">Posted by {{$comment->user->getFullName()}}</small>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('products.comments.addComment', $product) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" />
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


{{--                                        @foreach($product->comments as $comment)--}}
{{--                                            <div class="card-body">--}}
{{--                                                <p>{{$comment->comment}}</p>--}}
{{--                                                <small class="text-muted">Posted by {{$comment->user->getFullName()}}</small>--}}
{{--                                                <hr>--}}
{{--                                                <a href="#" class="btn btn-success">Leave a Review</a>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
