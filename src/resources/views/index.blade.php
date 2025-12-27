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
<div class="item__tab">
    <p class="item__tab-recommend">おすすめ</p>
    <p class="item__tab-mypage"><a href="/mylist">マイリスト</a></p>
</div>
<div class="item__inner">
    <div class="item__content">
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
    <div class="page__parts">
    </div>
  </div>
</div>
@endsection