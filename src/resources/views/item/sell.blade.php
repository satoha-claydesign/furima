@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}" />
@endsection

@section('content')
<h1>商品の出品</h1>
<div class="sell__inner">

<form action="/item/store" method="post" enctype="multipart/form-data">
    @csrf
    <div class="sell-group">
        <div class="sell__info">
            <h3 class="sell__info-title">商品画像</h3>
            <p class="sell__image-info">
                <label for="form-image">ファイルを選択する</label>
                <input type="file" name="image" id="form-image">
                <span class="select-image"></span>
            </p>
            <p class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </p>
            <h2 class="sell__info-title">商品詳細</h2>
            <h3 class="sell__info-title">カテゴリー</h3>
            <div class="sell__input--checkbox">
                @foreach ($allcategories as $allcategory)
                <input class="hidden-checkbox" type="checkbox" id="category_{{ $allcategory->id }}" name="allcategory_ids[]" value="{{ $allcategory->id }}">
                <label for="category_{{ $allcategory->id }}" ><span>{{ $allcategory->name }}</span></label>
                @endforeach
            </div>
            <p class="form__error">
                @error('allcategory_ids')
                {{ $message }}
                @enderror
            </p>
            <h3 class="sell__info-title">商品の状態</h3>
            <div class="sell__input--select">
                <select class="form__item-condition-select" name="condition">
                    <option value="" disabled selected hidden>選択してください</option>
                    <option value="1">良好</option>
                    <option value="2">目立った傷や汚れなし</option>
                    <option value="3">やや傷や汚れあり</option>
                    <option value="4">状態が悪い</option>
                </select>
            </div>
            <p class="form__error">
                @error('condition')
                {{ $message }}
                @enderror
            </p>

            <h2 class="sell__info-title">商品名と説明</h2>
            <h3 class="sell__info-title">商品名</h3>
            <input class="sell__info-input" name="name" value="" placeholder="商品名を入力">
            <p class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
            <h3 class="sell__info-title">ブランド</h3>
            <input class="sell__info-input" name="brand" value="" placeholder="ブランドを入力">
            <p class="form__error">
                @error('brand')
                {{ $message }}
                @enderror
            </p>
            <h3 class="sell__info-title">商品説明</h3>
            <textarea class="sell__info-input description-box" name="description" value="" placeholder="商品の説明を入力"></textarea>
            <p class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </p>
            <h3 class="sell__info-title">販売価格</h3>
            <div class="input-container">
                <span class="currency">¥</span>
                <input class="sell__info-input price-input" name="price" value="">
            </div>
            <p class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>
    <div class="sell-form__btn-inner">
        <input class="sell-form__send-btn btn" type="submit" value="出品する" name="sell">
    </div>
</form>
@endsection