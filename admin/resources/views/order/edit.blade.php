@extends('layouts.main')
@section('header.css')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css"
        integrity="sha512-TfnGOYsHIBHwx3Yg6u6jCWhqz79osu5accjEmw8KYID9zfWChaGyjDCmJIdy9fJjpvl9zXxZamkLam0kc5p/YQ=="
        crossorigin="anonymous"
    />
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

        .select2-container--classic .select-lg, .select2-container--default .select-lg {
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

        .variant-select input:checked + label {
            transition: 0.2s ease-in-out;
            background-color: #3e3e49;
            color: #fff;
            font-weight: 700;
        }

        .variant-select input:disabled + label {
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
        <div class="content-wrapper pt-1">
            <!-- main content start -->
            <div class="content-body">
                <section>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body pt-0 pb-1">
                                        <div class="form-body">

                                            <p class="mt-2">Order Edit</p>
{{--                                            {{dd($order)}}--}}
                                            <hr>
                                            <div class="customer-table table-responsive order-cart-table my-1"
                                                 style="max-height: 20rem;">
                                                <table class="table table-bordered table-striped" id="orderProduct">
                                                    <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th style="min-width: 120px;">Qnty.</th>
                                                        <th>Total</th>
                                                        <th style="text-align: center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                    @php $total = 0;@endphp
                                                    @if (!empty($order))
                                                        @foreach($order->orderedProduct as $orderItem)
{{--                                                            {{dd($orderItem->sku->product->productName)}}--}}
                                                            <tr>
                                                                <td>{{$orderItem->sku->product->productName}}</td>
                                                                <td>{{$orderItem->price ?? 0}}</td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend cursor-pointer"
                                                                             data-id="{{$orderItem->order_itemId}}" id="decrease"
                                                                             onclick="decreaseValue(this)">
                                                                            <span class="input-group-text"><i
                                                                                    class="ft ft-minus"></i></span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                               aria-label="" id="number{{$orderItem->order_itemId}}"
                                                                               name="rateperhour"
                                                                               value="{{$orderItem->quiantity}}" readonly>
                                                                        <div class="input-group-append cursor-pointer"
                                                                             data-id="{{$orderItem->order_itemId}}" id="increase"
                                                                             onclick="increaseValue(this)">
                                                                            <span class="input-group-text"><i
                                                                                    class="ft ft-plus"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{$subtotal =$orderItem->quiantity*$orderItem->price - $orderItem->discount ??'0'}}</td>
                                                                <td style="text-align: center">
                                                                    {{-- <button type="button" class="btn btn-warning btn-sm"><i class="ft-edit-3"></i></button> --}}
                                                                    <button type="button"
                                                                            onclick="editItem({{$orderItem->order_itemId}})"
                                                                            class="btn btn-warning btn-sm"><i
                                                                            id="delIcon{{$orderItem->order_itemId}}"
                                                                            class="ft-edit"></i><span
                                                                            id="delSpinner{{$orderItem->order_itemId}}"
                                                                            class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"
                                                                            style="display: none"></span></button>
                                                                </td>
                                                            </tr>
                                                            @php $total = $total+ $subtotal;@endphp
                                                        @endforeach
                                                    @else
                                                        <tr id="initial">
                                                            <td style="text-align: center" colspan="7">No product has
                                                                been added
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- payment info. -->
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
    <div>

    </div>
@endsection
@section('footer.js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script>

            function editItem(rowId) {
                console.log(rowId);
                $.ajax({
                    url: "{{ route('order.edit.item') }}",
                    method: "post",
                    data: {
                        _token: "{{csrf_token()}}",
                        rowId,
                    },
                    // success: function (data) {
                    //     console.log(data);
                    //     $('#tableBody').html('')
                    //     $('#tableBody').append(data.cart)
                    //     $('#orderTotal').html(data.total)
                    //     $('#paid_amount').val(data.total)
                    //
                    // }

                });
            }

            function deliveryFee(data) {
                let charge = $('option:selected', data).attr('charge')
                $('#delivery_charge').val(charge)
            }

            function increaseValue(e) {
                console.log(e);
                let id = $(e).attr('data-id');
                var value = parseInt($(`#number${id}`).val(), 10);
                value = isNaN(value) ? 0 : value;
                value++;
                $(`#number${id}`).val(value);

                //Conditions
                // let id=$(`#discount${id}`).attr('data-id');
                let value2 = $(`#discount${id}`).val();
                let discount = parseInt(value2) / value;
                console.log(value2);
                console.log(discount);
                $.ajax({
                    type: "POST",
                    url: '{{route('order.update.quantity')}}',
                    data: {
                        'id': id,
                        'quantity': value,
                        _token: "{{csrf_token()}}",
                        'type': 'inc',
                        'amount': discount,
                    },
                    success: function (data) {
                        if (data.notAvailable == true) {
                            toastr.error('maximum amount reached')
                        }
                        $('#tableBody').html('')
                        $('#tableBody').append(data.cart)
                        $('#orderTotal').html(data.total)
                        $('#paid_amount').val(data.total)

                    }
                });
            }

            function decreaseValue(e) {
                let id = $(e).attr('data-id');
                var value = parseInt($(`#number${id}`).val(), 10);
                value = isNaN(value) ? 0 : value;
                value < 1 ? value = 1 : '';
                value--;
                $(`#number${id}`).val(value);

                let value2 = $(`#discount${id}`).val();
                let discount = parseInt(value2) / value;
                console.log(value2);
                console.log(discount);
                $.ajax({
                    type: "POST",
                    url: '{{route('order.update.quantity')}}',
                    data: {
                        'id': id,
                        'quantity': value,
                        _token: "{{csrf_token()}}",
                        'type': 'dec',
                        'amount': discount,
                    },
                    success: function (data) {
                        $('#tableBody').html('')
                        $('#tableBody').append(data.cart)
                        $('#orderTotal').html(data.total)
                        $('#paid_amount').val(data.total)
                    }
                });
            }

            function discountPrice(e) {
                let id = $(e).attr('data-id');
                let value = $(e).val();
                let quantity = $(`#number${id}`).val()
                let discount = parseInt(value) / parseInt(quantity);
                console.log(discount);
                $.ajax({
                    type: "POST",
                    url: '{{route('order.discount')}}',
                    data: {
                        'id': id,
                        'amount': discount,
                        'discount': value,
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        console.log(data);
                        $('#tableBody').html('')
                        $('#tableBody').append(data.cart)
                        $('#orderTotal').html(data.total)
                        $('#paid_amount').val(data.total)

                    }
                });
            }

            function shopSale(data) {
                if (data == 'online') {
                    $('#totalDelivery').show()
                } else {
                    $('#totalDelivery').hide()
                }
            }

            function orderSubmit() {
                if ($('#customerName').length == 0 && $('#payment_type:checked').val() == 'due') {
                    toastr.error('To make due payment user has to be customer')
                } else {
                    $.ajax({
                        url: "{{route('order.insert')}}",
                        method: 'post',
                        cache: false,
                        processData: false,
                        contentType: false,
                        data:
                            new FormData($('#orderForm')[0]),
                        success: function (response) {
                            console.log(response);
                            $('#orderForm').trigger("reset");
                            $(".app-content").find("small").remove();
                            $('#search').val("");
                            $('#orderTotal').html("")
                            $('#tableBody').html(`<tr id="initial">
                    <td style="text-align: center" colspan="7">No product has been added</td>
                </tr>`)
                            toastr.success('Order added successfully')
                        },
                        error: function (err) {
                            if (err.status === 422) {
                                $("#orderForm").find("small").remove();
                                $.each(err.responseJSON.errors, function (i, error) {
                                    var el = $(document).find('[name="' + i + '"]');
                                    var errorMSG = error[0].replace('[]', '');
                                    el.after($('<small style="color: red;font-weight: bold;">' + errorMSG + '</small>'));
                                });
                            }
                        }
                    });
                }
            }



    </script>
@endsection
