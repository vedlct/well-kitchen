@extends('layouts.layout')
@section('container')
    <div class="welcome-area pt-100 pb-95">
        <div class="container">
            <div class="welcome-content text-center">
                <h5 class="mb-5">Order details </h5>
                {{-- <h1>Welcome To WellKitchen</h1> --}}
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo consequat irure </p> --}}
                <div class="row">
                    @foreach ($orderedItem as $item)
                        {{-- @dd($item); --}}
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('admin/public/featureImage/' . $item->sku->product->featureImage) }}"
                                        style="width:50%" alt="">
                                    <h5 class="card-title">{{ $item->sku->product->productName }}</h5>
                                    @if (isset($item->order->promo))
                                        {{-- @dd('ok'); --}}
                                        @php
                                            
                                            $discouontAmount = $item->order->promo->discount;
                                            $amountReduce = ($item->sku->salePrice * $discouontAmount) / 100;
                                            $actualPrice = $item->sku->salePrice - $amountReduce;
                                            
                                        @endphp
                                    @endif

                                    <h5> <b>&#2547;</b> {{ $actualPrice }} x {{ $item->quiantity }}</h5>
                                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
