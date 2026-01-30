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
<div class="item__inner">
    <div class="item__tab">
        <form action="/" method="get">
            <input type="hidden" name="tab" value="recommend" class="tab-input">
            <button class="tab-label item__tab-recommend @if (isset($tab) && $tab === "recommend") tab-checked @endif">おすすめ</button>
        </form>
        <form action="/" method="get">
            <input type="hidden" name="tab" value="mylist">
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <button type="submit" class="tab-label item__tab-mylist @if (isset($tab) && $tab === "mylist") tab-checked @endif">
                マイリスト
            </button>
        </form>
    </div>

    <div class="item__content">
        
        <div class="flex__item wrap">
            @foreach($items as $item)
            <a class="item__card-box" href="/item/{{ $item->id }}">
                <div class="item__card">
                    <div class="card__img">
                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="" />
                        <!-- soldラベル -->
                        @if (!empty($item->orders))
                            @foreach ($item->orders as $order)
                                @if ($order->status === "complete")
                                <div class="sold-label">SOLD</div>
                                @endif
                            @endforeach
                        @endif
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