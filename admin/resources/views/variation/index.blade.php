@extends('layouts.main')
@section('header.css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-minicolors/2.3.2/jquery.minicolors.css" integrity="sha512-KeEVSm+Vk+xYRPc7EQnXb4mUsNykSh6WFGZUB/UqerCrRc1kuIjEbcsK8LMZGfOnVQuWRI8Bm1dgFvcSqVmhZw==" crossorigin="anonymous" />
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
            <!-- category datatable began -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Variation</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                        <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                 <div class="table-responsive">
                                        <table class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Selection Type</th>
                                                <th>Values</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($variationData as $variationDataKey => $variationDataValue)
                                                @php
                                                    $valueData = [];
                                                    foreach($variationDataValue as $value){
                                                        array_push($valueData,$value->variationValue);
                                                    }
                                                    $valueData = implode(', ',$valueData);
                                                @endphp
                                            <tr>
                                                <th scope="row" class="text-center">{{$variationDataKey}}</th>
                                                <td class="text-center">{{$value->selectionType}}</td>
                                                @if($variationDataKey == 'Color')
                                                    <td>
                                                        @foreach($variationDataValue as $value)
                                                            <a class="btn btn-sm" style="background: {{$value->variationValue}}"></a>
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td>{{$valueData}}</td>
                                                @endif
                                                <td class="text-center"><a class="btn btn-warning btn-sm" onclick="editVariation('{{$variationDataKey}}')" title="Edit"><span class="ft-edit"></span></a></td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="variationModal"></div>
@endsection
@section('footer.js')
<script>
    function editVariation(type) {
        $.ajax({
            type: 'post',
            url: "{!! route('variation.edit') !!}",
            cache: false,
            data: {_token: "{{csrf_token()}}",'type': type},
            success: function (data) {
                $('#variationModal').html(data);
                $('#variationModal').modal();
            }
        });
    }

   function addVariation() {
       $.ajax({
           url: "{!! route('variation.add') !!}",
           method: "get",
            cache: false,
            processData: false,
            contentType: false,
           success: function(data){
               $('#variationModal').html(data);
                $('#variationModal').modal();
          }
        });
    }

    function variationSubmit() {
        $.ajax({
            url: "{!! route('variation.submit') !!}",
            method: "POST",
            cache: false,
            processData: false,
            contentType: false,
            data: new FormData($("#variationForm")[0]),
            success: function(data){
                $('#variationModal').modal('hide');
                $('#variationForm').trigger('reset');
                toastr.success(data.message);
                location.reload(1);
            },
            error: function (err) {
                if (err.status == 422) {
                    $("#variationForm").find("small").remove();
                    $.each(err.responseJSON.errors, function (i, error) {

                        if (~i.indexOf("variationValue")){
                            var el = $(document).find('[name="variationValue[]"]');
                        }else{
                            var el = $(document).find('[name="'+i+'"]');
                        }
                        el.after($('<small style="color: red; font-weight: bold;">'+error[0]+'</small>'));
                    });
                }
            }
        });
    }

</script>
@endsection
