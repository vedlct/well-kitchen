@extends('layouts.main')
@section('header.css')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css"
    integrity="sha512-TfnGOYsHIBHwx3Yg6u6jCWhqz79osu5accjEmw8KYID9zfWChaGyjDCmJIdy9fJjpvl9zXxZamkLam0kc5p/YQ=="
    crossorigin="anonymous"
/>
<style>
     @media screen and (max-width: 768px) {
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
            width: 1393px !important;
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
    }

    
</style>
@endsection
@section('main.content')
<div class="app-content content">
    <div class="content-wrapper">
        <!-- main content start -->
        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="repeater-default">
                                        <div data-repeater-list="car">
                                            <div class="form row align-items-end">
                                                <div class="form-group mb-1 col-sm-6 col-md-3" style="text-align: center;">
                                                    <label for="name">Search by Product Barcode:</label>
                                                    <br />
                                                    <input type="Text" class="form-control" id="searchBar" placeholder="Search" value="" />
                                                </div>
                                                <div class="form-group mb-1 col-sm-6 col-md-3" style="text-align: center;">
                                                    <label for="name">Search Product:</label>
                                                    <br />
                                                    <input type="Text" class="form-control" id="search" placeholder="Search" />
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-6" id="productType" style="text-align: center;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="purchaseInfo" style="display: none;">
                    <div class="col-12 col-lg-6" >
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body pt-0 pb-1">
                                    <form class="form" id="purchaseForm">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section mt-2"><i class="ft-flag"></i> Purchase Info</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="batch" id="batch">
                                                        <input type="hidden" name="sku" id="sku">
                                                        <label for="companyinput5">Store</label>
                                                        <select id="store" name="store" class="form-control">
                                                            <option value="none" selected="" disabled="">Store</option>
                                                            @foreach ($store as $item)
                                                            <option value="{{$item->storeId}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput5">Vendor</label>
                                                        <select id="vendor" name="vendor" class="form-control">
                                                            <option value="none" selected="" disabled="">Vendor</option>
                                                            @foreach ($vendor as $item)
                                                                <option value="{{$item->vendor_id}}">{{$item->vendor_shop_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput1">Purchase price</label>
                                                        <input type="text" id="purchasePrice" class="form-control" placeholder="Purchase price" name="purchasePrice" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput1">Sale Price</label>
                                                        <input type="text" id="sellPrice" class="form-control" placeholder="Sale Price" name="sellPrice" readonly/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput1">Quantity</label>
                                                        <input type="text" id="quantity" class="form-control" placeholder="quantity" name="quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput5">Vate Type</label>
                                                        <select id="vatType" name="vatType" class="form-control">
                                                            <option value="none" selected="" disabled="">Vat type</option>
                                                            <option value="%">%</option>
                                                            <option value="taka">Taka</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput1">Vat</label>
                                                        <input type="text" id="vat" class="form-control" placeholder="Vat" name="vat" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyinput1">Date</label>
                                                        <input type="date" id="purchaseDate" class="form-control" placeholder="Date" name="purchaseDate" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" id="purchaseSubmit" onclick="purchase()" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" id="purchaseTable">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Purchase Info</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0 pb-1">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" >
                                            <thead>
                                                <tr>
                                                    <th>Batch</th>
                                                    <th>SKU</th>
                                                    <th>Available</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                            </tbody>
                                        </table>
                                    </div>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.2/bootstrap-table.min.js" integrity="sha512-ffrlJUspXYOW6r1y8tWOJHIE6yRUsbq6ESHxcUNU9NU9GWDZ+sS9zlb5SvKqeMEw8XSJXyDLz59PZFIqHHpJBQ==" crossorigin="anonymous"></script>
<script>
var selectedProduct='';
$(function () {
  $("#search")
    .autocomplete({
      source: function (request, data) {
        $.ajax({
          url: "{{ route('product.search') }}",
          method: "post",
          data: {
            _token: "{{csrf_token()}}",
            productIdOrName: request.term,
          },
            success: function (products) {
                console.log(products.product);
                if (!products.product.length) {
                    var result = [{
                        label: "No matches found",
                        value: "no",
                    }, ];
                    data(result);
                } else {
                    result = $.map(products.product, function (obj) {
                        return {
                            label: obj.productName,
                            value: obj.productName,
                            allData: obj,
                        };
                    });
                    data(result);
                }
            },
        });
      },
      select: function (event, product) {
        //   $('#purchaseInfo').hide();
        if(product.item.allData.type=='single'){
           singlePurchase(product.item.allData.sku[0].skuId)
        }
        else{
            variationPurchase(product.item.allData.sku)
        }
        selectedProduct=product;
      },
    })
    .data("ui-autocomplete")._renderItem = function (ul, item) {
        try {
            return $("<li class='list-group-item col-md-6 text-primary'></li>")
                .attr("data-value", item.value)
                .append(
                    `<a> <img class="mr-3" style="width:25px;height:25px" onerror="this.src='{{url('public/featureImage/default.jpg')}}/'" src="{{url('public/featureImage')}}/${
        typeof item.allData.featureImage !== "undefined"
            ? item.allData.featureImage
            : "default.jpg"
        }">${item.label}</a>`
                )
                .appendTo(ul);
        } catch (err) {
            return $("<li class='list-group-item'></li>")
                .attr("data-value", item.value)
                .append(`${item.label}`)
                .appendTo(ul);
        }
    };
});

function variationProduct(e){
    $('#purchaseInfo').show();
    $('#purchaseTable').hide();
    $('#purchaseForm').trigger('reset');
    $("#purchaseForm").find("small").remove();
    let sku =$('#variation option:selected').val();
    $('#sku').val(sku)
    $.ajax({
          url: "{{ route('purchase.batch') }}",
          method: "post",
          data: {
            _token: "{{csrf_token()}}",
            'sku': sku,
          },
          success: function (data) {
            $('#purchaseTable').show();
            if (data.length!=0) {
                $('#tableBody').html('')
                let tableBody=''
                data.forEach(batch => {
                    tableBody+=`<tr id=batch${batch.batchId}>
                                    <th scope="row">${batch.batchId}</th>
                                    <td>${sku}</td>
                                    <td>${batch.Quantity}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="purchaseEdit(${batch.batchId},${batch.Quantity})" title="Purchase"><i class="ft-edit-3"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="purchaseDelete(${batch.batchId})" title="Return"><i class="ft-trash-2"></i></a>
                                    </td>
                                </tr>`
                });
                $('#tableBody').append(tableBody)
                }
                else{
                // $('#tableBody').html('<td colspan="6">No purchase Yet</td>')
                }
            }
            
    });
}

function purchase(){
    $.ajax({
            url: "{{ route('purchase.store') }}",
            method: 'post',
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($("#purchaseForm")[0]),
            success: function (batch) {
                $('#purchaseForm').trigger("reset");
                console.log(batch);
                $("#addPurchaseFrom").find("small").remove();
                toastr.success('Purchase completed successfully')
                $(`#batch${batch.batchId}`).remove();
                $('#tableBody').append(`<tr id=batch${batch.batchId}>
                                    <th scope="row">${batch.batchId}</th>
                                    <td>${batch.sku}</td>
                                    <td>${batch.quantity}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="purchaseEdit(${batch.batchId},${batch.quantity})" title="Purchase"><i class="ft-edit-3"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="purchaseDelete(${batch.batchId})" title="Return"><i class="ft-trash-2"></i></a>
                                    </td>
                                </tr>`)
             
            },
            error: function (err) {
                if (err.status === 422) {
                    $("#addPurchaseFrom").find("small").remove();
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        var errorMSG = error[0].replace('[]', '');
                        el.after($('<small style="color: red;font-weight: bold;">' + errorMSG + '</small>'));
                    });
                }
            }
        });
}

function purchaseDelete(batchId){
    let id=batchId;
    $.ajax({
        url: "{{ route('purchase.delete') }}",
        method: "post",
        data: {
        _token: "{{csrf_token()}}",
        'batchId': batchId,
        },
        success: function (data) {
            if(data.deleted){
             toastr.success(data.message)
            $(`#batch${batchId}`).remove();
            }
            else{
            toastr.error(data.message)
            }
        },
        error:(err)=>{
            toastr.error(data.message)
        }
            
    });
}

function purchaseEdit(batch,quantity){
    $('#purchaseForm').trigger("reset");
    $.ajax({
        url: "{{ route('purchase.editBatch') }}",
        method: "post",
        data: {
        _token: "{{csrf_token()}}",
        'batchId': batch,
        },
        success: function (data) {
            $('#store').val(data.storeId)
            $('#vendor').val(data.vendor)
            $('#vat').val(data.vat)
            $('#vatType').val(data.vatType)
            $('#quantity').attr('readonly', true);
            $('#quantity').val(quantity);
            $('#purchasePrice').attr('readonly', true);
            $('#purchasePrice').val(data.purchasePrice);
            $('#salePrice').attr('readonly', true);
            $('#purchaseDate').val(data.created_at.split('T')[0])
            $('#batch').val(data.batchId)
            $('#sku').val(data.skuId)
          }
        
    });
}

function singlePurchase(sku){
    $('#productType').html(`<p>Prdoduct Type:</p><h5>Single</h5>`);
    $('#purchaseInfo').show();
    $('#purchaseTable').hide();
    $("#purchaseForm").find("small").remove();
    $('#sku').val(sku)
    $.ajax({
        url: "{{ route('purchase.batch') }}",
        method: "post",
        data: {
        _token: "{{csrf_token()}}",
        'sku': sku,
        },
        success: function (data) {
        $('#purchaseTable').show();
        if (data.length!=0) {
            $('#tableBody').html('')
            let tableBody=''
            data.forEach(batch => {
                tableBody+=`<tr id=batch${batch.batchId}>
                                <th scope="row">${batch.batchId}</th>
                                <td>${sku}</td>
                                <td>${batch.Quantity}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="purchaseEdit(${batch.batchId},${batch.Quantity})" title="Purchase"><i class="ft-edit-3"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="purchaseDelete(${batch.batchId})" title="Return"><i class="ft-trash-2"></i></a>
                                </td>
                            </tr>`
            });

            $('#tableBody').append(tableBody)
            }
            else{
            // $('#tableBody').html('<td colspan="6">No purchase Yet</td>')
            }
        }
            
    });
}

function variationPurchase(sku){
    var variationValue=[]
    var variation=sku.map((prod)=>{
        if(Object.keys(prod.variation_relation).length !=0){
            $.each(prod.variation_relation,(key,value)=>{
                if( typeof (value.variation_detailsdata) != 'undefined'){
                    if(value.variation_detailsdata.variationType=='Color'){
                    var colorName = @json(unserialize (COLOR_CODE));
                    variationValue[value.skuId]=colorName[value.variation_detailsdata.variationValue.toUpperCase()]
                    }
                    else{
                    variationValue[value.skuId]=value.variation_detailsdata.variationValue
                    }
                }
            })
        }
    })
    if(variationValue.length){
        var html=`<option value="" readonly>Select</option>` ;
        variationValue.forEach((value,index)=>{
                html +=`<option value="${index}">${value}</option> `
        })
        $('#productType').html('');
        $('#productType').html(`<p>Select variation:</p><select class="form-control" name="variation" onchange="variationProduct(this)" id="variation">${html}</select>`)
    }
}

$("#searchBar").onEnter(function() {
    $('#productType').html('')
        $.ajax({
            url: "{{ route('product.search') }}",
            method: "post",
            data: {
                _token: "{{csrf_token()}}",
                barCode: $('#searchBar').val(),
            },
            success: function (response) {
                // $('#searchBar').val(`${response.product.productName}`)
                $('#search').val(`${response.product.productName}`)
                if(response.product.type == "variation"){
                    variationPurchase(response.product.sku)
                }
                else{
                    singlePurchase(response.product.sku[0].skuId)
                }
            },
            error:(response)=>{
                toastr.error(`${response.responseJSON.message}&#128148;`)
            }
        });
    });



</script>
@endsection
