@extends('layouts.app')

@section('css')
<link href="{{ asset('css/shop.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row g-3 mt-5 mb-5">
        @foreach($stocks as $stock)

        <div class="col-md-4">
            <div class="card">
                <div class="card-img-top image-card image-card-1" style="background: url('/image/{{$stock->imgpath}}')no-repeat center center; background-size:cover;">  </div>
                <div class="card-body"> <span class="text-uppercase text-danger fw-bold fs-6">{{$stock->name}}</span>
                    <h6 class="card-title text-dark mt-2">{{$stock->fee}}円</h6>
                    <p class="card-text" style="height: 20.8px; overflow: hidden;">{{($stock->detail)}}</p>

                    <form action="mycart" method="post">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                        <input type="number" placeholder="数値" value="1" name="quantity">

                            <input type="submit" value="カートに入れる" class="original-button" style="border: none; color: #ffffff;">


                    </form>
                    <div class="mt-4 about d-flex justify-content-between align-items-center"> <span>By Prabhjot Singh</span> <span>On 12 Oct, 2020</span> <span>5 min read</span> </div>
                </div>
            </div>

        </div>

        @endforeach
    </div>
        <div class="text-center" style="width: 200px;margin: 20px auto;">
            {{  $stocks->links()}}
        </div>

</div>

@endsection
