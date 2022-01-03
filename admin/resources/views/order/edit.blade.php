@extends('layouts.main')
@section('header.css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css"
        integrity="sha512-TfnGOYsHIBHwx3Yg6u6jCWhqz79osu5accjEmw8KYID9zfWChaGyjDCmJIdy9fJjpvl9zXxZamkLam0kc5p/YQ=="
        crossorigin="anonymous" />
    <style>
        .ui-autocomplete {
            z-index: 5000;
        }

        .select2-search__field:focus {
            outline: none;
        }

        .input-group .input-group-text {
            padding-right: 8px;
            padding-left: 8px;
        }

        .input-group .form-control {
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
        }

        .order-cart-table table td {
            padding: .75rem 1rem;
        }

        /* @media screen and (max-width: 768px) {
                               ul#ui-id-1 {
                                   left: -2px !important;
                                   width: 91vw !important;
                               }
                           }

                           @media screen and (min-width: 1200px) {
                               ul#ui-id-1 {
                                   left: 272px !important;
                                   width: 1014px !important;
                               }
                           }
                           @media screen and (min-width: 1600px) {
                               ul#ui-id-1 {
                                   left: 272px !important;
                                   width: 790px !important;
                               }
                           }

                           @media screen and (max-width: 768px) {
                               ul#ui-id-2 {
                                   left: -2px !important;
                                   width: 91vw !important;
                               }
                           }
                           @media screen and (min-width: 1200px) {
                               ul.ui-menu-item-wrapper {
                                   left: 272px !important;
                                   width: 1014px !important;
                               }
                           }
                           @media screen and (min-width: 1600px) {
                               ul.ui-menu-item-wrapper {
                                   left: 272px !important;
                                   width: 1393px !important;
                               }
                           } */
        /* .customer-phone {
                                max-height: 140px;
                                position: absolute;
                                top: 45px;
                                right: 0;
                                left: 0;
                                overflow-y: scroll;
                                z-index: 10000;
                                box-shadow: 0px 2px 6px -2px #00000087;
                            } */

        .select2-container--classic .select-lg,
        .select2-container--default .select-lg {
            font-size: 1rem;
        }

        .dropdown-toggle::after {
            display: none;
        }

        /* select variant */
        .variant-select {
            width: 100%;
            margin-bottom: 16px;
        }

        .variant-select input {
            display: none;
        }

        .variant-select label {
            display: inline-block;
            background-color: #EEEEEE;
            margin-top: 0.1em;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 2px;
        }

        .variant-select label:hover {
            transition: 0.4s ease-in-out;
            background-color: #c4c4c4;
        }

        .variant-select input:checked+label {
            transition: 0.2s ease-in-out;
            background-color: #3e3e49;
            color: #fff;
            font-weight: 700;
        }

        .variant-select input:disabled+label {
            background-color: #ccc;
            color: #fff;
            font-weight: 700;
        }

        .variant-select__title {
            display: inline;
            vertical-align: middle;
        }

        .show-search-product-card {
            max-height: 550px;
            background: #fff;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .select2-container {
            width: 100% !important;
        }

    </style>
@endsection
@section('main.content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="offset-md-1 col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Edit Order #{{ $order->orderId }}
                                    </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($order->orderedProduct as $orderItem)
                                                <div class="col-sm-6" id="orderItem{{ $orderItem->order_itemId }}">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">
                                                                {{ $orderItem->sku->product->productName }}</h5>
                                                            <p class="card-text"><b>Quantity:</b>
                                                                {{ $orderItem->quiantity }}</p>
                                                            <a href="#" id="orderProEdit{{ $orderItem->order_itemId }}"
                                                                class="btn btn-primary">Edit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


                                        <div class="row">
                                            @foreach ($order->orderedProduct as $orderItem)
                                                <div class="col-sm-6" id="showform{{ $orderItem->order_itemId }}"
                                                    style="display: none">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form class="form" action="" method="post">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label for="companyName">Product Name</label>
                                                                        <input type="hidden" name="orderId" id="orderId"
                                                                            value="{{ $order->orderId }}">
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $orderItem->sku->product->productName }}"
                                                                            name="categoryName" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="companyName">Product quantity</label>
                                                                        <input type="number" class="form-control"
                                                                            value="{{ $orderItem->quiantity }}"
                                                                            name="quantity"
                                                                            id="itemQuantity{{ $orderItem->order_itemId }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="companyName">Order Type</label>
                                                                        <select name="type"
                                                                            id="typeOrder{{ $orderItem->order_itemId }}"
                                                                            class="form-control">
                                                                            <option value="" selected>Select a type</option>
                                                                            <option value="in">in</option>
                                                                            <option value="out">out</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="companyName">Identifier</label>
                                                                        <select name="identifier"
                                                                            id="identifier{{ $orderItem->order_itemId }}"
                                                                            class="form-control">
                                                                            <option value="" selected>Select a Identifier
                                                                            </option>
                                                                            <option value="purchase">purchase</option>
                                                                            <option value="sale">sale</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <a href="javascript:void(0)" type="button"
                                                                    onclick="orderUpdate({{ $orderItem->order_itemId }})"
                                                                    class="btn btn-primary">Submit</a>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            var order = {!! json_encode($order->orderedProduct->toArray()) !!};
            $.each(order, (index, row) => {
                $('#orderProEdit' + row.order_itemId).click(function(e) {
                    $("#orderItem" + row.order_itemId).css("display", "none");
                    $("#showform" + row.order_itemId).css("display", "block");
                });
            })

        });

        function orderUpdate(itemId) {

            var quantity = $('#itemQuantity' + itemId).val();
            var getOrderType = $('#typeOrder' + itemId).find(":selected").text();
            var getOrderIdentifier = $('#identifier' + itemId).find(":selected").text();
      
            $.ajax({
                url: "{{ route('order.orderUpdate') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    quantity: quantity,
                    itemId: itemId,
                    getOrderType: getOrderType,
                    getOrderIdentifier: getOrderIdentifier
                },
                success: function(data) {
                    toastr.success('Order Updated Successfully')

                },
                error:function (response) {
                    toastr.error('Stock not available')
                }
            });
        }


        
    </script>
@endsection
