<div class="modal fade" id="purchase-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addPurchaseFrom">
                @csrf
                <input type="hidden" name="batch" value="{{$batch->batchId}}">
                <input type="hidden" name="skuId" value="{{$batch->skuId}}">
              
                <div class="modal-header">
                    <h4 class="modal-title">Purchase Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <input type="text" value="{{ $batch->quantity ?? null }}" id="quantity" name="quantity" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vatType"> Type</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                <select name="type" class="form-control" id="type">
                                    <option value="">Select</option>
                                    <option value="in" >IN</option>
                                    <option value="out" >Out</option>
                                </select>
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
            url: "{{ route('purchase.editStockUpdate') }}",
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
