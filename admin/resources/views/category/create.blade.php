@extends('layouts.main')
@section('header.css')
    <style>
        html body .content .content-wrapper {
            padding: 5px 20px 5px 20px;
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
                                    <h4 class="card-title" id="basic-layout-form">Create Category</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label>Category Type</label>
                                                    <select id="categoryType" class="form-control">
                                                        <option value="" selected>Select Type</option>
                                                        <option value="1">Main Category</option>
                                                        <option value="2">Sub Category</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="companyName">Category Name</label>
                                                    <input type="text" class="form-control" placeholder="Category Name" value="{{ old('categoryName') }}" name="categoryName">
                                                </div>

                                                <div id="subCategory" class="form-group">
                                                    <label>Parent Category</label>
                                                    <select name="parent" id="parentCategory" class="form-control">
                                                        <option value="" selected>Select Category</option>
                                                        @foreach($categories->where('parent', null) as $category)
                                                        <option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div id="" class="form-group">
                                                    <label>Home show</label>
                                                    <select name="homeShow" id="" class="form-control">
                                                        <option value="" selected>Select One</option>
                                                        <option value="1"> Active</option>
                                                        <option value="0"> Inactive</option>

                                                    </select>
                                                </div>
                                                <div id="subSubCategory" class="form-group">
                                                    <label>Sub Category</label>
                                                    <select name="subParent" id="subCat" class="form-control">


                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Category Image</label>
                                                    <input type="file" class="form-control" name="imageLink">
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <a href="{{ route('category.show') }}"><button type="button" class="btn btn-danger mr-1"><i class="ft-x"></i> Cancel</button></a>
                                                <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                                            </div>
                                        </form>
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
            $("#subCategory").hide();
            $("#subSubCategory").hide();

        $("#categoryType").change(function (){
           var categoryType = this.value;
            if(categoryType == 2){
               $("#subCategory").show();
            }
        });
    </script>
    <script>
        $("#parentCategory").change(function (){
            var subCategory = this.value;
            $.ajax({
                type: 'POST',
                url: "{{ route('category.check.subCategory') }}",
                data: { 'subCategory': subCategory, _token:"{{ csrf_token() }}"},
                success: function (data){
                    console.log(data);
                    var length = data.subSubCategories.length;
                    if(length > 0){
                        $("#subSubCategory").show();
                        console.log(length);
                        $("#subCat").empty();
                        $("#subCat").append('<option value="" selected>Select Category</option>')
                        $.each(data.subSubCategories, function (index, item) {
                            console.log(index, item);
                            $("#subCat").append("<option value= "+item.categoryId+">"+item.categoryName+"</option>")
                        });
                    }
                    else{
                        $("#subSubCategory").hide();

                    }
                }
            });
        });
    </script>
@endsection
