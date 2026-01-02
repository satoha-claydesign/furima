@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@section('content')
<h1>プロフィール設定</h1>
<div class="profile__inner">

<form action="/mypage/update" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="profile-group">
        <div class="profile__image">
            @if (!empty($user->profile->image))
            <img src="{{ asset('storage/images/profiles/' . $user->profile->image) }}" alt="" />
            @else
            <img src="{{ asset('storage/images/profiles/aaa.jpg') }}" alt="" />
            @endif
            <div class="profile__image-info">
                <label for="form-image">画像を選択する</label>
                <input type="file" name="image" id="form-image">
            </div>
            <p class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="profile__info">
            <p class="profile__info-title">ユーザー名</p>
            <input class="profile__info-input" name="name" value="{{ $user->name }}">
            <p class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
            <p class="profile__info-title">郵便番号</p>
            @if (!empty($user->profile->postalCode))
            <input class="profile__info-input" name="postalCode" value="{{ $user->profile->postalCode }}">
            @else
            <input class="profile__info-input" name="postalCode" placeholder="0000000">
            @endif
            <p class="form__error">
                @error('postalCode')
                {{ $message }}
                @enderror
            </p>
            <p class="profile__info-title">住所</p>
            @if (!empty($user->profile->postalCode))
            <input class="profile__info-input" name="address" value="{{ $user->profile->address }}">
            @else
            <input class="profile__info-input" name="address" placeholder="〇〇県〇〇市">
            @endif
            <p class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </p>
            <p class="profile__info-title">建物</p>
            @if (!empty($user->profile->postalCode))
            <input class="profile__info-input" name="building" value="{{ $user->profile->building }}">
            @else
            <input class="profile__info-input" name="building" placeholder="〇〇ビル">
            @endif
            <p class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>
    <div class="profile-form__btn-inner">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <input class="profile-form__send-btn btn" type="submit" value="更新する" name="send">
    </div>
</form>

@endsection