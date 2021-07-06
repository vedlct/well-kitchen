@extends('layouts.layout')
@section('container')
<div class="checkout-area pt-95 pb-100">
    <div class="container">
          <form method="post" action="{{route('checkout.submit')}}">
            @csrf
            @isset($customer)
            <input type="hidden" name="fkcustomerId" value="{{$customer->customerId}}">
            @endisset
            
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                       <div class="col-lg-12">
                            <div class="billing-select mb-20">
                                <label>Delivery zone</label>
                                <select name="fkshipment_zoneId" id="zone" class="zone" onchange="shippingZone()" required>
                                    <option value="" selected>Select</option>
                                    @foreach ($shipmentZone as $item)
                                    <option value=" {{$item->shipment_zoneId}} "> {{$item->shipment_zoneName}} </option>
                                    @endforeach
                                    @error('fkshipment_zoneId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" @if(Auth::user()) value="{{Auth::user()->customer->phone}}" @endif class="searchPhone" required>
                                <p id="newphone"></p>
                                @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20">
                                <label>First Name</label>
                                <input type="text" name="first_name" @if(Auth::user()) value="{{Auth::user()->firstName}}" @endif id="firstName">
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20">
                                <label>Last Name</label>
                                <input type="text" name="last_name" @if(Auth::user()) value="{{Auth::user()->lastName}}" @endif id="lastName">
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Email Address</label>
                                <input type="text" name="email" @if(Auth::user()) value="{{Auth::user()->email}}" @endif id="email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Billing Address</label>
                                <input class="billing-address" placeholder="billing address" type="text" @if(Auth::user()->customer->address) value="{{Auth::user()->customer->address->billingAddress}}" @endif name="billingAddress" id="billingAddress">
                                @error('billingAddress')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        
                    </div>

                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                        </div>
                    </div>
                   
                    <div class="checkout-account mt-25">
                        <input class="checkout-toggle" type="checkbox" name="shipping">
                        <span>Ship to a different address?</span>
                    </div>
                    <div class="different-address open-toggle mt-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Shipping Address</label>
                                    <input class="billing-address" placeholder="Shipping address" @if(Auth::user()->customer->address) value="{{Auth::user()->customer->address->shippingAddress}}" @endif type="text" name="diffshippingAddress">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    {{-- @dd(\Cart::getContent()) --}}
                                    @foreach (\Cart::getContent() as $key=>$item)
                                    {{-- @dd($item->associatedModel->productName) --}}
                                    <li><span class="order-middle-left">{{$item->associatedModel->productName}}  X  {{$item->quantity}}</span> <span class="order-price">${{$item->price * $item->quantity}} </span></li>
                                    {{-- <li><span class="order-middle-left">Product Name  X  1</span> <span class="order-price">$329 </span></li> --}}
                                    @endforeach
                                </ul>
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Shipping</li>
                                    <li id='deliveryFee'> </li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li id="orderTotal">৳{{number_format(\Cart::getSubTotal())}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion element-mrg">
                                <div class="panel-group" id="accordion">
                                    <div class="panel payment-accordion">
                                        <div class="panel-heading" id="method-one">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#method1">
                                                    <input id="cod" type="hidden" name="payment" value="dbt" {{ old('payment') == 'dbt' ? 'checked' : '' }} />
                                                    Direct bank transfer
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="method1" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <p>Some notes here.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel payment-accordion">
                                        <div class="panel-heading" id="method-three">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#method3">
                                                    <input id="cod" type="hidden" name="payment" value="cod" {{ old('payment') == 'cod' ? 'checked' : '' }} />
                                                    Cash on delivery
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="method3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Some notes here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">

                        {{-- <a class="btn-hover">  Place Order</a> --}}
                        <button class="btn-hover"  type="submit">Place Order</button>
                    </div>
                </div>
            </div>
            
        </div>
        
    </form>
    </div>
</div>

@endsection

@section('js')
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}
    <script>

function shippingZone() {
            var shipping_zone = $('.zone').val();
            $.ajax({
                url: "{{ route('shippingZone.change') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    shipping_zone: shipping_zone,
                },
                success: function (data) {
                    console.log(data);
                    var deliveryFee = data['deliveryFee'];
                    var orderTotal = data['orderTotal'];
                    $('#deliveryFee').empty().append("<th style='padding: 10px; font-weight: bold; font-size: 14px; color: #000000;'>" + "Delivery Fee" + "</th>" + "<td>" + "<span class='total amount'>" + "৳" + deliveryFee + "</span>" + "</td>");
                    $('#orderTotal').empty().append("<span>" + orderTotal + "</span>");
                }
            });
        }

   
        $(".searchPhone" ).autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{url('autocomplete')}}",
                    data: {
                        term : request.term
                    },
                    dataType: "json",
                    success: function(data){
                        // console.log('data',data);
                        var resp = $.map(data,function(obj){
                            //console.log(obj.city_name);
                            return obj.phone;
                        });

                        response(resp);
                    }
                });
            },
            minLength: 0
            });
        


        $("#phone").keyup(function(){
            let phone = $('#phone').val();
            console.log(phone);
            $.ajax({
            type: "post",
            url: "{{route('search.user')}}",
            data:{
                _token:'{{csrf_token()}}',
                phone:phone
            },
            success: function (data) {
                if(data.customer != null ) {
                    $('#firstName').val(data.user.firstName);
                    $('#lastName').val(data.user.lastName);
                    $('#email').val(data.user.email);
                    $('#billingAddress').val(data.shippingAddress.billingAddress);
                    
                    document.getElementById("newphone").innerHTML = 'phone number matched and data found';
                    document.getElementById("newphone").style.color = "green";
                }
                
            }

        });
            
        });
   
    
    </script>
@endsection