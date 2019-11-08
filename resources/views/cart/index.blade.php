@extends('layouts.app')

@section('content')

    {{--    @foreach($cardData as $item)--}}
    {{--        {{$item->rowId}}--}}
    {{--    @endforeach--}}
    <div class="card-group main-cart-page" id="main-cart" data-url="{{route('cart.all')}}">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <div class="card-header-cart">Корзина</div>
                        {{--                        <i class="fa fa-border fa-shopping-cart"></i>--}}
                    </div>
                    <button type="button"
                            class="btn btn-sm btn-outline-warning ml-5" id="removeAll">
                        Очистить корзину
                    </button>
                </div>
            </div>
            <div class="row justify-content-center" id="cartItems">
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="card-body">
                        <div class="cart-items" id="cart_items" data-source="{{route('cart.removeAll')}}">
                            <div class="items__head row">
                                <div class="col-6 col-md-6">Товар</div>
                                <div class="col col-md-2">Цена</div>
                                <div class="col col-md-2">Количество</div>
                                <div class="col col-md-2" style="text-align: right">Сумма</div>
                            </div>
                            @foreach($cartData as $item)
                                <div class="cart-item row mb-3">
                                    <div class="col-6">
                                        <div class="media">
                                            <i class="fa fa-remove mr-2 removeItem"
                                               data-source="{{route('cart.removeOne')}}"
                                               data-id="{{$item->rowId}}"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title="Remove this product"
                                            ></i>
                                            <a href="{{route('product.show', $item->id)}}"><img
                                                    class="mr-2" src="https://s.fotorama.io/1.jpg" style="width: 145px"></a>
                                            <div  class="media-body">
                                                {!! ($item->options['description']) !!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col price-col">{{$item->price}}</div>
                                    <div class="col col-md-2 d-flex justify-content-center">
                                        <div class="quantity">
                                            <div class="row">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-dark plus-btn plusmin"><i
                                                        class="fa fa-plus"></i></button>
                                                <input type="text" value="1"
                                                       class="popup-stuff__count-value counter"
                                                       data-count="1" data-price="{{$item->price}}" readonly>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-dark minus-btn plusmin"><i
                                                        class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{$item->price}}" class="sum" data-sum="1"
                                               readonly>
                                    </div>
                                </div>
                            @endforeach
                            {{--                            <div class="col-6">--}}
                            {{--                                <div class="media">--}}
                            {{--                                    <img src="https://s.fotorama.io/1.jpg" class="img-thumbnail mr-3" alt="..."--}}
                            {{--                                         style="width: 100px;">--}}
                            {{--                                    <div class="media-body">--}}
                            {{--                                        <h5 class="mt-0">Media heading</h5>--}}
                            {{--                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante--}}
                            {{--                                        sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra--}}
                            {{--                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue--}}
                            {{--                                        felis in faucibus.--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-11 col-sm-11 col-md-11 col-lg-3 col-xl-3 cart-total">
                    <div class="row">
                        <div class="col d-flex justify-content-center"><p>Итого:</p>
                            {{--                        <div class="col d-flex justify-content-center">--}}
                            <span id="total"></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-dark">Оформить</button>
                    </div>
                </div>
            </div>
            <div id="emptyCart" hidden>
                Корзина пуста
            </div>
        </div>
    </div>
@endsection
