@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/mycart.css') }}" rel="stylesheet">
@endsection





@section('content')


        <div class="container">
            <h1 class="text-center font-weight-bold" style="font-size:1.2em; padding:24px 0px;">
                {{ Auth::user()->name }}さんのカートの中身
            </h1>
            <div class="row g-3 mt-5 mb-5">


                <p class="text-center">{{ $message??'' }}</p><br>
                @if($my_carts->isNotEmpty())
                @foreach($my_carts->unique('stock_id') as $my_cart)

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-img-top image-card image-card-1" style="background: url('/image/{{$my_cart->stock->imgpath}}')no-repeat center center; background-size:cover;">
                        </div>
                        <div class="card-body"> <span class="text-uppercase text-danger fw-bold fs-6">{{$my_cart->stock->name}}</span>
                            <h6 class="card-title text-dark mt-2">{{ number_format($my_cart->stock->fee)}}円</h6>
                            <p class="card-text">詳細</p>

                            <form action="/cartdelete" method="post">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $my_cart->stock->id }}">
                                <input type="submit" value="カートから削除する" class="original-button" style="border: none; color: #ffffff; background-color: #f44336">
                            </form>

                            <div class="mt-4 about d-flex justify-content-between align-items-center"> <span>By Prabhjot Singh</span> <span>On 12 Oct, 2020</span> <span>5 min read</span> </div>
                        </div>
                    </div>

                </div>

                @endforeach

                <!-- 変数-->
                <?php
                                $same_stock_id = $my_carts->where('stock_id', $my_cart->stock_id);
                ?>


                <!-- 注文小計-->
                <ul class="cul_area">
                    @foreach($my_carts->unique('stock_id') as $my_cart)

                    <!-- 同じ商品を選択された場合個数を足していく処理-->


                    <li style="">

                        <img class="col-2" src="/image/{{$my_cart->stock->imgpath}}" alt="" style="height: 60px; width: auto; padding-right: 10px">
                        <div class="desc col-5">
                            <p class="make">HITACH</p>
                            <p class="name">{{$my_cart->stock->name}}</p>
                            <p class="Stock_item">在庫あり</p>
                        </div>





                        <div class="price col-5">



                            <p>                                                                                                                                 <!-- 合計-->
                                {{ number_format($my_cart->stock->fee)}}円 x

                                <!-- 個数-->
                                {{ $my_cart->quantity }}


                                 = {{ number_format($my_cart->quantity * $my_cart->stock->fee) }}

                            </p>

                        </div>

                    </li>
                    @endforeach

                </ul>

                <!-- 合計金額を求める-->

                <div class="text-center p-2">
                    個数:{{$count}}個<br>
                    <p style="font-size:1.2em; font-weight:bold;">合計金額:{{number_format($sum)}}円</p>
                </div>
                <form action="/checkout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg text-center buy-btn" >購入する</button>
                </form>

                @else
                <p class="text-center">カートはからっぽです。</p>
                @endif



                   <a href="/">商品一覧へ</a>
            </div>
        </div>









@endsection
