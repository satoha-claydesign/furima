@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
@endsection

@section('content')
<h1>商品詳細</h1>
<div class="purchase__inner">
    <div class="order-group">
        <div class="item-group">
            <div class="item__image">
                <img src="{{ asset('storage/images/' . $item->image) }}" alt="" />
            </div>
            <div class="item__info">
                <!-- 商品名 -->
                <h2 class="item__info-title">{{ $item->name }}</h2>
                <!-- 値段 -->
                <p class="item__info-price">¥ {{ $item->price }} <span>（税込）</span></p>
            </div>
        </div>
        <div class="payment-group">
            <h2>お支払い方法</h2>
            <form action="/payment/{id}" method="post" class="payment-form">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <select class="form__category__item-select" name="payment" id="payment" onchange="this.form.submit()">
                    <option type="hidden">選択してください</option>
                    <option @if (!empty($payment)) @if($payment === "1") selected @endif @endif value="1">
                        コンビニ払い
                    </option>
                    <option  @if (!empty($payment)) @if($payment === "2") selected @endif @endif value="2">
                        クレジットカード払い
                    </option>
                </select>
            </form>
        </div>
        <div class="address-group">
            <div class="address-group-title">
                <h2>配送先</h2>
                <form action="/purchase/{id}/address" method="get">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="address-change" href="/purchase/{id}/address" type="submit">変更する</button>
                </form>
            </div>
            <div class="profile__address">
                <p class="profile__info-title">〒 @if (!empty($order->order_postalCode)) {{ $order->order_postalCode }}
                                                @else {{ $user->profile->postalCode }}
                                                @endif</p>
                <p class="profile__info-title">@if (!empty($order->order_address)) {{ $order->order_address }}
                                                @else {{ $user->profile->address }}
                                                @endif</p>
                <p class="profile__info-title">@if (!empty($order->order_building)) {{ $order->order_building }}
                                                @else {{ $user->profile->building }}
                                                @endif</p>
            </div>
        </div>
    </div>
    <div class="purchase-group">
        <table class="purchase-box">
            <tr>
                <th>商品代金</th>
                <td class="item__info-price">¥ {{ $item->price }} <span>（税込）</span></td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td>@if (!empty($order))
                        @if($order->payment === "1")
                            コンビニ払い
                        @elseif($order->payment === "2")
                            クレジットカード払い
                        @else
                            未選択
                        @endif
                    @endif
                </td>
            </tr>
        </table>
        <form action="/complete/{id}" method="post">
            @csrf
            @method('PATCH')
                <div class="purchase-form__btn-inner">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button class="show-form__send-btn btn" type="submit">購入する</button>
                </div>
            </form>
    </div>
</div>
@endsection