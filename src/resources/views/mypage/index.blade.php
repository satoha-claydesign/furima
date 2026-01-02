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
        <div class="mypage__list-tab">

        </div>
    </div>
@endsection