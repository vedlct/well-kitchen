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
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Add To Cart</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishList as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{url('admin/public/featureImage/'.$item->sku->product->featureImage)}}" alt=""></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$item->sku->product->productName}}</a></td>
                                        <td class="product-price-cart"><span class="amount">${{$item->sku->salePrice}}</span></td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">$110.00</td>
                                        <td class="product-wishlist-cart">
                                            <a href="{{route('product.details',$item->sku->skuId)}}">add to cart</a>
                                        </td>
                                        <td class="product-wishlist-cart">
                                            <a  href="{{route('wishlistRemove',$item->wishlistId)}}"> <i class="fas fa-trash-alt"></i>  </a>
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
