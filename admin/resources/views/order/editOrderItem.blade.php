<div class="modal fade" id="edit-Ordered-Item-Quantity" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="orderReturnFrom">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Update Item Quantity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="orderItemId" value="@if(isset($orderedProduct)){{$orderedProduct->order_itemId}}@endif">
                        {{-- <input type="hidden" name="previousQuantity" value="@if(isset($orderedProduct)){{$orderedProduct->quiantity}}@endif"> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="rQuantity">Quantity</label>
                                <input type="number" name="rQuantity" id="rQuantity" class="form-control" value="@if(isset($orderedProduct)){{$orderedProduct->quiantity}}@endif">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="rQuantity">Order Type</label>
                                <select name="type" class="form-control">
                                <option value="" selected>Select a type</option>
                                <option value="in">in</option>
                                <option value="out">out</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="rQuantity">Identifier</label>
                                <select name="identifier" class="form-control">
                                <option value="" selected>Select an Identifier</option>
                                <option value="purchase">purchase</option>
                                <option value="sale">sale</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="returnSave()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function returnSave() {
        $.ajax({
            url: "{{ route('order.updateItemQuantity') }}",
            method: 'post',
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($("#orderReturnFrom")[0]),
            success: function (response) {
                // console.log('res',response.returnVal);
                // if(response.returnVal)
                
                    
                // toastr.success('Order Item updated');
            

               
                var url= window.location.href
                console.log('url',url);
                url=url.includes("order-details")
                if(url){
                    // console.log('url',url);
                    location.reload();
                }
                else{
                    $('#edit-Ordered-Item-Quantity').modal('hide');
                }

                if(response.returnVal == 'false'){
                    // alert('false in');
                    toastr.warning('Stock not available');
                }else{
                    toastr.success('Quantity Updated');
                }
                
                // else{
                   
                    // toastr.success('');
                // }
            },
            error: function (err) {
                console.log('error',err);
                if (err.status === 422) {
                    $("#orderReturnFrom").find("small").remove();
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
