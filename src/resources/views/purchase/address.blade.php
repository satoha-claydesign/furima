@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}" />
@endsection

@section('content')
<h1>住所の変更</h1>
<div class="purchase__inner">
    <div class="order-group">
        <form action="/purchase/{id}/changeAddress" method="post">
            @method('PATCH')
            @csrf
        <div class="profile__info">
            <p class="profile__info-title">郵便番号</p>
            <input class="profile__info-input" name="order_postalCode" placeholder="0000000">
            <p class="form__error">
                @error('postalCode')
                {{ $message }}
                @enderror
            </p>
            <p class="profile__info-title">住所</p>
            <input class="profile__info-input" name="order_address" placeholder="〇〇県〇〇市">
            <p class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </p>
            <p class="profile__info-title">建物</p>
            <input class="profile__info-input" name="order_building" placeholder="〇〇ビル">
            <p class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>
    <div class="profile-form__btn-inner">
        <input type="hidden" name="order_id" value="{{ $order->id }}" />
        <input type="hidden" name="item_id" value="{{ $item->id }}" />
        <input class="profile-form__send-btn btn" type="submit" value="更新する" name="send">
    </div>
</form>

@endsection