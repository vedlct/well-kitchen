@extends('layouts.main')
@section('header.css')
<link rel="stylesheet" type="text/css"
{{--          href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">--}}
    <link href="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('public/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
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
                                <h4 class="card-title">Promotion Product List</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{ route('hotdeals.add') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table table-responsive">
                                        <div class="table table-responsive">
                                            <table  class="table table-striped table-bordered nowrap showDealProduct" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Promotions ProductID</th>
                                                    <th class="text-center">Promotions Name</th>
                                                    <th class="text-center">Product Name</th>
                                                    {{-- <th class="text-center">Quantity</th> --}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($promoProduct as $promoProducts)
                                                    <tr>
                                                        <td class="text-center">{{$promoProducts->promotion_productID}}</td>
                                                        <td class="text-center">{{$promoProducts->fkpromotionsId}}</td>
                                                        @if (!empty($promoProducts->product))
                                                         <td class="text-center">{{$promoProducts->product->productName}}</td>
                                                         @else
                                                         <td class="text-center">No Product with this promotion</td>
                                                        @endif
                                                        
                                                        {{-- <td class="text-center">{{$promoProducts->quantity ?? '0'}}</td> --}}
                                                    </tr>
                                                @endforeach
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


<script src="{{url('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        
    </script>
@endsection