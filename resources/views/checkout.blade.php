@extends('layouts.layout')
@section('container')
    <div class="checkout-area pt-95 pb-100">
        <div class="container">
            {{-- <div id="checkout_coupon" class="coupon-checkout-content" @if ($errors->first('couponCode')) style="display: block" @endif> --}}
            {{-- <h3 style="text-align: center;">Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3> --}}
            {{-- <div class="coupon-info" style="text-align: center;" > --}}
            {{-- <form action="{{route('promo.submit')}}" method="post"> --}}
            {{-- @csrf --}}
            {{-- <p class="checkout-coupon"> --}}
            {{-- <input type="text" class="code form-control" required name="promo_code" placeholder="Promo code" /> --}}
            {{-- <input type="submit" value="Apply Promo" /> --}}
            {{-- @if ($errors->has('promo_code')) --}}
            {{-- <div class="error text-danger"><strong>{{ $errors->first('promo_code') }}</strong></div> --}}
            {{-- @endif --}}
            {{-- </p> --}}
            {{-- </form> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <form method="post" class="testCupon" action="{{ route('checkout.submit') }}">
                @csrf
                @isset($customer)
                    <input type="hidden" name="fkcustomerId" value="{{ $customer->customerId }}">
                @endisset

                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="billing-select mb-20">
                                        <label>Delivery zone</label>
                                        <select name="fkshipment_zoneId" id="zone" class="zone"
                                            onchange="shippingZone()" required>
                                            <option value="" selected>Select</option>
                                            @foreach ($shipmentZone as $item)
                                                <option value=" {{ $item->shipment_zoneId }} ">
                                                    {{ $item->shipment_zoneName }} </option>
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
                                        <input type="text" name="phone" id="phone" @if (Auth::user()) value="{{ Auth::user()->phone }}" @endif
                                            class="searchPhone" required readonly>
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
                                        <input type="text" name="first_name" @if (Auth::user()) value="{{ Auth::user()->firstName }}" @endif id="firstName">
                                        @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" @if (Auth::user()) value="{{ Auth::user()->lastName }}" @endif id="lastName">
                                        @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Email Address</label>
                                        <input type="text" name="email" @if (Auth::user()) value="{{ Auth::user()->email }}" @endif id="email" readonly>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @if (!Auth::check())
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password">
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-12">
                                    <div class="billing-info mb-20">
                                        <label>Billing Address</label>
                                        <input class="billing-address" placeholder="billing address" type="text"
                                            @if (Auth::user()) value="{{ Auth::user()->customer ? (Auth::user()->customer->address ? Auth::user()->customer->address->billingAddress : '') : '' }}" @endif name="billingAddress" id="billingAddress">
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
                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                        name="message"></textarea>
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
                                            <input class="billing-address" placeholder="Shipping address"
                                                @if (Auth::user()) value="{{ Auth::user()->customer ? (Auth::user()->customer->address ? Auth::user()->customer->address->shippingAddress : '') : '' }}" @endif type="text" name="diffshippingAddress">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- coupon add area -->
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>

                                <input type="text" name="promo_code" id="promoCode" placeholder="Promo code">
                                <a class="cart-btn-2" onclick="applyPromo()">Apply Coupon</a>
                            </div>
                        </div>
                        @if (\Cart::getContent()->count() > 0)
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
                                                @foreach (\Cart::getContent() as $key => $item)
                                                    {{-- @dd($item->associatedModel->productName) --}}
                                                    <li><span
                                                            class="order-middle-left">{{ $item->associatedModel->productName }}
                                                            X {{ $item->quantity }}</span> <span
                                                            class="order-price">৳{{ $item->price * $item->quantity }}
                                                        </span></li>
                                                    {{-- <li><span class="order-middle-left">Product Name  X  1</span> <span class="order-price">$329 </span></li> --}}
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div id="totalLoad">
                                            {{-- @if (!empty(Session::get('discountAmount'))) --}}

                                            <div class="your-order-total">
                                                <ul id="">
                                                    <li class="order-total">Total</li>
                                                    <li>৳{{ number_format(\Cart::getSubTotal()) }}</li>
                                                </ul>
                                                <br>

                                                <ul>
                                                    <li class="">Discount </li>
                                                    <li>-৳{{number_format(Session::get('discountAmount')) ? number_format(Session::get('discountAmount')) : 0}}</li>
                                                    {{-- <li id='discountAm'> test</li> --}}
                                                </ul>

                                            </div>


                                            {{-- @endif --}}
                                        </div>
                                        {{-- <div class="your-order-total" id="hideDefault"> --}}
                                        {{-- <ul id="discountValue"> --}}

                                        {{-- </ul> --}}
                                        {{-- <br> --}}
                                        {{-- <ul id="orderTotal"> --}}

                                        {{-- </ul> --}}
                                        {{-- </div> --}}
                                        <div class="your-order-bottom">
                                            <ul>
                                                <li class="your-order-shipping shipping"></li>
                                                <li id='deliveryFee'> </li>
                                            </ul>
                                        </div>
                                        <div id="grandLoad">
                                            <div class="your-order-total">
                                                <ul id="">
                                                    <li class="order-total">Grand Total</li>
                                                    @if (Session::has('shipTotal'))
                                                        <li id="orderTotal">
                                                            ৳{{ number_format(Session::get('sub')) ? number_format(Session::get('sub')) : number_format(\Cart::getSubTotal()) }}
                                                        </li>
                                                    @else
                                                        <li id="orderTotal" class="grandTotal">
                                                            ৳{{ number_format(Session::get('sub')) ? number_format(Session::get('sub')) : number_format(\Cart::getSubTotal()) }}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="payment-method">
                                        {{-- <div class="form-check"> --}}
                                        {{-- <input class="form-check-input" type="radio" id="dbt" name="payment" value="dbt" checked> --}}
                                        {{-- <label class="form-check-label" for="dbt"> --}}
                                        {{-- Direct bank transfer --}}
                                        {{-- </label> --}}
                                        {{-- </div> --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="cod" name="payment"
                                                value="cod">
                                            <label class="form-check-label" for="cod">
                                                Cash on delivery
                                            </label>
                                            @error('payment')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order mt-25">

                                    {{-- <a class="btn-hover">  Place Order</a> --}}
                                    @if (Auth::check())
                                        <button class="btn-hover" type="submit" id="orderPlaced">Place Order</button>
                                    @endif
                                    @if (!Auth::check())
                                        <a class="btn-hover" href="{{ route('login') }}">Place Order</a>
                                    @endif
                                </div>
                            </div>
                            @else
                    {{Session::forget('discountAmount')}}
                    {{Session::forget('sub')}}
                    {{Session::forget('promoCode')}}

                        @endif
                    </div>

                </div>

            </form>
        </div>
    </div>

@endsection

@section('js')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        $('.orderPlaced').click(function() {
            $(this).prop('disabled', true);
        });


        function shippingZone() {
            var shipping_zone = $('.zone').val();
            $.ajax({
                url: "{{ route('shippingZone.change') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    shipping_zone: shipping_zone,
                },
                success: function(data) {
                    console.log(data);
                    var deliveryFee = data['deliveryFee'];
                    var orderTotal = data['orderTotal'];
                    $('.shipping').empty().append('Shipping');
                    $('#deliveryFee').empty().append(
                        "<th style='padding: 10px; font-weight: bold; font-size: 14px; color: #000000;'>" +
                        "Delivery Fee" + "</th>" + "<td>" + "<span class='total amount'>" + "+৳" +
                        deliveryFee + "</span>" + "</td>");
                    $('#orderTotal').empty().append("<span>" + "৳" + orderTotal + "</span>");
                }
            });
        }


        $(".searchPhone").autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: "{{ url('autocomplete') }}",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        // console.log('data',data);
                        var resp = $.map(data, function(obj) {
                            //console.log(obj.city_name);
                            return obj.phone;
                        });

                        response(resp);
                    }
                });
            },
            minLength: 0
        });



        $("#phone").keyup(function() {
            let phone = $('#phone').val();
            console.log(phone);
            $.ajax({
                type: "post",
                url: "{{ route('search.user') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    phone: phone
                },
                success: function(data) {
                    if (data.customer != null) {
                        $('#firstName').val(data.user.firstName);
                        $('#lastName').val(data.user.lastName);
                        $('#email').val(data.user.email);
                        $('#billingAddress').val(data.shippingAddress.billingAddress);

                        document.getElementById("newphone").innerHTML =
                            'phone number matched and data found';
                        document.getElementById("newphone").style.color = "green";
                    }

                }

            });

        });

        function applyPromo() {
            let promoCode = $("#promoCode").val();
            $.ajax({
                url: "{{ route('promo.submit') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    promo_code: promoCode,
                },
                success: function(data) {

                    // $("#discountAm").append("<b>Appended text</b>");
                    // alert('success');
                    if (data.discountAmount) {
                        console.log('true dis');
                        $('#discountAm').empty();
                    }
                    
                    $(".grandTotal").load(" .grandTotal");
                    // if($("#zone").val() == ""){
                    // console.log(data.discountAmount);
                    // $('#discount').val(data.discountAmount);
                    // $('#discount').empty().append("<span>" + "৳" + data.discountAmount + "</span>");

                    // }
                    if ($("#zone").val() != "") {
                        console.log('no');
                        var ship_zone = $("#zone").val();
                        $.ajax({
                            url: "{{ route('shippingZone.change') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                shipping_zone: ship_zone,
                            },
                            success: function(data) {
                                console.log(data);
                                var deliveryFee = data['deliveryFee'];
                                var orderTotal = data['orderTotal'];
                                $('.shipping').empty().append('Shipping');
                                $('#deliveryFee').empty().append(
                                    "<th style='padding: 10px; font-weight: bold; font-size: 14px; color: #000000;'>" +
                                    "Delivery Fee" + "</th>" + "<td>" +
                                    "<span class='total amount'>" + "+৳" + deliveryFee +
                                    "</span>" + "</td>");
                                $('#orderTotal').empty().append("<span>" + "৳" + orderTotal +
                                    "</span>");
                            }
                        });
                    }
                    if (data.msg_success) {
                        toastr.success(data.msg_success);
                    }
                    if (data.msg_error) {
                        toastr.error(data.msg_error);
                    }
                    $("#totalLoad").load(" #totalLoad");
                    // $("#grandLoad").load(" #grandLoad");


                }
            });
        }
    </script>
@endsection
