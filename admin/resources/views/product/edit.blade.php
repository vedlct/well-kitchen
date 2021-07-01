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
            background-color: rgba(0, 0, 0, .05);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0, 0, 0, .05);
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
        #cke_1_contents {
            height: 120px !important;
        }

        .product-img-with-delete {
      position: relative;
      width: 70px;
      height: 70px;
    }
    .product-img-with-delete img {
      width: 70px;
      height: 70px;
      object-fit: cover;
    }
    .product-img-with-delete .hover-icon {
      display: none;
    }
    .product-img-with-delete:hover .hover-icon {
      display: block;
    }
    .product-img-with-delete .hover-icon {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #00000040;
      text-align: center;
      transition: 0.5s;
    }
    .product-img-with-delete .hover-icon i {
      padding-top: 48%;
      color: #fff;
      cursor: pointer;
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
                                    <h4 class="card-title" id="basic-layout-form">Edit Product</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{ route('product.update', $product->productId) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-lg-9 col-md-8">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Code</label>
                                                                    <input type="text" class="form-control" placeholder="Product Code" value="{{ $product->productCode }}" name="productCode">
                                                                    @error('productCode')
                                                                    <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Name</label>
                                                                    <input type="text" class="form-control" placeholder="Product Name" value="{{ $product->productName }}" name="productName">
                                                                    @error('productName')
                                                                    <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Slug</label>
                                                                    <input type="text" class="form-control" placeholder="Product Slug" value="{{ $product->slug }}" name="slug">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Tag</label>
                                                                    <input type="text" class="form-control" placeholder="Product Tag" value="{{ $product->tag }}" name="tag">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Unit</label>
                                                                    <select name="fkidproduct_unit" class="form-control">
                                                                        <option value="" selected>Select Unit</option>
                                                                        @foreach($units as $unit)
                                                                            <option @if($product->fkidproduct_unit == $unit->idproduct_unit) selected @endif value="{{ $unit->idproduct_unit }}">{{ $unit->product_unitName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option value="" selected>Select Status</option>
                                                                        <option @if($product->status == "active") selected @endif value="active">Active</option>
                                                                        <option @if($product->status == "inactive") selected @endif value="inactive">Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Brand</label>
                                                                    <select name="fkbrandId" class="form-control">
                                                                        <option value="" selected>Select Brand</option>
                                                                        @foreach($brands as $brand)
                                                                            <option @if($product->fkbrandId == $brand->brandId) selected @endif value="{{ $brand->brandId }}">{{ $brand->brandName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Category</label>
                                                                    <select name="categoryId" class="parentCategory form-control">
                                                                        <option value="" selected>Select Category</option>
                                                                        @foreach($categories as $category)
                                                                            <option @if($product->categoryId == $category->categoryId) selected @endif value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
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
                                                                    <select name="categoryId" id="subSubCat" class="form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Product Details</label>
                                                                    <br>
                                                                    <button style=" border: 1px solid #cacfe7;  padding: 10px 5px; width: 100%;" class="btn" type="button" data-toggle="collapse" data-target="#proDetails" aria-expanded="false" aria-controls="collapseExample">Product Details</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <br>
                                                                    <button style=" border: 1px solid #cacfe7; margin-top: 7px;  padding: 10px 5px; width: 100%;" class="btn" type="button" data-toggle="collapse" data-target="#shortDes" aria-expanded="false" aria-controls="collapseExample">
                                                                        Short description
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div id="productTypeMain" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Type</label>
                                                                    <select name="type" id="productType" class="form-control">
                                                                        <option value="" selected>Select Type</option>
                                                                        <option @if($product->type == "single") selected @endif value="single">Single</option>
                                                                        <option @if($product->type == "variation") selected @endif value="variation">Variation</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div id="productTypeMain" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label for="newArrival" >New arrival </label>
                                                                    <input type="checkbox" class="" name="newArrival" id="newArrival"  @if ($product->newarrived=='1') checked  @endif>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="featurProduct" >Feature product </label>
                                                                    <input type="checkbox" class="" name="featureProduct" id="featurProduct"  @if ($product->isrecommended=='1')   checked  @endif>
                                                                </div>
                                                            </div>

                                                            @if($product->type == 'single')
                                                            <div id="singleSalePrice" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Sale Price</label>
                                                                    <input type="number" class="form-control" name="salePrice" id="salePrice" value="{{ $sku?$sku->salePrice:'' }}">
                                                                </div>
                                                            </div>
                                                            <div id="singleBarcode" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div data-repeater-list="repeater-group">
                                                                    <label>Barcode</label>
                                                                    <div class="input-group mb-1" data-repeater-item>
                                                                        <input type="text" value="{{ $sku?$sku->barcode:'' }}" name="barcodeSingle" id="barcodeEdit" class="form-control" id="example-ql-input">
                                                                        <span class="input-group-append" id="button-addon2">
                                                                        <a onclick="barcodeGenerateEdit()" style="color: white; font-weight: bold; padding: 14px 4px 10px;" class="btn btn-sm btn-danger" data-repeater-delete>
                                                                        generate
                                                                        </a>
                                                                    </span>
                                                                        @error('barcodeSingle')
                                                                        <div style="color: red" class=" mb-2">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="singleStock" class="col-md-4 col-lg-4 col-xl-3">
                                                                <div class="form-group">
                                                                    <label>Stock Alert</label>
                                                                    <input type="number" class="form-control" id="stockAlert" name="stockAlert" value="{{ $sku?$sku->stockAlert:'' }}">
                                                                </div>
                                                            </div>
                                                            @endif


                                                        </div>
                                                    </div>

                                                    <!-- img area -->
                                                    <div class="col-lg-3 col-md-4">
                                                        <div class="feature-img mb-1">
                                                            <div class="form-group">
                                                                <label>Feature Image</label>
                                                                <input type="file" class="form-control" name="featureImage" onchange="loadFile(event)">
                                                                <p class="mt-1"><img id="output" src="{{url('public/featureImage/'.$product->featureImage ?? '')}}" height="100" width="100" /></p>
                                                            </div>
                                                        </div>
                                                        <div id="productImages">
                                                            <div class="form-group">
                                                                <label>Product Images</label>
                                                                <input type="file" class="form-control" name="productImages[]" multiple>
                                                            </div>
                                                        </div>
                                                        <div class="row m-0">
{{--                                                            <div style="padding: 4px;">--}}
{{--                                                                <div class="product-img-with-delete">--}}
{{--                                                                    <img src="{{url('public/featureImage/'.$product->featureImage)}}" alt="product_small_img1" />--}}
{{--                                                                    <div class="hover-icon">--}}
{{--                                                                        <a href="#" id="productImage" onclick="productImage({{$product->productId}})" >--}}
{{--                                                                        <i class="ft ft-trash"></i>--}}
{{--                                                                        </a>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
                                                            @if (count($product->images)>0)
                                                                @foreach ($product->images as $key=>$item)
                                                                    <div style="padding: 4px;">
                                                                        <div class="product-img-with-delete">
                                                                            <img src="{{url('public/productImages/'.$item->image)}}" alt="product_small_img1" />
                                                                            <div class="hover-icon">
                                                                                <a href="#" id="productImage" onclick="productImage({{$item->product_imageId}})" >
                                                                                <i class="ft ft-trash"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                @endif
                                                        {{--  @if (count($product->images)>0)
                                                        @foreach ($product->images as $key=>$item)  --}}
                                                            {{-- <div class="item">
                                                            <a href="#" class="product_gallery_item {{$key=='0' ? 'active' :''}} "
                                                                data-image="{{url('admin/public/productImages/'.$item->image)}}">
                                                                <img src="{{url('admin/public/productImages/'.$item->image)}}" alt="product_small_img1" />
                                                            </a>
                                                            </div> --}}


                                                            {{--  <a href="#" >
                                                                <img src="{{url('public/productImages/'.$item->image)}}" width="40px" alt="product_small_img1" />
                                                            </a>
                                                        @endforeach
                                                        @endif
                                                        --}}

                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="proDetails" class="collapse row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="productDetails">Product Details</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                                            <textarea class="form-control" name="productDetails" id="productDetails">{{ $product->details ? $product->details->description : ''  }} </textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="shortDes" class="collapse row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Description">Short Description</label><span style="color: red;margin-left: 5px;font-weight: bold;">*</span>
                                                            <textarea class="form-control " name="shortDescription" id="shortDescription">{{ $product->details ? $product->details->fabricDetails : ''  }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="submitBtn1" class="form-actions">
                                                <a href="{{ route('product.show') }}">
                                                    <button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button>
                                                </a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Update</button>
                                            </div>
                                        </form>
                                        <div id="variationCreateForm">
                                            <br>
                                            <h4 class="card-title" id="basic-layout-form">Variation Create</h4>
                                            <br>
                                            <form id="variationAddNew" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <div class="form-group">
                                                                <label>Variation Type</label>
                                                                <select name="variationType1" id="variationType1" class="variationType1 form-control">
                                                                    <option value="" selected>Select Type</option>
                                                                    @foreach($variations->unique('variationType') as $variationType)
                                                                    <option id="color1" value="{{$variationType->variationType}}">{{$variationType->variationType}}</option>
                                                                    @endforeach
                                                                    {{-- <option value="Color">Color</option>
                                                                    <option value="Size">Size</option>
                                                                    <option value="Other">Other</option> --}}
                                                                </select>
                                                                <div class="divAjaxError" style="color: red" class="mb-2" id="variationType1Error"></div>
                                                                <input type="hidden" id="productId" value="{{ $product->productId }}" name="productId">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2" id="variationValues1">
                                                            <div class="form-group">
                                                                <label>Variation Value</label>
                                                                <select name="variationValue1" id="variationValue1" class="form-control">
                                                                    <option value="" selected>Select Value</option>
                                                                </select>
                                                                <div class="divAjaxError" style="color: red" class="mb-2" id="variationValue1Error"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <div class="form-group">
                                                                <label>Variation Type</label>
                                                                <select name="variationType2" id="variationType2" class="variationType2 form-control">
                                                                    <option value="" selected>Select Type</option>
                                                                    @foreach($variations->unique('variationType') as $variationType)
                                                                    <option id="color1" value="{{$variationType->variationType}}">{{$variationType->variationType}}</option>
                                                                    @endforeach
                                                                    {{-- <option value="Color">Color</option>
                                                                    <option value="Size">Size</option>
                                                                    <option value="Other">Other</option> --}}
                                                                </select>
                                                                <div class="divAjaxError" style="color: red" class="mb-2" id="variationType2Error"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2" id="variationValues2">
                                                            <div class="form-group">
                                                                <label>Variation Value</label>
                                                                <select name="variationValue2" id="variationValue2" class="form-control">
                                                                    <option value="" selected>Select Value</option>
                                                                </select>
                                                                <div class="divAjaxError" style="color: red" class="mb-2" id="variationValue2Error"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <div class="form-group">
                                                                <label>Sale Price</label>
                                                                <input type="number" class="form-control" name="salePrice" id="salePrice" placeholder="sale price">
                                                                <div class="divAjaxError" style="color: red" class="mb-2" id="salePriceError"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <div class="form-group">
                                                                <label>Stock Alert</label>
                                                                <input type="number" class="form-control" id="stockAlert" name="stockAlert" placeholder="stock alert">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-3 col-xl-2">
                                                            <div data-repeater-list="repeater-group">
                                                                <label>Barcode</label>
                                                                <div class="input-group mb-1" data-repeater-item>
                                                                    <input type="text" placeholder="barcode" name="barcode" id="barcodeVariationAdd" class="form-control" id="barcode">
                                                                    <span class="input-group-append" id="button-addon2">
                                                                    <a onclick="barcodeGenerateVariationAdd()" style="color: white; font-weight: bold; padding: 14px 4px 10px;" class="btn btn-sm btn-danger" data-repeater-delete>
                                                                      generate
                                                                    </a>
                                                                </span>
                                                                    <div class="divAjaxError" style="color: red" class="mb-2" id="barcodeError"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <div class="form-group">
                                                                <label>Variation Image</label>
                                                                <input type="file" id="varImage" class="form-control" name="variationImage[]" multiple>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xl-2">
                                                            <button type="submit" style="text-decoration: none; color: #ffffff; line-height: 1.5" class="mt-2 form-control btn btn-info btn-sm"><i class="la la-check"></i> Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            </form>
                                        </div>
                                        <div id="variationForm">
                                            <br>
                                            <div id="variationEditForm"></div>

                                            <div id="variationList"></div>
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

    <script>
        const loadFile = function(event) {
            var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
let productImageId;
        $("#sub2").hide();
        $("#sub3").hide();
        $("#variationForm").hide();
        $("#variationCreateForm").hide();

        //Document On Ready
        $(document).ready(function () {
            CKEDITOR.replace('shortDescription');
            CKEDITOR.replace('productDetails');

            @if($product->type == "variation")
            var productId = {{ $product->productId }}
            $("#variationForm").show();
            $("#variationCreateForm").hide();
            $.ajax({
                type: 'POST',
                url: "{{ route('product.variation.ajax.show') }}",
                data: {'productId': productId, _token: "{{ csrf_token()}}"},
                success: function (data) {
                    console.log('data');
                    $("#variationList").html(data);
                }
            });
            @endif
        });


        // Parent Category Change
        $(".parentCategory").change(function () {
            $("#sub3").hide();
            $("#sub2").hide();
            var categoryId = this.value;
            $.ajax({
                type: 'POST',
                url: "{{ route('product.find.subCategory') }}",
                data: {'categoryId': categoryId, _token: "{{ csrf_token()}}"},
                success: function (data) {
                    var length = data.subcategories.length;
                    if (length > 0) {
                        $("#sub2").show();
                        console.log(length);
                        $("#subCat").empty();
                        $("#subCat").append('<option value="" selected>Select subCategory</option>')
                        $.each(data.subcategories, function (index, item) {
                            console.log(index, item);
                            $("#subCat").append("<option value= " + item.categoryId + ">" + item.categoryName + "</option>")
                        });
                    } else {
                        $("#sub2").hide();
                        $("#productTypeMain").show();
                    }
                }
            });
        });


        // Sub Category Change
        $(".subCategory").change(function () {
            $("#sub3").hide();
            var categoryId = this.value;
            $.ajax({
                type: 'POST',
                url: "{{ route('product.find.subCategory') }}",
                data: {'categoryId': categoryId, _token: "{{ csrf_token()}}"},
                success: function (data) {
                    var length = data.subcategories.length;
                    if (length > 0) {
                        $("#sub3").show();
                        console.log(length);
                        $("#subSubCat").empty();
                        $("#subSubCat").append('<option value="" selected>Select subSubCategory</option>')
                        $.each(data.subcategories, function (index, item) {
                            console.log(index, item);
                            $("#subSubCat").append("<option value= " + item.categoryId + ">" + item.categoryName + "</option>")
                        });
                    } else {
                        $("#sub3").hide();
                    }
                }
            });
        });


        //Product Type Select
        $("#productType").change(function () {
            var productType = this.value;
            if (productType == 'variation') {
                $("#variationForm").show();
                var $container = $("html,body");
                var $scrollTo = $('#variationForm');
                $container.animate({
                    scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop(),
                    scrollLeft: 0
                }, 2000);

            } else {
                $("#variationForm").hide();
                $("#submitBtn1").show();
            }
        });

        function productImage(id){
            productImageId = id;
                $.ajax({
                    type: 'POST',
                    url: "{{ route('product.productImage.delete') }}",
                    data: {'productImageId': productImageId, _token: "{{ csrf_token()}}"},
                    success: function (data) {
                        toastr.success('Image Deleted Successfully')
                    }
                });
        }

        function barcodeGenerateEdit(){
            var rnd = Math.floor(Math.random() * 1000000000);
            document.getElementById('barcodeEdit').value = rnd;
        }

        function barcodeGenerateVariationAdd(){
            var rnd = Math.floor(Math.random() * 1000000000);
            document.getElementById('barcodeVariationAdd').value = rnd;
        }


    </script>

@endsection

