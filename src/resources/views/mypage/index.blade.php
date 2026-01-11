@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
<h1>mypage</h1>
<div class="mypage__inner">
    <div class="mypage__profile">
        <div class="mypage__profile-box">
            <div class="mypage__image-box">
                @if (!empty($user->profile->image))
                <img class="mypage__image" src="{{ asset('storage/images/profiles/' . $user->profile->image) }}" alt="" />
                @endif
            </div>
            <p class="mypage__profile-name">{{ $user->name }}</p>
        </div>
        <form action="/profile" method="get">
            @csrf
            <button type="submit" name="send" >プロフィールを編集</button>
        </form>
    </div>
    <div class="mypage__list">
        <div class="item__inner">
            <div class="item__tab">
                <form action="/recommend" method="get">
                    <input type="hidden" name="tab-group" id="tab1" checked class="tab-input">
                    <button for="tab1" class="tab-label item__tab-recommend">おすすめ</button>
                </form>
                <form action="/mylist" method="get">
                    <input type="hidden" name="tab-group" id="tab2" class="tab-input">
                    <button type="submit" for="tab2" class="tab-label item__tab-mypage">マイリスト</button>
                </form>
            </div>

            <div class="item__content" id="content1">
                <div class="flex__item wrap">
                    @foreach($items as $item)
                    <a class="item__card-box" href="/item/{{ $item->id }}">
                        <div class="item__card">
                            <div class="card__img">
                                <img src="{{ asset('storage/images/' . $item->image) }}" alt="" />
                            </div>
                            <div class="card__content">
                                <div class="tag">
                                    <p class="card__tag">{{$item->name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection