@extends('layouts.app')

@section('content')
    {{--    @foreach($cardData as $item)--}}
    {{--        {{$item->rowId}}--}}
    {{--    @endforeach--}}
    <div class="card-group">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    Корзина
                    <a href="" class="ml-5"><i class="fa fa-remove"></i> Очистить корзину</a>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="card-body">
                        <div class="cart-items">
                            <div class="cart-item items__head row">
                                <div class="col-5">Товар</div>
                                <div class="col">Цена</div>
                                <div class="col">Количество</div>
                                <div class="col">Сумма</div>
                            </div>
                            @foreach($cartData as $item)
                                <div class="cart-item row">
                                    <div class="col-5">{{$item->name}}</div>
                                    <div class="col">{{$item->price}}</div>
                                    <div class="col">
                                        <div class="quantity">
                                            <div class="row">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-dark plus-btn plusmin"><i
                                                        class="fa fa-plus"></i></button>
                                                <input type="text" value="1" class="popup-stuff__count-value" readonly>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-dark minus-btn plusmin"><i
                                                        class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">100500</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cart-total">
<div class="row">
    <div class="col">Итого:</div>
    <div class="col">100500</div>
</div>
                        <button class="btn btn-lg btn-dark">Оформить</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
