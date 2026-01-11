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
<!-- <div class="item__tab">
    <p class="item__tab-recommend">おすすめ</p>
    <p class="item__tab-mypage"><a href="/mylist">マイリスト</a></p>
</div> -->
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
@endsection