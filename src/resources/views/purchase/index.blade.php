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
            <form action="/payment/{id}" method="post">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
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
                <a class="address-change" href="/purchase/{id}/address">変更する</a>
            </div>
            
            <div class="profile__address">
                <p class="profile__info-title">〒 {{ $user->profile->postalCode }}</p>
                <p class="profile__info-title">{{ $user->profile->address }}</p>
                <p class="profile__info-title">{{ $user->profile->building }}</p>
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
                <td>@if (!empty($payment))
                        @if($payment === "1")
                            コンビニ払い
                        @elseif($payment === "2")
                            クレジットカード払い
                        @else
                            未選択
                        @endif
                    @endif
                </td>
            </tr>
        </table>
        <form action="/purchase/{id}" method="get">
                <div class="purchase-form__btn-inner">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button class="show-form__send-btn btn" type="submit">購入する</button>
                </div>
            </form>
    </div>
</div>
@endsection