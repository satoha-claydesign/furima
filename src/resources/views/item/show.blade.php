@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}" />
@endsection

@section('content')
<h1>商品詳細</h1>
<div class="show__inner">
    <div class="show-group">
        <div class="show__image">
            <img src="{{ asset('storage/images/' . $item->image) }}" alt="" />
        </div>
        <div class="show__info">
            <!-- 商品名 -->
            <h2 class="show__info-title">{{ $item->name }}</h2>
            <!-- ブランド名 -->
            <p class="show__info-brand">{{ $item->brand }}</p>
            <!-- 値段 -->
            <p class="show__info-price">{{ $item->price }} 円 <span>（税込）</span></p>
            <div class="show__info-icons">
                <form class="show__form-likes" action="/likes" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button class="show__form__likes-mark" type="submit" value=""><img src="{{ asset('storage/images/likes_gray.png') }}" alt=""></button>
                </form>
                <img src="{{ asset('storage/images/comment_logo.png') }}" alt="">
            </div>
            <form action="">
                <div class="show-form__btn-inner">
                    <button class="show-form__send-btn btn" type="submit" name="id" value="{{ $item->id }}">購入手続き</button>
                </div>
            </form>
            <!-- 商品説明 -->
            <h3 class="show__info-title">商品説明</h3>
            <p class="show__info-description">{{ $item->description }}</p>
            <h3 class="show__info-title">商品情報</h3>
            <!-- カテゴリ -->
            <div class="show__info-category">
                <dd>カテゴリ</dd>
                <dt>
                    @foreach ($item->categories as $category)
                    <span>{{ $category->name }}</span>
                    @endforeach
                </dt>
                <dd>商品の状態</dd>
                <dt>
                    @if ($item['condition'] == 1)
                    1. 商品のお届けについて
                    @elseif ($item['condition'] == 2)
                    2. 商品の交換について
                    @elseif ($item['condition'] == 3)
                    3. 商品トラブル
                    @elseif ($item['condition'] == 4)
                    4. ショップへのお問い合わせ
                    @elseif ($item['condition'] == 5)
                    5. その他
                    @endif
                </dt>
            </div>
            <!-- コメント -->
            <h3 class="show__info-title">コメント</h3>
            <p class="show__info-comment"></p>
        </div>
    </div>
    <div class="show__description">
    
    
@endsection