@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-5 pt-xl-4">
            <div class="fotorama product-slider">
                <img src="https://s.fotorama.io/1.jpg">
                <img src="https://s.fotorama.io/2.jpg">
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">{{$product->title}}</h3>
                    <h4>${{$product->price}}</h4>
                    <p class="card-text">{{$product->description}}</p>

                    <select class='rating' id='rating_{{$product->id}}' data-id='rating_{{$product->id}}'
                            data-source="{{ route('product.rating', $product) }}">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <script type='text/javascript'>
                        $(function () {
                            {{--console.log({{$product->averageRating}});--}}
                            $('#rating_{{$product->id}}').barrating('set',{{round($product->averageRating)}});
                        });
                    </script>
                    {{--                    Average Rating : <span id='avgrating_{{$product->id}}'>{{round($product->averageRating, 1)}}</span>--}}
                    Average Rating : <span
                        id='avgrating_{{$product->id}}'>{{substr($product->averageRating,0,3)}}</span>

                </div>

            </div>

            @if(count($product->comments)>0)
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    @include('products.comments.commentsDisplay', ['comments' => $product->comments, 'product_id' => $product->id])
{{--                    @foreach($product->comments as $comment)--}}
{{--                        <div class="card-body">--}}
{{--                            <p>{{$comment->comment}}</p>--}}
{{--                            <small class="text-muted">Posted by {{$comment->user->getFullName()}}</small>--}}
{{--                            <hr>--}}
{{--                            <a href="#" class="btn btn-success">Leave a Review</a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
            @endif
            <div>
                <form action="{{route('products.comments.addComment', $product->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="comment" required></textarea>
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add Comment"/>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
