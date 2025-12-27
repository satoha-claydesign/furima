@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo__alert">
    @if (session('message'))
    <div class="todo__alert--success">{{ session('message') }}</div>
    @endif @if ($errors->any())
    <div class="todo__alert--danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="product__inner">
    <div class="product__title">
        <h2>@if (isset($keyword)){{request('keyword')}}の @endif商品一覧</h2>
        <a class="product__add-button" href="/register">+ 商品を追加</a>
    </div>
    <div class="product__content">
        <div class="product__sidebar">
            <form class="keyword-search" action="/search" method="get">
                @csrf
                <input type="text" class="search-form__item-input keyword-input" name="keyword"
                        placeholder="商品名で検索" value="{{request('keyword')}}" />
                <div class="search-form__actions">
                <input class="product__search-button" type="submit" value="検索">
                </div>
            </form>
            <h3 class="sort-title">価格帯で表示</h3>
            <form action="/sort" method="get">
                @csrf
                <input type="hidden" name="keyword" value="{{request('keyword')}}" />
                <select class="search-form__item-input price-sort" name="order" onchange="this.form.submit()">
                <option value="hidden" >価格で並び替え</option>
                <option value="desc" >高い順に表示</option>
                <option value="asc" >低い順に表示</option>
                </select>
                <div class="sort__result-button">
                <span>
                    @if( $sortDirection == 'desc' ) 高い順に表示
                    @elseif( $sortDirection == 'asc' ) 低い順に表示
                    @endif
                </span>
                <a href="/">×</a>
                </div>
            </form>
        </div>
        <div class="product__list">
            <div class="flex__item wrap">
                @foreach($products as $product)
                <a class="product__card-box" href="/products/{{ $product->id }}">
                    <div class="product__card">
                        <div class="card__img">
                            <img src="{{ asset('storage/img/' . $product->image) }}" alt="" />
                        </div>
                        <div class="card__content">
                            <div class="tag">
                                <p class="card__tag">{{$product->name}}</p>
                                <p class="card__price">¥ {{$product->price}}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="page__parts">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection