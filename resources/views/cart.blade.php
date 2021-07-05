@extends('layouts.layout')
@section('container')
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content updatereload">
                        <table id="cartTable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Variation</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="cartBody">
                                @foreach (\Cart::getContent()->sort() as $key=>$item)
                                {{-- @dd($item->associatedModel->sku->skuId); --}}
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{route('product.details',$item->associatedModel->sku->first()->skuId)}}"><img src="{{('admin/public/featureImage/').$item->associatedModel->featureImage}}" alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="{{route('product.details',$item->associatedModel->sku->first()->skuId)}}">{{$item->associatedModel->productName}}</a></td>
                                        <td>
                                            @if($item->attributes['variations'])
                                            @foreach($item->attributes['variations'] as $variant)
                                                @if($variant['variationType'] == 'Size')
                                                    <div class="pro-details-size" style="display: inline-block" id="sizes">
                                                        <div class="pro-details-size-content">
                                                            <input type="radio" id="size-1" name="size">
                                                            <label for="size-1" class="text-center">
                                                                <div class="variant-select_wrapper">
                                                                    <span class="variant-select__title">{{$variant['variationValue']}}</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @elseif($variant['variationType'] == 'Color')
                                                    <div class="pro-details-color-wrap" style="display: inline-block" id="colors">
                                                        <div class="pro-details-color-content">
                                                                <input type="radio" name="color" id="red" />
                                                                <label for="red"><span  style="background: {{$variant['variationValue']}}; margin-top: 10px" class=""></span></label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @else
                                                <p class="product-name">Single</p>
                                            @endif
                                        </td>
                                        <td class="product-price-cart"><span class="amount">&#2547;{{$item->price}}</span> </td>
                                        <td class="product-quantity" id="quantity">
                                            <div class="cart-plus-minus"  onclick="quantityUpdate({{$item->id}})">

                                                <input class="cart-plus-minus-box" type="text" name="quantity"  id="qtyBtn{{$item->id}}" value="{{$item->quantity}}">

                                            </div>
                                        </td>
                                        <span class="upd">
                                        <td class="product-subtotal">{{$item->price * $item->quantity}} </td>
                                        </span>
                                        <td class="product-remove" onclick="removeItem('{{$item->id}}')">
                                            <a href="#"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row mt-50">
                    <div class="col-lg-4 col-md-6">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Shipping Cost</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>
                                    Shipping in Dhaka is 50 TK and Outside Dhaka 120 TK
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                            <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form action="{{route('coupon.submit')}}" method="post">
                                    @csrf
                                    <input type="text" required="" name="couponCode">
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                    @if($errors->has('couponCode'))
                                    <div class="error text-danger"><strong>{{ $errors->first('couponCode') }}</strong></div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5 class="cartTotal">Total products <span>&#2547;{{\Cart::getSubTotal()}}</span></h5>
                            {{-- <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox"> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox"> Express <span>$30.00</span></li>
                                </ul>
                            </div> --}}
                            <h4 class="grand-totall-title total">Grand Total  <span class="">&#2547;{{\Cart::getTotal()}}</span></h4>
                            {{-- @if(empty($customer)) --}}
                            {{-- <a href="{{route('login')}}">Goto Login</a> --}}
                            
                            {{-- @else --}}
                            <a href="{{route('checkout.index')}}">Proceed to Checkout</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')

@endsection
