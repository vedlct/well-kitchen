@extends('layouts.layout')
@section('container')
<div class="cart-main-area pt-90 pb-100">
    <div class="container">
        <h3 class="cart-page-title">Your Wishlist items</h3>
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
                                    {{-- <th>Qty</th>
                                    <th>Subtotal</th> --}}
                                    <th>Add To Cart</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($lists->count()) --}}
                                @if($lists->count() == 0)
                                <span> Not item added to wishlist yet</span>
                            @endif
                                @foreach ($lists as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href=" {{route('product.details',$item->product->sku->first()->skuId)}} "><img src="{{asset('admin/public/featureImage/'.$item->product->featureImage)}}" alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->product->productName}}</a></td>
                                        <td class="product-price-cart"><span class="amount">${{$item->product->sku->first()->salePrice}}</span></td>
                                        {{-- <td class="product-quantity">
                                            <div class="cart-plus-minus" onclick="quantityUpdate({{$item->id}})">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">$110.00</td> --}}
                                        <td class="product-wishlist-cart">
                                            {{-- @dd($item); --}}
                                            @if($item->product->type == 'single')
                                            <a href="#" onclick="addTocart({{$item->product->sku->first()->skuId}})">add to cart</a>
                                            @endif
                                            @if($item->product->type == 'variation')
                                            <a href="{{route('product.details',$item->product->sku->first()->skuId)}}">add to cart</a>
                                            @endif
                                        </td>
                                        <td class="product-wishlist-cart">
                                            <a  href="{{route('wishlistRemove',$item->wishlistId)}}"> <i class="fa fa-trash"></i>  </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
