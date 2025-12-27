@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<h1>商品登録</h1>
<div class="show__inner">
    <h2>商品登録</h2>

<form action="/store" method="post" enctype="multipart/form-data">
    @csrf
    <div class="show-group">
        <div class="show__info">
            <p class="show__info-title">商品名<span class="form__required">必須</span></p>
            <input class="show__info-input" name="name" value="" placeholder="商品名を入力">
            <p class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
            <p class="show__info-title">値段<span class="form__required">必須</span></p>
            <input class="show__info-input" name="price" value="" placeholder="値段を入力">
            <p class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </p>
            <p class="show__info-title">商品画像<span class="form__required">必須</span></p>
            <p class="show__image-info">
                <label for="form-image">ファイルを選択</label>
                <input type="file" name="image" id="form-image">
                <span class="select-image"></span>
            </p>
            <p class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </p>
            <p class="show__info-title">季節<span class="form__required">必須</span><span class="color-red">複数選択可</span></p>
            <div class="show__input--checkbox">
                @foreach ($allseasons as $allseason)
                <input class="show-checkbox" type="checkbox" name="allseason_ids[]" value="{{ $allseason->id }}" /><label>{{ $allseason->name }}</label>
                @endforeach
            </div>
            <p class="form__error">
                @error('allseason_ids')
                {{ $message }}
                @enderror
            </p>
            <div class="show__description">
            <p class="show__info-title">商品説明<span class="form__required">必須</span></p>
            <textarea class="show__info-input description-box" name="description" value="" placeholder="商品の説明を入力"></textarea>
            <p class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </p>
            </div>
        </div>
    </div>
    <div class="show-form__btn-inner">
        <a class="show-form__back-btn btn" href="/">戻る</a>
        <input class="show-form__send-btn btn" type="submit" value="商品登録" name="send">
    </div>
</form>
@endsection