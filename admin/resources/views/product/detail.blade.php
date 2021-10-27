@extends('layouts.main')
@section('header.css')
   
@endsection
@section('main.content')
    
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
                  <!-- Product Images start -->
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4 class="card-title">Product Images</h4>
                              </div>
                              <div class="card-content collapse show">
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-lg-4 col-md-6">
                                              <!-- slider images here -->
                                      <div class="slick-slider">
                                          <div class="slider-for mb-2">
                                            @if (count($product->images)>0)
                                            <div class="item">
                                                <img src="{{url('public/productImages/'.$product->images->first()->image ?? 'default.jpg')}}" alt="product_small_img1"/>
                                            </div>
                                            @endif
                                           

                                              {{-- <div class="item">
                                                  <img src="{{url('public/productImages/23.png')}}" alt="product_small_img1"/>
                                              </div>
                                              <div class="item">
                                                  <img src="{{url('public/productImages/42.png')}}" alt="product_small_img1"/>
                                              </div>
                                              <div class="item">
                                                  <img src="{{url('public/productImages/48.png')}}" alt="product_small_img1"/>
                                              </div>
                                              <div class="item">
                                                  <img src="{{url('public/productImages/53.png')}}" alt="product_small_img1"/>
                                              </div> --}}
                                          </div>

                                          <div class="slider-nav">
                                            @if (count($product->images)>0)
                                            @foreach ($product->images as $key=>$item)
                                            <div class="small-item">
                                                <a href="#" class="product_gallery_item {{$key=='0' ? 'active' :''}} "
                                                data-image="{{url('public/productImages/'.$item->image)}}">
                                                <img src="{{url('public/productImages/'.$item->image)}}" alt="product_small_img1"/>
                                                </a>
                                             </div>
                                              
                                            @endforeach
                                          @endif
                                                  {{-- <div class="small-item">
                                                          <img src="{{url('public/productImages/17.png')}}" alt="product_small_img1"/>
                                                  </div>
                                                  <div class="small-item">
                                                      <img src="{{url('public/productImages/23.png')}}" alt="product_small_img1"/>
                                              </div>
                                                  <div class="small-item">
                                                      <img src="{{url('public/productImages/42.png')}}" alt="product_small_img1"/>
                                                          
                                                  </div>
                                                  <div class="small-item">
                                                      <img src="{{url('public/productImages/48.png')}}" alt="product_small_img1"/>
                                                  </div>
                                                  <div class="small-item">
                                                      <img src="{{url('public/productImages/53.png')}}" alt="product_small_img1"/>
                                              </div> --}}
                                          </div>
                                      </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Product Images end -->
                  <!-- product details start -->
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4 class="card-title">Product Description</h4>
                              </div>
                              <div class="card-content collapse show">
                                  <div class="card-body">
                                      <p>
                                          product details here
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- product details end -->

      </div>
    </div>
  </div>


@endsection

@section('footer.js')


    

@endsection

