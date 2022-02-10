@extends('layouts.layout')
@section('container')
    <div class="cart-main-area pt-90 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your Ordered Items</h3>
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
                                        <th>Date</th>
                                        <th>Subtotal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orderedProducts->count() > 0)
                                        @foreach ($orderedProducts as $item)
                                            @foreach ($item->orderedProduct as $orderitem)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{ route('product.details', $orderitem->sku->product->slug) }}"><img
                                                                src="{{ asset('admin/public/featureImage/' . $orderitem->sku->product->featureImage) }}"
                                                                alt=""></a>
                                                    </td>
                                                    <td class="product-name"><a
                                                            href="{{ route('product.details', $orderitem->sku->product->slug) }}">{{ $orderitem->sku->product->productName }}</a>
                                                    </td>
                                                    {{-- @dd(isset($item->promo)); --}}
                                                    @if(isset($item->promo))
                                                    @php
                                                        
                                                        $discouontAmount =  $item->promo->discount;
                                                        $amountReduce = ($orderitem->sku->salePrice * $discouontAmount) /100;
                                                        $actualPrice = $orderitem->sku->salePrice - $amountReduce;

                                                    @endphp
                                                    <td class="product-price-cart"><span
                                                            class="amount">&#2547;{{ $actualPrice  }}</span>
                                                    </td>
                                                    @else
                                                    <td class="product-price-cart"><span
                                                        class="amount">&#2547;{{ $orderitem->sku->salePrice }}</span>
                                                    </td>
                                                    @endif
                                                    <td class="product-quantity">
                                                        <span class="amount">{{ $orderitem->quiantity }}</span>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <span class="amount">{{ $item->created_at }}</span>
                                                    </td>
                                                    @if(isset($item->promo))
                                                    @php
                                                        
                                                        $discouontAmount =  $item->promo->discount;
                                                        $amountReduce = ($orderitem->total * $discouontAmount) /100;
                                                        $actualPrice = $orderitem->total - $amountReduce;

                                                    @endphp
                                                    <td class="product-subtotal">&#2547;{{ $actualPrice}}</td>
                                                    @else
                                                    <td class="product-subtotal">&#2547;{{ $orderitem->total }}</td>
                                                    @endif
                                                    <td class="product-wishlist-cart">
                                                        @if (!empty($item->last_status))
                                                            <button
                                                                class="btn btn-success">{{ $item->last_status }}</button>
                                                        @else
                                                            <button class="btn btn-warning">Pending</button>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="pro-pagination-style text-center mt-30">
                                {{ $orderedProducts->links('vendor.pagination.custom') }}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
