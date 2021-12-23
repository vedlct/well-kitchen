@extends('layouts.layout')
@section('container')
    <div class="cart-main-area pt-90 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content updatereload">
                            <table id="cartTable" class="cartTable">
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
                                    @foreach (\Cart::getContent()->sort() as $key => $item)
                                        {{-- @dd($item->associatedModel->sku->skuId); --}}
                                        <tr class="cartRow{{ $item->associatedModel->sku->first()->skuId }}">
                                            <td class="product-thumbnail">
                                                <a
                                                    href="{{ route('product.details', $item->associatedModel->sku->first()->product->slug) }}"><img
                                                        src="{{ url('admin/public/featureImage/') . '/' . $item->associatedModel->featureImage }}"
                                                        alt=""></a>
                                            </td>
                                            <td class="product-name"><a
                                                    href="{{ route('product.details', $item->associatedModel->sku->first()->product->slug) }}">{{ $item->associatedModel->productName }}</a>
                                            </td>
                                            <td>
                                                @if ($item->attributes['variations'])
                                                    @foreach ($item->attributes['variations'] as $variant)
                                                        @if ($variant['variationType'] == 'Size')
                                                            <div class="pro-details-size" style="display: inline-block"
                                                                id="sizes">
                                                                <div class="pro-details-size-content">
                                                                    <input type="radio" id="size-1" name="size">
                                                                    <label for="size-1" class="text-center">
                                                                        <div class="variant-select_wrapper">
                                                                            <span
                                                                                class="variant-select__title">{{ $variant['variationValue'] }}</span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @elseif($variant['variationType'] == 'Color')
                                                            <div class="pro-details-color-wrap"
                                                                style="display: inline-block" id="colors">
                                                                <div class="pro-details-color-content">
                                                                    <input type="radio" name="color" id="red" />
                                                                    <label for="red"><span
                                                                            style="background: {{ $variant['variationValue'] }}; margin-top: 10px"
                                                                            class=""></span></label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <p class="product-name">Single</p>
                                                @endif
                                            </td>
                                            <td class="product-price-cart"><span
                                                    class="amount">&#2547;{{ $item->price }}</span> </td>

                                            <td class="product-quantity productQuantity{{ $item->associatedModel->sku->first()->skuId }}"
                                                id="quantity">
                                                <div class="cart-plus-minus" onclick="quantityUpdate({{ $item->id }})">
                                                    <div class="dec qtybutton">-</div>
                                                    <input class="cart-plus-minus-box" type="text" name="quantity"
                                                        id="qtyBtn{{ $item->id }}" value="{{ $item->quantity }}">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </td>
                                            <span class="upd">
                                                <td
                                                    class="product-subtotal productSubtotal{{ $item->associatedModel->sku->first()->skuId }}">
                                                    {{ $item->price * $item->quantity }} </td>
                                            </span>

                                            <td class="product-remove" onclick="removeItem('{{ $item->id }}')">
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

                        </div>
                        <div class="col-lg-4 col-md-6">
                            {{-- <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Shipping Cost</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>
                                    Shipping in Dhaka is 60 TK and Outside Dhaka 150 TK
                                </p>
                            </div>
                        </div> --}}
                        </div>
                        {{-- @dd(Session::get('discountAmount')); --}}
                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5 class="cartTotal">Total products <span>&#2547;{{ \Cart::getSubTotal() }}</span>
                                </h5>
                                {{-- <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox"> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox"> Express <span>$30.00</span></li>
                                </ul>
                            </div> --}}
                                <h4 class="grand-totall-title total">Grand Total <span
                                        class="">&#2547;{{ \Cart::getTotal() }}</span></h4>
                                {{-- @if (empty($customer)) --}}
                                {{-- <a href="{{route('login')}}">Goto Login</a> --}}

                                {{-- @else --}}
                                <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
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

    <script>
        function quantityUpdate(data) {

            let qtyvalue = $("#qtyBtn" + data).val();


            if (qtyvalue && qtyvalue >= 1) {
                qtyvalue
            }
            if (!qtyvalue || qtyvalue < 1) {
                qtyvalue = 1;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('product.cartUpdateQuantity') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    _sku: data,
                    _quantity: qtyvalue,
                },
                success: function(response) {
                    // toastr.success('Item removed From Cart');
                    var getTotalQuantity = 0;
                    var getSubTotal = 0;
                    var cartItems = ""

                    console.log(response);


                    //   $('#cartPage').empty().html(response.cart)
                    $('#headerCartBag').load(document.URL + ' #headerCartBag');
                    $('#mobile-cart').html(
                        `<i class="fas fa-shopping-bag"></i> <br>Cart(${response.cartQuantity})`);
                    // $(".updatereload").load(location.href + " .updatereload");
                    $(".cartTotal").load(location.href + " .cartTotal");

                    $(".total").load(location.href + " .total");
                    //   window.location.reload();
                    $.each(response.cart, (index, row) => {
                        // console.log('res',row);
                        getTotalQuantity += parseFloat(row.quantity)
                        getSubTotal += parseFloat(row.price)
                        cartItems += `<div class="product-area my-md-5 my-4">
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <img src="{{ asset('admin/public/featureImage/') }}/${row.associatedModel.featureImage}" alt="" class="product-img">
                                        </div>
                                            <div class="name-area px-2">
                                            <h5 class="product-name"><a href="javascript:void(0)">${row.name}</a></h5>
                                            <h6 class="quantity">${row.quantity} x &#2547; ${row.price}</h6>
                                            </div>
                                            <div class="" onclick="removeItem(${row.id})">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </div>
                                        </div>`

                    })


                    $.each(response.cart, (index, row) => {
                        $('.productQuantity' + row.id).html('');
                        $('.productSubtotal' + row.id).html('');
                        $('.productQuantity' + row.id).append(`


                            <div class="cart-plus-minus"  onclick="quantityUpdate(${row.id})">
                                <div class="dec qtybutton qb${row.id}">-</div>
                                <input class="cart-plus-minus-box" type="text" name="quantity"  id="qtyBtn${row.id}" value="${row.quantity}">
                                <div class="inc qtybutton qb${row.id}">+</div>
                            </div>
                       `)
                        $('.productSubtotal' + row.id).append(`

                       <span class="upd">
                       ${row.price * row.quantity}
                       </span>


                    `)
                        $(".qb" + row.id).on("click", function() {
                            var $button = $(this);
                            var oldValue = $button.parent().find("input").val();
                            if ($button.text() === "+") {
                                var newVal = parseFloat(oldValue) + 1;
                            } else {
                                // Don't allow decrementing below zero
                                if (oldValue > 1) {
                                    var newVal = parseFloat(oldValue) - 1;
                                } else {
                                    newVal = 1;
                                }
                            }
                            $button.parent().find("input").val(newVal);
                        });
                    })

                    $('#cart').html('')
                    $('#cart').append(`
                        <div class="cart-button-fixed" onclick="showNav()" id="cartNav">
                            <i class="pe-7s-shopbag"></i>
                            <h5 class="mb-0">Cart <span class="cart_count">${response.cartQuantity} </span></h5>
                        </div>
                        <div class="full-body-overlay" id="fullBodyOverlay" onclick="hideOverlay()"></div>
                        <section class="side-cart side-nav px-3 py-md-5 py-3" id="sideNav">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="">
                                <i class="fa fa-times close-icon" onclick="hideNav()"></i>
                            </div>
                        </div>
                        ${cartItems}

                                ${getSubTotal != 0 ? `<div class="d-flex justify-content-between"><div> <h5>Sub-Total:</h5> </div>
                                    <div class="">
                                    <h5>&#2547;${response.total}</h5>
                                    </div>
                                </div>
                                <div class="row my-md-5 my-4">
                                    <div class="col-6">
                                        <a href="{{ route('cart') }}" class="btn btn-secondary w-100">View Cart</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100">checkout</a>
                                    </div>
                                </div>
                                </div>` :`<p style="font-weight: bold; font-size: 14px; text-align: center">Cart Is Empty</p>` }
                        </section>`)

                },
                error: function(response) {
                    toastr.error('Stock not available')
                }
            });
        }
    </script>

@endsection


{{-- <td> --}}
{{-- if(row['attributes'].variations){ --}}
{{-- foreach(row['attributes'].variations as let variant){ --}}
{{-- if(variant['variationType'] == 'Size'){ --}}
{{-- <div class="pro-details-size" style="display: inline-block" id="sizes"> --}}
{{-- <div class="pro-details-size-content"> --}}
{{-- <input type="radio" id="size-1" name="size"> --}}
{{-- <label for="size-1" class="text-center"> --}}
{{-- <div class="variant-select_wrapper"> --}}
{{-- <span class="variant-select__title"></span> --}}
{{-- </div> --}}
{{-- </label> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- }elseif(variant['variationType'] == 'Color'){ --}}
{{-- <div class="pro-details-color-wrap" style="display: inline-block" id="colors"> --}}
{{-- <div class="pro-details-color-content"> --}}
{{-- <input type="radio" name="color" id="red" /> --}}
{{-- <label for="red"><span  style="background: ; margin-top: 10px" class=""></span></label> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- } --}}
{{-- } --}}
{{-- }else --}}
{{-- <p class="product-name">Single</p> --}}
{{-- } --}}
{{-- </td> --}}
