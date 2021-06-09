@extends('layouts.layout')
@section('container')
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="cartBody">
                                @foreach (\Cart::getContent()->sort() as $key=>$item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{('admin/public/featureImage/').$item->associatedModel->featureImage}}" alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->associatedModel->productName}}</a></td>
                                        <td class="product-price-cart"><span class="amount">${{$item->price}}</span></td>
                                        <td class="product-quantity" id="quantity">
                                            <div class="cart-plus-minus"  onclick="quantityUpdate('{{$key}}','{{$item->id}}')">
                                                <input class="cart-plus-minus-box" type="text" name="quantity"  id="qtyBtn{{$key}}" value="{{$item->quantity}}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">{{$item->price * $item->quantity}} </td>
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
                                <form>
                                    <input type="text" required="" name="name">
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>${{\Cart::getSubTotal()}}</span></h5>
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox"> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox"> Express <span>$30.00</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total  <span>$260.00</span></h4>
                            <a href="#">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
 <script>
       function removeItem(id) {
            $.ajax({
                type: "POST",
                url: "{{route('product.cartRemove')}}",
                data: {
                    _token:'{{csrf_token()}}',
                    _sku:id,
                },
                success: function (response) {
                    // $('#cartBody').empty().html(response.cart);
                    $('#cartPage').empty().html(response.cart);
                    $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br> Cart(${response.cartQuantity})`);
                    toastr.success('Item delete from cart')
                }
            });
        }
        
        function quantityUpdate(data,id){
            
            var value = parseInt($(`#qtyBtn${data}`).val());
            // console.log(value);
            $.ajax({
                type: "POST",
                url: "{{route('product.cartUpdateQuantity')}}",
                data: {
                    _token:'{{csrf_token()}}',
                    _sku:id,
                    // value:value,
                },
                success: function (response) {
                    // console.log('success',response);
                    $('#cartMain').empty().html(response.cart);
                    $('#mobile-cart').html(`<i class="fas fa-shopping-bag"></i> <br> Cart(${response.cartQuantity})`);
                    toastr.success('Item updated to cart')
                }
            });
        }
 </script>
@endsection