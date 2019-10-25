@extends('layouts.app')

@section('content')
    {{--    @foreach($cardData as $item)--}}
    {{--        {{$item->rowId}}--}}
    {{--    @endforeach--}}
    <div class="card-group main-cart-page" id="main-cart" data-url="{{route('cart.all')}}">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col" >
                        <h5>Корзина</h5>
{{--                        <i class="fa fa-border fa-shopping-cart"></i>--}}
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-warning ml-5 removeAll" {{count($cartData)>0 ? '' : 'hidden'}}>
                        Очистить корзину
                    </button>
                </div>
            </div>
            <div class="row">
                @if(count($cartData)>0)
                    <div class="col-9">
                        <div class="card-body">
                            <div class="cart-items" id="cart_items" data-source="{{route('cart.removeAll')}}">
                                <div class="items__head row">
                                    <div class="col-5">Товар</div>
                                    <div class="col">Цена</div>
                                    <div class="col">Количество</div>
                                    <div class="col">Сумма</div>
                                </div>
                                @foreach($cartData as $item)
                                    <div class="cart-item row">
                                        <div class="col-5">
                                            <div class="clear">
                                                <img src="https://s.fotorama.io/1.jpg" class="img-thumbnail rounded" style="width: 150px">
                                                {{$item->description}}
                                            </div>
                                        </div>
                                        <div class="col price-col">{{$item->price}}</div>
                                        <div class="col">
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
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col">
                        Товаров нет в корзине
                    </div>
                @endif
                @if(count($cartData)>0)
                    <div class="col-3 cart-total">
                        <div class="row">
                            <div class="col">Итого:</div>
                            <div class="col">
                                <span id="total"></span>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-dark">Оформить</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
