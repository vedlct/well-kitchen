@extends('layouts.layout')
@section('container')
<div class="collections-area pt-100 pb-95 ">
    <div class="container">
        @foreach($hotDeals as $hotDeal)
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="admin/public/settingImage/settingID.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$hotDeal->hotDeals_name}}</h5>
      <p class="card-text">{{$hotDeal->percentage}}%</p>
      <a href="{{route('offers.product', $hotDeal->hotDealsId)}}" class="btn btn-primary">Show all</a>
    </div>
  </div>
  @endforeach
    </div>
</div>
@endsection