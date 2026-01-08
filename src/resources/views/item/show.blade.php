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
            <p class="show__info-price">¥ {{ $item->price }} <span>（税込）</span></p>
            <div class="show__info-icons">
                <div class="show__likes">
                    <!--いいねボタンの作成 -->
                    @if(Auth::check())
                        <!--その投稿がいいねしているか判定 -->
                        @if (Auth::user()->likes()->where('item_id', $item->id)->exists())
                            <form class="show__form-likes" action="/item/{id}/dislikes" method="post">
                            @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button class="show__form__likes" type="submit" value=""><img class="show__form__likes-mark" src="{{ asset('storage/images/likes_red.png') }}" alt=""></button>
                            </form>
                        @else
                            <form class="show__form-likes" action="/item/{id}/likes" method="post">
                            @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button class="show__form__likes" type="submit" value=""><img class="show__form__likes-mark" src="{{ asset('storage/images/likes_gray.png') }}" alt=""></button>
                        </form>
                        @endif
                        <p>
                            @if ($item->likes_count)
                            {{ $item->likes_count }}
                            @else
                            0
                            @endif
                        </p>
                    @else
                        <p class="¥show__form-likes">
                            <button class="show__form__likes" type="" value=""><img class="show__form__likes-mark" src="{{ asset('storage/images/likes_gray.png') }}" alt=""></button>
                        </p>
                        <p>
                            @if ($item->likes_count)
                            {{ $item->likes_count }}
                            @else
                            0
                            @endif
                        </p>
                    @endif
                </div>
                <div class="show__comment">
                    <img class="show__form__comment-mark" src="{{ asset('storage/images/comment_logo.png') }}" alt="">
                    <p>1</p>
                </div>
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
                <dl>
                    <dt>カテゴリ</dt>
                    <dd>
                        @foreach ($item->categories as $category)
                        <span class="category-button">{{ $category->name }}</span>
                        @endforeach
                    </dd>
                    <dt>商品の状態</dt>
                    <dd>
                        @if ($item['condition'] == 1)
                        良好
                        @elseif ($item['condition'] == 2)
                        目立った傷や汚れなし
                        @elseif ($item['condition'] == 3)
                        やや傷や汚れあり
                        @elseif ($item['condition'] == 4)
                        状態が悪い
                        @endif
                    </dd>
                </dl>
            </div>
            <!-- コメント -->
            <h3 class="show__info-title">コメント</h3>
            <div class="show__users-comment">
                    @foreach ($userComments as $userComment)
                    <div class="comment-user">
                        <div class="comment__user-info">
                            @if (!empty($userComment['commentUserImage']))
                            <img class="comment__user-image" src="{{ asset('storage/images/profiles/' . $userComment['commentUserImage']) }}" alt="" />
                            @endif
                            <p class="comment__user-name">{{ $userComment['commentUserName'] }}</p>
                        </div>
                        <div class="comment__user-text">
                            {{ $userComment['commentBody'] }}
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="show__comment-input">
                <h4>商品へのコメント</h4>
                <form action="/item/{id}/comment" class="show-form__btn-inner" method="post">
                @csrf
                    <textarea type="text" name="body"></textarea>
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button class="show-form__send-btn btn" type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
    

@endsection