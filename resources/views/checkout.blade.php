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
                                <select name="fkshipment_zoneId" id="zone" class="zone" onchange="shippingZone()">
                                    <option value="" selected>Select</option>
                                    @foreach ($shipmentZone as $item)
                                    <option value=" {{$item->shipment_zoneId}} "> {{$item->shipment_zoneName}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="searchPhone">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="firstName">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="lastName">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Email Address</label>
                                <input type="text" name="email" id="email">
                            </div>
                        </div>
                       
                        <div class="col-lg-12">
                            <div class="billing-info mb-20">
                                <label>Street Address</label>
                                <input class="billing-address" placeholder="House number and street name" type="text" name="billingAddress" id="billingAddress">
                                {{-- <input placeholder="Apartment, suite, unit etc." type="text" name="address"> --}}
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
                        <input class="checkout-toggle" type="checkbox">
                        <span>Ship to a different address?</span>
                    </div>
                    <div class="different-address open-toggle mt-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Street Address</label>
                                    <input class="billing-address" placeholder="House number and street name" type="text" name="shippingAddress">
                                    <input placeholder="Apartment, suite, unit etc." type="text" name="shippingAddress">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        $(document).ready(function () {
        $( ".searchPhone" ).autocomplete({

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
            minLength: 1
            });
        }); 


        $("#phone").keydown(function(){
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
                console.log('res',data);
                $('#email').val(data.user.user.email);
                $('#firstName').val(data.user.user.firstName);
                $('#lastName').val(data.user.user.lastName);
                $('#billingAddress').val(data.user.address.billingAddress);
                // $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
                toastr.success('Customer found with this phone')
            },
            error:(response)=>{
                toastr.error('Customer not found with this phone')
            }
        });
            
        });
   
    
    </script>
@endsection