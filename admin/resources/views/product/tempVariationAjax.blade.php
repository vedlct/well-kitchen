<style>
    /*variation list on edit*/

    .overlay {
        transition: 0.5s;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        text-align: center;
        background: #00000030;
        padding-top: 14px;
    }
    .delete-icon {
        color: #fff;
        font-size: 18px;
    }
    .variation-img:hover .overlay {
        display: block !important;
        transition: 0.5s;
    }
</style>
<h4 class="card-title" id="basic-layout-form">Variation List
    @if(empty($product_variations))
        <span id="addbtn"></span>
        <a title="add variation" id="addNewVariation" class="btn btn-blue btn-sm" style="color: #ffffff"><i class="ft-plus-square"></i></a>
    @endif
</h4><br>

<div class="row">
    <div class="table-responsive">
        <table id="productVariation" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Barcode</th>
                <th scope="col">Type</th>
                <th scope="col">Value</th>
                <th scope="col">Saleprice</th>
                <th scope="col">Stock Alert</th>
                <th scope="col">Variation Image</th>
                @if(empty($product_variations))
                    <th scope="col">Status</th>
                @endif
                <th scope="col">Action</th>
            </tr>
            </thead>

            <tbody>

            @if(empty($product_variations))

                <!--On Product Edit-->
                @foreach($products->sku as $sku)
                    <tr>
                        <td>{{ $sku->barcode }}</td>
                        <td>
                            @foreach($sku->variationRelation as $key => $variationRelation)
                                {{ $variationRelation->variationDetailsdata ? $variationRelation->variationDetailsdata->variationType : '' }}@if($key != 1),@endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($sku->variationRelation as $key => $variationRelation)
                                {{ $variationRelation->variationDetailsdata ? $variationRelation->variationDetailsdata->variationValue : '' }}@if($key != 1),@endif
                            @endforeach
                        </td>
                        <td>{{ $sku->salePrice }}</td>
                        <td>{{ $sku->stockAlert }}</td>
                        <td>
                            @foreach ($sku->variationImages as $vimage)
                                <div class="variation-img position-relative d-inline-block">
                                    <img  class="variationImg" src="{{ url('public/productImages', $vimage->image) }}" width="50px" alt="Variation Image">
                                    <div class="overlay d-none">
                                        <a href="{{ route('product.variation.image.delete', $vimage->product_imageId) }}" class="icon" title="Variation Image">
                                            <i class="ft ft-trash-2 delete-icon"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                        <td class="skuStatus{{$sku->skuId}}">{{ $sku->status }}</td>
                        <td>
                            <a title="edit" onclick="editVariation(this)" data-panel-sku="{{$sku->skuId}}" style="color: #fff" class="btn btn-warning btn-sm"><i class="ft-edit"></i></a>
                            <a title="status Change" onclick="variationStatus(this)" data-panel-sku="{{$sku->skuId}}" style="color: #fff" class="btn btn-primary btn-sm statusIcon{{$sku->skuId}}"><i class="ft ft-check-circle"></i></a>
                        </td>
                    </tr>
                @endforeach
                <!--End-->

            @else

                <!--On Product Add-->
                @foreach($product_variations as $product_variation)
                    <tr>
                        <td>{{ $product_variation->barcode }}</td>
                        <td>{{ $product_variation->variationType1 }}, {{ $product_variation->variationType2 }}</td>
                        <td>{{ $product_variation->variationValue1 }}, {{ $product_variation->variationValue2 }}</td>
                        <td>{{ $product_variation->salePrice }}</td>
                        <td>{{ $product_variation->stockAlert }}</td>
                        <td>
                            @if(!empty($product_variation->variationImage))
                                @foreach (json_decode($product_variation->variationImage) as $vimage)
                                    <img src="{{ url('public/productImages', $vimage) }}" width="50px" alt="Variation Image">
                                @endforeach
                            @else
                                null
                            @endif
                        </td>
                        <td>
                            <a title="delete" class="btn btn-danger btn-sm"><i class="ft-trash-2">delete</i></a>
                        </td>
                    </tr>
                @endforeach
                <!--End-->
            @endif

            </tbody>
        </table>
    </div>
</div>









{{--old--}}
{{--<style>--}}
{{--    /*variation list on edit*/--}}

{{--    .overlay {--}}
{{--        transition: 0.5s;--}}
{{--        position: absolute;--}}
{{--        top: 0;--}}
{{--        bottom: 0;--}}
{{--        right: 0;--}}
{{--        left: 0;--}}
{{--        text-align: center;--}}
{{--        background: #00000030;--}}
{{--        padding-top: 14px;--}}
{{--    }--}}
{{--    .delete-icon {--}}
{{--        color: #fff;--}}
{{--        font-size: 18px;--}}
{{--    }--}}
{{--    .variation-img:hover .overlay {--}}
{{--        display: block !important;--}}
{{--        transition: 0.5s;--}}
{{--    }--}}
{{--</style>--}}
{{--<h4 class="card-title" id="basic-layout-form">Variation List--}}
{{--    @if(empty($product_variations))--}}
{{--        <span id="addbtn"></span>--}}
{{--        <a title="add variation" id="addNewVariation" class="btn btn-blue btn-sm" style="color: #ffffff"><i class="ft-plus-square"></i></a>--}}
{{--    @endif--}}
{{--</h4><br>--}}

{{--<div class="row">--}}
{{--    <div class="table-responsive">--}}
{{--        <table id="productVariation" class="table table-striped">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col">Barcode</th>--}}
{{--                <th scope="col">Type</th>--}}
{{--                <th scope="col">Value</th>--}}
{{--                <th scope="col">Saleprice</th>--}}
{{--                <th scope="col">Stock Alert</th>--}}
{{--                <th scope="col">Variation Image</th>--}}
{{--                @if(empty($product_variations))--}}
{{--                <th scope="col">Status</th>--}}
{{--                @endif--}}
{{--                <th scope="col">Action</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}

{{--            <tbody>--}}

{{--            @if(empty($product_variations))--}}

{{--                <!--On Product Edit-->--}}
{{--                @foreach($products->sku as $sku)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $sku->barcode }}</td>--}}
{{--                        <td>--}}
{{--                            @foreach($sku->variationRelation as $key => $variationRelation)--}}
{{--                            {{ $variationRelation->variationDetailsdata ? $variationRelation->variationDetailsdata->variationType : '' }}@if($key != 1),@endif--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            @foreach($sku->variationRelation as $key => $variationRelation)--}}
{{--                                {{ $variationRelation->variationDetailsdata ? $variationRelation->variationDetailsdata->variationValue : '' }}@if($key != 1),@endif--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td>{{ $sku->salePrice }}</td>--}}
{{--                        <td>{{ $sku->stockAlert }}</td>--}}
{{--                        <td>--}}
{{--                            @foreach ($sku->variationImages as $vimage)--}}
{{--                                <div class="variation-img position-relative d-inline-block">--}}
{{--                                    <img  class="variationImg" src="{{ url('public/productImages', $vimage->image) }}" width="50px" alt="Variation Image">--}}
{{--                                    <div class="overlay d-none">--}}
{{--                                        <a href="{{ route('product.variation.image.delete', $vimage->product_imageId) }}" class="icon" title="Variation Image">--}}
{{--                                            <i class="ft ft-trash-2 delete-icon"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td class="skuStatus{{$sku->skuId}}">{{ $sku->status }}</td>--}}
{{--                        <td>--}}
{{--                            <a title="edit" onclick="editVariation(this)" data-panel-sku="{{$sku->skuId}}" style="color: #fff" class="btn btn-warning btn-sm"><i class="ft-edit"></i></a>--}}
{{--                            <a title="status Change" onclick="variationStatus(this)" data-panel-sku="{{$sku->skuId}}" style="color: #fff" class="btn btn-primary btn-sm statusIcon{{$sku->skuId}}"><i class="ft ft-check-circle"></i></a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                <!--End-->--}}

{{--            @else--}}

{{--                <!--On Product Add-->--}}
{{--                @foreach($product_variations as $product_variation)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $product_variation->barcode }}</td>--}}
{{--                        <td>{{ $product_variation->variationType1 }}, {{ $product_variation->variationType2 }}</td>--}}
{{--                        <td>{{ $product_variation->variationValue1 }}, {{ $product_variation->variationValue2 }}</td>--}}
{{--                        <td>{{ $product_variation->salePrice }}</td>--}}
{{--                        <td>{{ $product_variation->stockAlert }}</td>--}}
{{--                        <td>--}}
{{--                            @if(!empty($product_variation->variationImage))--}}
{{--                            @foreach (json_decode($product_variation->variationImage) as $vimage)--}}
{{--                                <img src="{{ url('public/productImages', $vimage) }}" width="50px" alt="Variation Image">--}}
{{--                            @endforeach--}}
{{--                            @else--}}
{{--                                null--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a title="delete" class="btn btn-danger btn-sm"><i class="ft-trash-2">delete</i></a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                <!--End-->--}}
{{--            @endif--}}

{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

<script>

    //Edit Variation
    function editVariation(x) {
        $("#variationCreateForm").hide();
        $("#addbtn").hide();
        $("#addNewVariation").show();
        skuId = $(x).data('panel-sku');
        $.ajax({
            type: "POST",
            url: "{{route('product.variation.ajax.edit')}}",
            data: {_token: "{{ csrf_token() }}", 'skuId': skuId,},
            success: function (data) {
                console.log(data);
                $("#variationEditForm").html(data)
            }
        });
    }

    //Edit Variation Status
    function variationStatus(x){
        skuId = $(x).data('panel-sku');
        $.ajax({
            type: "POST",
            url: "{{route('product.variation.status')}}",
            data: {_token: "{{ csrf_token() }}", 'skuId': skuId,},
            success: function (data){
                console.log(data);
                if(data.status == 'active'){
                    $(".statusIcon" + data.skuId).empty().append('<i class="ft ft-check-circle"></i>')
                    $(".skuStatus" + data.skuId).empty().append(data.status)
                }
                if(data.status == 'inactive'){
                    $(".statusIcon" + data.skuId).empty().append('<i class="ft ft-lock"></i>')
                    $(".skuStatus" + data.skuId).empty().append(data.status)
                }

            }
        });
    }


    //Variation Add Form on Edit
    $("#addNewVariation").click(function (){
        $("#variationCreateForm").show();
        $(".editTitle").hide();
        $("#variationUpdate").hide();
        var el = $('<a title="cancel" class="btn btn-warning btn-sm" style="color: #ffffff"><i class="ft-minus-square"></i></a>');
        $("#addbtn").append(el);
        $("#addNewVariation").hide();
        el.click(function (){
            $("#addbtn").empty();
            $("#addNewVariation").show();
            $("#editTitle").hide();
            $("#variationCreateForm").hide();
        });
    });


    //Store New Variation on Edit
    $( "#variationAddNew" ).on( "submit", function(e) {
        e.preventDefault();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            type: "POST",
            url: "{{route('product.variation.addNew')}}",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#variationList").html(data.html);

                $('#variationType1Error').empty();
                $('#variationValue1Error').empty();
                $('#variationType2Error').empty();
                $('#variationValue2Error').empty();
                $('#salePriceError').empty();
                $('#barcodeError').empty();
                $('#variationValue1').empty();
                $('#variationValue2').empty();
            },

            error: function(response) {
                $('#variationType1Error').empty().text(response.responseJSON.errors.variationType1);
                $('#variationValue1Error').empty().text(response.responseJSON.errors.variationValue1);
                $('#variationType2Error').empty().text(response.responseJSON.errors.variationType2);
                $('#variationValue2Error').empty().text(response.responseJSON.errors.variationValue2);
                $('#salePriceError').empty().text(response.responseJSON.errors.salePrice);
                $('#barcodeError').empty().text(response.responseJSON.errors.barcode);
            }
        });
        e.preventDefault();
    });


    // 1st Variation Type Change
    $(".variationType1").change(function(){
        var variationType = this.value;
        $.ajax({
            type: "POST",
            url: "{{route('product.variationTypeChange')}}",
            data: {_token: "{{ csrf_token() }}", 'variationType': variationType},
            success: function (data){
                console.log(data);
                $("#variationValues1").html(data)
            }

        });
    });


    // 2nd Variation Type Change
    $(".variationType2").change(function(){
        var variationType = this.value;
        $.ajax({
            type: "POST",
            url: "{{route('product.variationTypeChange2')}}",
            data: {_token: "{{ csrf_token() }}", 'variationType': variationType},
            success: function (data){
                console.log(data);
                $("#variationValues2").html(data)
            }
        });
    });










    {{--//Edit Variation--}}
    {{--function editVariation(x) {--}}
    {{--    $("#variationCreateForm").hide();--}}
    {{--    $("#addbtn").hide();--}}
    {{--    $("#addNewVariation").show();--}}
    {{--    skuId = $(x).data('panel-sku');--}}
    {{--    $.ajax({--}}
    {{--        type: "POST",--}}
    {{--        url: "{{route('product.variation.ajax.edit')}}",--}}
    {{--        data: {_token: "{{ csrf_token() }}", 'skuId': skuId,},--}}
    {{--        success: function (data) {--}}
    {{--            console.log(data);--}}
    {{--            $("#variationEditForm").html(data)--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

    {{--//Edit Variation Status--}}
    {{--function variationStatus(x){--}}
    {{--    skuId = $(x).data('panel-sku');--}}
    {{--    $.ajax({--}}
    {{--       type: "POST",--}}
    {{--       url: "{{route('product.variation.status')}}",--}}
    {{--       data: {_token: "{{ csrf_token() }}", 'skuId': skuId,},--}}
    {{--       success: function (data){--}}
    {{--           console.log(data);--}}
    {{--           if(data.status == 'active'){--}}
    {{--               $(".statusIcon" + data.skuId).empty().append('<i class="ft ft-check-circle"></i>')--}}
    {{--               $(".skuStatus" + data.skuId).empty().append(data.status)--}}
    {{--           }--}}
    {{--           if(data.status == 'inactive'){--}}
    {{--               $(".statusIcon" + data.skuId).empty().append('<i class="ft ft-lock"></i>')--}}
    {{--               $(".skuStatus" + data.skuId).empty().append(data.status)--}}
    {{--           }--}}

    {{--       }--}}
    {{--    });--}}
    {{--}--}}


    {{--//Variation Add Form on Edit--}}
    {{--$("#addNewVariation").click(function (){--}}
    {{--    $("#variationCreateForm").show();--}}
    {{--    $(".editTitle").hide();--}}
    {{--    $("#variationUpdate").hide();--}}
    {{--    var el = $('<a title="cancel" class="btn btn-warning btn-sm" style="color: #ffffff"><i class="ft-minus-square"></i></a>');--}}
    {{--    $("#addbtn").append(el);--}}
    {{--    $("#addNewVariation").hide();--}}
    {{--    el.click(function (){--}}
    {{--        $("#addbtn").empty();--}}
    {{--        $("#addNewVariation").show();--}}
    {{--        $("#editTitle").hide();--}}
    {{--        $("#variationCreateForm").hide();--}}
    {{--    });--}}
    {{--});--}}


    {{--//Store New Variation on Edit--}}
    {{--$( "#variationAddNew" ).on( "submit", function(e) {--}}
    {{--    e.preventDefault();--}}
    {{--    $.ajax({--}}
    {{--        type: "POST",--}}
    {{--        url: "{{route('product.variation.addNew')}}",--}}
    {{--        data:new FormData(this),--}}
    {{--        dataType:'JSON',--}}
    {{--        contentType: false,--}}
    {{--        cache: false,--}}
    {{--        processData: false,--}}
    {{--        success: function (data) {--}}
    {{--            $("#variationList").html(data.html);--}}
    {{--        }--}}
    {{--    });--}}
    {{--    e.preventDefault();--}}
    {{--});--}}


    {{--// 1st Variation Type Change--}}
    {{--$(".variationType1").change(function(){--}}
    {{--    var variationType = this.value;--}}
    {{--    $.ajax({--}}
    {{--        type: "POST",--}}
    {{--        url: "{{route('product.variationTypeChange')}}",--}}
    {{--        data: {_token: "{{ csrf_token() }}", 'variationType': variationType},--}}
    {{--        success: function (data){--}}
    {{--            console.log(data);--}}
    {{--            $("#variationValues1").html(data)--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}


    {{--// 2nd Variation Type Change--}}
    {{--$(".variationType2").change(function(){--}}
    {{--    var variationType = this.value;--}}
    {{--    $.ajax({--}}
    {{--        type: "POST",--}}
    {{--        url: "{{route('product.variationTypeChange2')}}",--}}
    {{--        data: {_token: "{{ csrf_token() }}", 'variationType': variationType},--}}
    {{--        success: function (data){--}}
    {{--            console.log(data);--}}
    {{--            $("#variationValues2").html(data)--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}


</script>


