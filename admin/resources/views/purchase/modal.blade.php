<div class="modal fade" id="purchase-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addPurchaseFrom">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Purchase</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="productId" value="@if(isset($data)) {{$data->productId}} @elseif(isset($batch)) {{$batch->sku->fkproductId}} @endif">
                        @if(isset($data) && !empty($data->skuId))
                        <input type="hidden" name="sku" value="{{$data->skuId}}">
                        @elseif(isset($batch))
                        @if(\Illuminate\Support\Str::contains($batch->newPurchase,'true') === false )
                            <input type="hidden" name="batch" value="{{$batch->batchId}}">
                        @endif
                        <input type="hidden" name="sku" value="{{$batch->sku->skuId}}">
                        @endif
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="store">Store</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <select id="store" name="store" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($store) && count($store)>0)
                                        @foreach($store as $storeSata)
                                            <option value="{{$storeSata->storeId}}"
                                                    @if(isset($batch) && $batch->storeId === $storeSata->storeId)
                                                    selected="selected"
                                                    @endif>{{$storeSata->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vendor">Vendor</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <select id="vendor" name="vendor" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($vendorInfo) && count($vendorInfo)>0)
                                        @foreach($vendorInfo as $vendorData)
                                            <option value="{{$vendorData->vendor_id}}"
                                                    @if(isset($batch) && $batch->vendor === $vendorData->vendor_id)
                                                    selected="selected"
                                                    @endif>{{$vendorData->vendor_shop_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchasePrice">Purchase Price</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <input type="text" value="{{ old('purchasePrice', $batch->purchasePrice ?? null) }}" id="purchasePrice" name="purchasePrice" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="salePrice">Sale Price</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <input type="text" value="{{ old('salePrice', $batch->salePrice ?? null) }}" id="salePrice" name="salePrice" class="form-control" readonly >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vatType">Vat Type</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <select name="vatType" class="form-control" id="vatType">
                                    <option value="">Select</option>
                                    <option value="%"
                                            @if(isset($batch) && $batch->vatType == '%')
                                            selected="selected"
                                            @endif>%</option>
                                    <option value="taka"
                                            @if(isset($batch) && $batch->vatType == 'taka')
                                            selected="selected"
                                            @endif>taka</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vat">Vat</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <input type="text" value="{{ old('vat', $batch->vat ?? null) }}" id="vat" name="vat" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purchaseDate">Date</label>
                                <input type="text" value="{{ old('purchaseDate', $batch->created_at ?? null) }}" id="purchaseDate" name="purchaseDate" class="form-control" >
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="purchaseSave()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $( "#purchaseDate" ).datepicker();
    });
    function purchaseSave() {
        $.ajax({
            url: "{{ route('purchase.store') }}",
            method: 'post',
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($("#addPurchaseFrom")[0]),
            success: function (data) {
                if (data.success){
                    $('#purchase-Modal').modal('hide');
                    $('#addPurchaseFrom').trigger('reset')
                    let available=parseInt($('#available{{$data->skuId}}').text())+parseInt($('#quantity').val())
                    $('#available{{$data->skuId}}').text(available)
                    var currentUrl = window.location.pathname.split('/');
                    if(currentUrl.includes('show')){
                        $('#purchaseTable').DataTable().draw();
                    }
                }
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
</script>
