<div class="modal fade" id="addProduct-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="orderReturnFrom">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="orderId" value="@if (isset($order)){{ $order->orderId }}@endif">

                        {{-- @dd($order); --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="rQuantity">Choose Product</label>
                                <select name="productId" class="form-control" id="getProduct"
                                    onchange="getProductName(this)">
                                    <option value="" selected>Select a product</option>
                                    @foreach ($product as $item)
                                        <option value=" {{ $item->productId }} ">{{ $item->productName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6" style="display: none" id="variation"> </div>
                        <div class="col-lg-6" style="display: none" id="variationdata"> </div>
                        
                        <div class="col-lg-6" id="price"> </div>
                        <div class="col-lg-6" style="display: none" id="salePrice"> </div>
                        <div class="col-lg-6" style="display: none" id="oldPrice"> </div>
                        <input type="hidden" id="priceInput" name="priceInput" value="" >
                        <input type="hidden" id="salePriceInput" name="salePriceInput" value="" >
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="rQuantity">Quantity</label>
                                <input type="number" name="rQuantity" id="quantity" class="form-control" value="1">
                            </div>
                        </div>

                        <div class="col-lg-6" id="totalPrice"></div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        onclick="returnSave()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getProductName(event) {
        var productId = $('#getProduct').find(":selected").val();
        // alert(productId);
        $.ajax({
            type: "post",
            url: "{{ route('order.getProductInfo') }}",
            data: {
                _token: '{{ csrf_token() }}',
                productId: productId
            },
            success: function(response) {
                console.log(response);

                $('#price').html('');
                $('#totalPrice').html('');
                $('#quantity').val(1);

                var variationItemsSize = "";
                var variationItemsColor = "";
                
                $('#variation').css('display', 'block');

                if (response.product.type == 'single') {
                    $('#salePrice').css('display', 'none');
                    $('#oldPrice').css('display', 'none');
                    // console.log('single',response.product.sku[0]);
                    if (response.product.sku[0].salePrice) {
                        console.log('sale',response.product.sku[0].salePrice);
                        $('#priceInput').val(`${response.product.sku[0].salePrice}`);
                        $('#price').html(`<p>Price:</p><h5>${response.product.sku[0].salePrice}</h5>`);
                        $('#quantity').on("change", function() {
                            var quantity = $(this).val();
                            $('#totalPrice').html(
                                `<p>Total Price:</p><h5>${response.product.sku[0].salePrice * quantity}</h5>`
                                );
                            });
                       

                    } else {
                        $('#priceInput').val(`${response.product.sku[0].regularPrice}`);
                        $('#price').html(`<p>Price:</p><h5>${response.product.sku[0].regularPrice}</h5>`);
                        $('#quantity').on("change", function() {
                            var quantity = $(this).val();
                            $('#totalPrice').html(
                                `<p>Total Price:</p><h5>${response.product.sku[0].regularPrice * quantity}</h5>`
                            );
                        });
                        
                    }


                    $('#variation').html(`<p>Product Type:</p><h5>${response.product.type}</h5>`);
                    $('#variationdata').css('display', 'none');

                } else {

                    // $('#price').css('display', 'none');
                    // $('#totalPrice').html('');


                    $('#variation').html(`<p>Product Type:</p><h5>${response.product.type}</h5>`);
                    $('#variationdata').css('display', 'block');

                    $.each(response.product.sku, (index, productsku) => {
                        console.log('rows', productsku);
                        $.each(productsku.variation_relation, (index, row) => {
                            // console.log('row dada',row.variationRelationId);
                            if (row.variation_detailsdata.variationType == 'Size') {
                                variationItemsSize += `<div class="form-check">
                                                        <input type="hidden" name="variationId" value="${row.variationRelationId}" >
                                                        <input class="form-check-input" type="radio" name="variationSize" value="${row.variation_detailsdata.variationId}" onclick="getVariation(${row.variationRelationId})">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            ${row.variation_detailsdata.variationValue}
                                                        </label>
                                                        </div>`
                            }
                            if (row.variation_detailsdata.variationType == 'Color') {
                                variationItemsColor += `<div class="form-check">
                                                        <input type="hidden" name="variationId" value="${row.variationRelationId}">
                                                        <input class="form-check-input" type="radio" name="variationColor" value="${row.variation_detailsdata.variationId}" onclick="getVariation(${row.variationRelationId})">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            ${row.variation_detailsdata.variationValue}
                                                        </label>
                                                        </div>`
                            }
                        })
                    })

                    $('#variationdata').html(`
                    <div class="form-group" id="sizes"><label>Size</label>${variationItemsSize} </div>
                     <br/>
                    <div class="form-group" id="colors"><label>Color</label>${variationItemsColor} </div>`);
                }
            }
        });
    }

    function getVariation(id) {
        console.log('va', id);
        variationRelationId = id;
        $.ajax({
            type: "POST",
            url: "{{ route('order.colorSizeChoose') }}",
            data: {
                _token: '{{ csrf_token() }}',
                variationRelationId: variationRelationId
            },
            success: function(data) {
                console.log(data);
                var data = data;
                $('#salePrice').css('display', 'block');
                $('#oldPrice').css('display', 'block');

                if (data.afterDiscountPrice != null && data.sku.discount != null) {
                    $('#salePriceInput').val(`${data.afterDiscountPrice}`);
                    $('#salePrice').html(`<p> sale Price:</p><h5>${data.afterDiscountPrice}</h5>`);
                    $('#oldPrice').html(`<p> Old Price:</p><h5>${data.sku.regularPrice}</h5>`);
                    $('#quantity').on("change", function() {
                        var quantity = $(this).val();
                        $('#totalPrice').html(
                            `<p>Total Price:</p><h5>${data.afterDiscountPrice * quantity}</h5>`
                        );
                    });
                }
                if (data.afterDiscountPrice == null && data.sku.discount != null) {
                    $('#salePriceInput').val(`${data.sku.salePrice}`);
                    $('#salePrice').html(`<p> sale Price:</p><h5>${data.sku.salePrice}</h5>`);
                    $('#oldPrice').html(`<p> Old Price:</p><h5>${data.sku.regularPrice}</h5>`);
                }
                if (data.afterDiscountPrice != null && data.sku.discount == null) {
                    $('#salePriceInput').val(`${data.afterDiscountPrice}`);
                    $('#salePrice').html(`<p> sale Price:</p><h5>${data.afterDiscountPrice}</h5>`);
                    $('#oldPrice').html(`<p> Old Price:</p><h5>${data.sku.regularPrice}</h5>`);
                }
                if (data.afterDiscountPrice == null && data.sku.discount == null) {
                    $('#salePriceInput').val(`${data.sku.regularPrice}`);
                    $('#salePrice').html(`<p> sale Price:</p><h5>${data.sku.regularPrice}</h5>`);
                    $('#oldPrice').empty();
                }

                $.each(data.variationDatas, function (key, val)
                {
                    if(val.variation_detailsdata.variationType == "Color"){
                        $('#colors').empty().html(`<div class="form-group" id="sizes"><label>Size</label><div class="form-check">
                                                        <input class="form-check-input" type="radio" name="variationColor" value="${val.variation_detailsdata.variationId}" onclick="getVariation(${val.variationRelationId})">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            ${val.variation_detailsdata.variationValue}
                                                        </label>
                                                        </div></div>`);
                    }
                    if(val.variation_detailsdata.variationType == "Size"){
                        $('#sizes').empty().html(`<div class="form-group" id="sizes"><label>Size</label><div class="form-check">
                                                        <input class="form-check-input" type="radio" name="variationSize" value="${val.variation_detailsdata.variationId}" onclick="getVariation(${val.variationRelationId})">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            ${val.variation_detailsdata.variationValue}
                                                        </label>
                                                        </div></div>`);
                    }
                });
            },
            error: function(response) {

            }
        });

    }


   function returnSave() {
    price = $("#salePriceInput").val(); 
    console.log('price',price);
   
    
        $.ajax({
            url: "{{ route('order.insertItem') }}",
            method: 'post',
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($("#orderReturnFrom")[0]),
            // data: {
            //     // _token: '{{ csrf_token() }}',
            //     price: price
            // },
            success: function(response) {
                console.log(response);
                var url = window.location.href
                console.log('url', url);
                url = url.includes("order-details")
                if (url) {
                    location.reload();
                } else {
                    $('#edit-Ordered-Item-Quantity').modal('hide');
                }

                // if (response.returnVal == 'false') {
                //     // alert('false in');
                //     toastr.warning('Stock not available');
                // } else {
                //     toastr.success('Quantity Updated');
                // }

              
            },
            error: function(err) {
                console.log('error', err);
                if (err.status === 422) {
                    $("#orderReturnFrom").find("small").remove();
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        var errorMSG = error[0].replace('[]', '');
                        el.after($('<small style="color: red;font-weight: bold;">' + errorMSG +
                            '</small>'));
                    });
                }
            }
        });
    }
</script>
