@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Some filters</h1>
            {{--            <div class="list-group">--}}
            {{--                <a href="#" class="list-group-item">Category 1</a>--}}
            {{--                <a href="#" class="list-group-item">Category 2</a>--}}
            {{--                <a href="#" class="list-group-item">Category 3</a>--}}
            {{--            </div>--}}

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">
                @foreach($products as $product)
                    {{--{{dd($product)}}--}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="{{route('product.show', $product)}}"><img class="card-img-top"
                                                                               src="http://placehold.it/700x400" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{route('product.show', $product)}}">{{$product->title}}</a>
                                </h4>
                                <h5>{{$product->price}}</h5>
                                <p class="card-text">
                                    @foreach($product->category as $category)
                                        <a href="#" class="badge badge-info">{{$category->name}}</a>
                                    @endforeach
                                    {{--                                    {{$product->description}}--}}
                                </p>
                                <select class='main_rating' id='main_rating_{{$product->id}}'>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <script type='text/javascript'>
                                    $(function () {
                                        $('#main_rating_{{$product->id}}').barrating('set',{{round($product->averageRating)}});
                                        $('#main_rating_{{$product->id}}').barrating('readonly', true);
                                    });
                                </script>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="fav-btn">
                                            <span
                                                class="favme favme_{{$product->id}} dashicons dashicons-heart fa fa-2x fa-heart"
                                                data-source="{{ route('product.favorites', $product) }}">
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-buy ml-5"
                                                    data-id="{{$product->id}}"
                                                    data-name="{{$product->title}}"
                                                    data-source="{{route('product.addToCart')}}"
                                            >Add to cart
                                            </button>
                                        </div>
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
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


