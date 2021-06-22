@extends('layouts.main')
@section('header.css')
    <style>
        html body .content .content-wrapper {
            padding: 5px 20px 5px 20px;
        }

        /* table full */
        .table thead th {
            min-width: 150px;
        }
        .table thead th.delete-icon {
            min-width: 60px;
        }
        .table-striped tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0,0,0,.05);
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #fff;
        }
        .form-control-file {
            width: auto;
        }

        /* button */
        .example .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #bdc1c8;
        }
        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }
        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }
        .btn-toggle.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }
        .btn-toggle.active:before {
            opacity: 0.5;
        }
        .btn-toggle.active:after {
            opacity: 1;
        }
        .btn-toggle.active {
            background-color: #29b5a8;
        }
        /*ckeditor*/
        #cke_1_contents{
            height: 120px !important;
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Create Product</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
{{--                                {{dd(unserialize(COLOR_CODE))}}--}}
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-8">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Code</label>
                                                                    <input type="text" class="form-control" placeholder="Product Code" value="{{ old('productCode') }}" name="productCode">
                                                                    @error('productCode')
                                                                    <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Name</label>
                                                                    <input type="text" class="form-control" placeholder="Product Name" value="{{ old('productName') }}" name="productName">
                                                                    @error('productName')
                                                                    <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Slug</label>
                                                                    <input type="text" class="form-control" placeholder="Product Slug" value="{{ old('slug') }}" name="slug">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Tag</label>
                                                                    <input type="text" class="form-control" placeholder="Product Tag" value="{{ old('productTag') }}" name="tag">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Unit</label>
                                                                    <select name="fkidproduct_unit" class="form-control">
                                                                        <option value="" selected>Select Unit</option>
                                                                        @foreach($units as $unit)
                                                                            <option  value="{{ $unit->idproduct_unit }}">{{ $unit->product_unitName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="" selected>Select Status</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="inactive">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Brand</label>
                                                                    <select name="fkbrandId" class="form-control">
                                                                        <option value="" selected>Select Brand</option>
                                                                        @foreach($brands as $brand)
                                                                            <option value="{{ $brand->brandId }}">{{ $brand->brandName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Category</label>
                                                                    <select name="categoryId" class="parentCategory form-control">
                                                                        <option value="" selected>Select Category</option>
                                                                        @foreach($categories->where('parent', null) as $category)
                                                                            <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div id="sub2" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Sub Category</label>
                                                                    <select name="categoryId" id="subCat" class="subCategory form-control">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div id="sub3" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Sub subCategory</label>
                                                                    <select name="categoryId" id="subSubCat" class="form-control">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <br>
                                                                    <button style=" border: 1px solid #cacfe7; margin-top: 7px;  padding: 10px 5px;" class="btn w-100" type="button" data-toggle="collapse" data-target="#proDetails" aria-expanded="false" aria-controls="collapseExample">
                                                                        Product Details
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <br>
                                                                    <button style=" border: 1px solid #cacfe7; margin-top: 7px; padding: 10px 5px;" class="btn w-100" type="button" data-toggle="collapse" data-target="#shortDes" aria-expanded="false" aria-controls="collapseExample">
                                                                        Short description
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div id="productTypeMain" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Type</label>
                                                                    <select name="type" id="productType" class="form-control">
                                                                        <option value="" selected>Select Type</option>
                                                                        <option value="single">Single</option>
                                                                        <option value="variation">Variation</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div id="productTypeMain" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label for="newArrival" >New arrival </label>
                                                                    <input type="checkbox" class="" name="newArrival" id="newArrival" >
                                                                </div>
                                                            </div>
                                                            <div id="productTypeMain" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label for="featureProduct" >Feature product </label>
                                                                    <input type="checkbox" class="" name="featureProduct" id="featurProduct" >
                                                                </div>
                                                            </div>
                                                            <div id="singleSalePrice" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Sale Price</label>
                                                                    <input type="text" class="form-control" name="salePrice" id="salePrice" placeholder="sale price">
                                                                </div>
                                                            </div>
                                                            <div id="singleBarcode" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div data-repeater-list="repeater-group">
                                                                    <label>Barcode</label>
                                                                    <div class="input-group mb-1" data-repeater-item>
                                                                        <input type="text" placeholder="barcode" name="barcode" id="barcode" class="form-control" id="example-ql-input">
                                                                        <span class="input-group-append" id="button-addon2">
                                                                            <a onclick="barcodeGenerate()" style="color: white; font-weight: bold; padding: 14px 4px 10px;" class="btn btn-sm btn-danger" data-repeater-delete>
                                                                            generate
                                                                            </a>
                                                                        </span>
                                                                        @error('barcode')
                                                                        <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="singleStock" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Stock Alert</label>
                                                                    <input type="number" class="form-control" id="stockAlert" name="stockAlert" placeholder="stock alert">
                                                                </div>
                                                            </div>
                                                            <div id="productImages" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Images</label>
                                                                    <input type="file" class="form-control" name="productImages[]" multiple>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <div class="feature-img">
                                                            <div class="form-group">
                                                                <label>Feature Image</label>
                                                                <input type="file" class="form-control" name="featureImage" onchange="loadFile(event)">
                                                                <p class="mt-1"><img id="output" width="100" /></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="proDetails" class="collapse row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Product Details</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                                            <textarea class="form-control" name="productDetails" id="productDetails"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shortDes" class="collapse row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Short Description</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                                            <textarea class="form-control " name="shortDescription" id="shortDescription"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="submitBtn1" class="form-actions">
                                                <a href="{{ route('product.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                                            </div>
                                        </form>

                                        <div id="variationForm">
                                            <br>
                                            <h4 class="card-title" id="basic-layout-form">Variation Create</h4>
                                            <br>
                                            <form id="variationStore" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div class="form-group">
                                                                <label>Variation Type</label>
                                                                <select name="variationType1" id="variationType1" class="variationType1 form-control">
                                                                    <option value="" selected>Select Type</option>
                                                                    <option id="color1" value="Color">Color</option>
                                                                    <option id="size1" value="Size">Size</option>
                                                                    <option id="other1" value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3" id="variationValues1">
                                                            <div class="form-group">
                                                                <label>Variation Value</label>
                                                                <select name="variationValue1" id="variationValue1" class="form-control">
                                                                    <option value="" selected>Select Value</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div class="form-group">
                                                                <label>Variation Type</label>
                                                                <select name="variationType2" id="variationType2" class="variationType2 form-control">
                                                                    <option value="" selected>Select Type</option>
                                                                    <option id="color2" value="Color">Color</option>
                                                                    <option id="size2" value="Size">Size</option>
                                                                    <option id="other2" value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3" id="variationValues2">
                                                            <div class="form-group">
                                                                <label>Variation Value</label>
                                                                <select name="variationValue2" id="variationValue2" class="form-control">
                                                                    <option value="" selected>Select Value</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div class="form-group">
                                                                <label>Sale Price</label>
                                                                <input type="text" class="form-control" name="salePrice" id="salePrice" placeholder="sale price">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div class="form-group">
                                                                <label>Stock Alert</label>
                                                                <input type="number" class="form-control" id="stockAlert" name="stockAlert" placeholder="stock alert">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div data-repeater-list="repeater-group">
                                                                <label>Barcode</label>
                                                                <div class="input-group mb-1" data-repeater-item>
                                                                    <input type="text" placeholder="barcode" name="barcode" id="barcodeVariation" class="form-control" id="barcode">
                                                                    <span class="input-group-append" id="button-addon2">
                                                                    <a onclick="barcodeGenerateVariation()" style="color: white; font-weight: bold; padding-top: 14px;" class="btn btn-sm btn-danger" data-repeater-delete>
                                                                      generate
                                                                    </a>
                                                                </span>
                                                                    <div style="color: red" class="mb-2" id="barcodeError"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <div class="form-group">
                                                                <label>Variation Image</label>
                                                                <input type="file" id="varImage" class="form-control" name="variationImage[]" multiple>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-3">
                                                            <button  type="submit" style="text-decoration: none; color: #ffffff; line-height: 1.5" class="mt-2 form-control btn btn-info btn-sm">
                                                                <i class="la la-check"></i> Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--Temp Variation Table-->
                                            <div id="variationList"></div>
                                        </form>
                                        </div>
                                        <br>
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

    <script>
        $(document).ready( function () {
            CKEDITOR.replace('shortDescription');
            CKEDITOR.replace('productDetails');
        });
        const loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        $("#sub2").hide();
        $("#sub3").hide();
        $("#variationForm").hide();
        $("#singleSalePrice").hide();
        $("#singleStock").hide();
        $("#singleBarcode").hide();
        $("#productImages").hide();


        // Parent Category Change
        $(".parentCategory").change(function (){
            $("#sub3").hide();
            $("#sub2").hide();
            var categoryId = this.value;
            $.ajax({
                type:'POST',
                url:"{{ route('product.find.subCategory') }}",
                data:{'categoryId':categoryId, _token:"{{ csrf_token()}}"},
                success:function(data){
                    var length = data.subcategories.length;
                    if(length > 0){
                        $("#sub2").show();
                        console.log(length);
                        $("#subCat").empty();
                        $("#subCat").append('<option value="" selected>Select subCategory</option>')
                        $.each(data.subcategories, function (index, item) {
                            console.log(index, item);
                            $("#subCat").append("<option value= "+item.categoryId+">"+item.categoryName+"</option>")
                        });
                    }
                    else{
                        $("#sub2").hide();
                        $("#productTypeMain").show();
                    }
                }
            });
        });


        // Sub Category Change
        $(".subCategory").change(function (){
            $("#sub3").hide();
            var categoryId = this.value;
            $.ajax({
                type:'POST',
                url:"{{ route('product.find.subCategory') }}",
                data:{'categoryId':categoryId, _token:"{{ csrf_token()}}"},
                success:function(data){
                    var length = data.subcategories.length;
                    if(length > 0){
                        $("#sub3").show();
                        console.log(length);
                        $("#subSubCat").empty();
                        $("#subSubCat").append('<option value="" selected>Select subSubCategory</option>')
                        $.each(data.subcategories, function (index, item) {
                            console.log(index, item);
                            $("#subSubCat").append("<option value= "+item.categoryId+">"+item.categoryName+"</option>")
                        });
                    }
                    else{
                        $("#sub3").hide();
                    }
                }
            });
        });

        // Barcode Generate
        function barcodeGenerate(){
            var rnd = Math.floor(Math.random() * 1000000000);
            document.getElementById('barcode').value = rnd;
        }
        function barcodeGenerateVariation(){
            var rnd = Math.floor(Math.random() * 1000000000);
            document.getElementById('barcodeVariation').value = rnd;
        }

        //Product Type(single/variation) Select
        $("#productType").change(function(){
            var productType = this.value;
            if(productType == 'variation'){
                $("#singleSalePrice").hide();
                $("#singleStock").hide();
                $("#singleBarcode").hide();
                $("#productImages").hide();
                $("#variationForm").show();
                var $container = $("html,body");
                var $scrollTo = $('#variationForm');
                $container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop(), scrollLeft: 0},2000);

            }else if(productType == 'single'){
                $("#singleSalePrice").show();
                $("#singleStock").show();
                $("#singleBarcode").show();
                $("#productImages").show();
                $("#variationForm").hide();

            }else{
                $("#variationForm").hide();
                $("#submitBtn1").show();
                $("#singleSalePrice").hide();
                $("#singleBarcode").hide();
                $("#productImages").hide();
                $("#singleStock").hide();
            }
        });


        // 1st Variation Type Change
        $(".variationType1").change(function(){
           // var vari1 =  document.getElementById("variationType1").value
           var variationType = this.value;
            $('.variationType2 >option[value=' +variationType+ ']').remove();

            // var index = $('.variationType1').get(0).selectedIndex;
            // $('.variationType2 option:eq(' + index + ')').remove();
           // alert(variationType);
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
            $('.variationType1 >option[value=' +variationType+ ']').remove();
            // var index = $('.variationType2').get(0).selectedIndex;
            // $('.variationType1 option:eq(' + index + ')').remove();
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


        // Temp Variation Store
        $( "#variationStore" ).on( "submit", function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('product.variation.store')}}",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#variationList").html(data.html)
                    $("#variationStore").reset();
                },

                error: function(response) {
                    $('#barcodeError').text(response.responseJSON.errors.barcode);
                }
            });
            e.preventDefault();
        });

    </script>

@endsection

