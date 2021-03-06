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
                    <p class="card-text">{!! ($product->description) !!}</p>

                    @foreach($product->category as $category)
                        <p class="badge badge-info">{{$category->name}}</p>
                    @endforeach

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
                            $('#rating_{{$product->id}}').barrating('set',{{round($product->averageRating)}});
                        });
                    </script>
                    <div class="row">
                        <div class="col-auto mr-auto">Average Rating : <span
                                id='avgrating_{{$product->id}}'>{{substr($product->averageRating,0,3)}}</span></div>
                        <div class="col-auto">
                            @if(!$product->isInCart)
                                <button type="button"
                                        class="btn btn btn-outline-primary btn-buy"
                                        data-id="{{$product->id}}"
                                        data-name="{{$product->title}}"
                                        data-source="{{route('product.addToCart')}}"
                                >Add to cart
                                </button>
                            @else
                                <button type="button"
                                        class="btn btn btn-outline-secondary btn-buy"
                                        disabled
                                >Added to cart
                                </button>
                            @endif
                        </div>
                    </div>


                    <div class="fav-btn">
                        <span
                            class="favme favme_{{$product->id}} dashicons dashicons-heart fa fa-heart"
                            data-source="{{ route('product.favorites', $product) }}">
                        </span>
                    </div>
                    @auth
                        <script>
                            $(document).ready(function () {
                                var isFav = "{{$user->hasInFavorites($product->id)}}";
                                if (isFav) {
                                    $('.favme_{{$product->id}}').toggleClass('active');
                                }
                            })
                        </script>
                    @endauth
                </div>
            </div>

            @if(count($product->comments)>0)
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    @include('products.comments.commentsDisplay', ['comments' => $product->comments, 'product_id' => $product->id])
                </div>
            @endif

            <div class="pt-4">
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
