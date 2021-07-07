@extends('layouts.main')
@section('header.css')
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/css/plugins/pickers/daterange/daterange.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <style>
        html body .content .content-wrapper {
            padding: 5px 20px 5px 20px;
        }
        .table th {
            padding-right: 8px;
            padding-left: 8px;
        }
        .table td {
            padding-right: 8px;
            padding-left: 8px;
        }
    </style>
@endsection
@section('main.content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- main content start -->
            <div class="content-body" >
              <section>
                <div class="row">
                  <div class="col-md-8 mb-1">
                    <div class="card">
                      <div class="card-content">
                          <div class="card-body order-details-card">
                            <!-- top row -->
                            <div class="row align-items-center mb-3">
                              <div class="col-sm-5 mb-1">
                                <h4 class="card-title order-details-heading mb-0">Order #{{$order->orderId}} details</h4>
                              </div>
                              <div class="col-sm-4 mb-1">
                                <button class="btn btn-primary btn-min-width" onclick="orderStatus({{$order->orderId}})">Change Status</button>
                              </div>
                              <div class="col-sm-3 mb-1 text-sm-right">
                                <a href="{{route('order.download',$order->orderId)}}" class="btn btn-info btn-min-width">Invoice</a>
                              </div>
                            </div>
                            <!-- change status modal -->
                            <div id="statusModal"></div>
                            <div id="paymentModal"></div>
                            <div id="returnModal"></div>
                            <!-- order info -->
                            <div class="row">
                              <div class="col-md-4 mb-1">
                                <h5 class="mb-1"><b>General</b></h5>
                                <p class="details-text">
                                  <b>Customer:</b> {{$order->customer->user->firstName ?? "Not availble"}} <br>
                                  <b>Phone:</b> {{$order->customer->phone ?? "Not availble"}} <br>
                                  <b>Date created:</b> {{$order->created_at}} <br>
                                  <b>Date edited:</b> {{$order->updated_at}}  <br>
                                  <b>Date printed:</b> No <br>
                                  <b>Sale type:</b> {{$order->sale_type}} <br>
                                  {{-- <b>Problem category:</b> Reject <br>
                                  <b>Problem reason:</b> 766 --}}
                                </p>
                              </div>
                              <div class="col-md-4 mb-1">
                                <h5 class="mb-1"><b>Shipping</b></h5>
                                <p class="details-text">
                                  <b>Delivey Time:</b> {{$order->deliveryTime ?? "Not availble"}} <br>
                                  <b>Location:</b> {{$order->delivery->location ?? "Not availble"}} <br>
                                  <b>Delivery Service:</b> {{$order->delivery->companyName ?? "Not availble"}} <br>
                                  <b>Courier tracking number:</b> No <br>
                                  <b>Billing Address:</b> {{$order->customer->address->billingAddress ?? "Not available"}} <br>
                                  <b>Shipping Address:</b> {{$order->customer->address->shippingAddress ?? "Not available"}}
                                </p>
                              </div>
                              <div class="col-md-4 mb-1">
                                <h5 class="mb-1"><b>Note</b></h5>
                                <p class="details-text">{{$order->note ?? "Not available"}}</p>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- total table -->
                    @if(!empty($order->orderedProduct))
                        <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="product-detail-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Variation/Type</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Unit Cost</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Discount</th>
                                        @if(in_array($currentStatus = $order->orderStatusLogs->where('status','!=',NULL)->last()->status,['Delivered','Return','Complete']))
                                          <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->orderedProduct as $key => $item)
                                        <tr>
                                          {{-- @dd($item); --}}
                                            <td scope="row">{{++$key}}</td>
                                            <td>{{$item->sku->product->productName}}</td>
                                            <td>{{$item->sku->product->type}}</td>
                                            <td>{{$item->quiantity}}</td>
                                            <td>{{$item->batch_id}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->total}}</td>
                                            <td>{{$item->discount}}</td>
                                            @if(in_array($currentStatus,['Delivered','Return','Complete']))
                                                <td >
                                                    <a href="#" onclick="returnProduct({{$item->order_itemId}})" title="Return"><i class="ft ft-corner-down-left"></i></a>
                                                </td>
                                            @endif
                                        </tr>  
                                    @endforeach
                                    <tr>
                                      
                                        <td colspan="7" class="text-right"> <b>Total</b> </td>
                                        {{-- <td>{{$order->orderTotal}}</td> --}}
                                        <td>{{$order->orderedProduct->sum('total')}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right"> <b>Delivery Fee</b> </td>
                                        <td>{{$order->deliveryFee ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right"> <b>Order Total</b> </td>
                                        <td>{{$order->orderTotal}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    @endif
                    <!-- transaction card -->
                    <div class="card">
                      <div class="card-content">
                          <div class="card-body order-details-card">
                            <!-- top row -->
                            <div class="row align-items-center mb-3">
                              <div class="col-md-4 mb-1">
                                <h4 class="card-title order-details-heading mb-0">Transaction</h4>
                              </div>
                              <div class="col-md-4 mb-1">
                                {{-- <h4 class="text-warning">Due: {{($order->orderTotal+$order->deliveryFee) - $order->paidAmount()}}</h4> --}}
                                <h4 class="text-warning">Due: {{$order->orderTotal - $order->paidAmount()}}</h4>
                              </div>
                              <div class="col-md-4 mb-1 text-sm-right">
                                {{-- <button type="button" class="btn btn-danger btn-min-width">Refund</button> --}}
                                <button type="button" class="btn btn-success btn-min-width" onclick="addPayment({{$order->orderId}})">Add Payment</button>
                              </div>
                            </div>
                            <!-- transaction table -->
                            @if(!empty($order->transaction))
                                <div class="product-detail-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">comment</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($order->transaction as $key=>$item)
                                        <tr>
                                            <td scope="row">{{++$key}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->payment_type}}</td>
                                            <td>{{$item->method}}</td>
                                            <td>{{$item->comment ?? 'Not available'}}</td>
                                            <td>{{$item->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr colspan="7">
                                        <th class="border-0" >Total</th>
                                        <th class="border-0">{{floatval($order->transaction->sum('amount'))}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                </div>
                            @endif
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-1">
                    <div class="card" style="max-height: 342px; overflow-y: scroll">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-6">
                            <h4 class="card-title order-details-heading mb-0">Remarks</h4>
                          </div>
                          <div class="col-6">
                            <h4 class="card-title order-details-heading mb-0 text-right text-primary" id="mainStatus">Status: {{$order->lastStatus->status ?? "Not available"}}</h4>
                          </div>
                        </div>
                      </div>
                      <div class="card-content" >
                            <div class="card-body pt-0 pb-0">
                              @if(count($order->orderStatusLogs)>0)
                                @foreach($order->orderStatusLogs as $log)
                                  <h7 class="status text-success">Status - {{Str::ucfirst($log->status) ?? "Not available"}}</h7><br>
                                  <h7 class="name text-info">Added by - {{Str::ucfirst($log->author->firstName ?? "admin") }}</h7><br>
                                  <h7 >Remark - {{Str::ucfirst($log->note ??"None")}}</h7><br>
                                  <h7 class="time text-primary">Time - {{\Carbon\Carbon::parse($log->created_at)->format('l jS \\of F Y h:i:s A')}}</h7>
                                  <hr>
                                @endforeach
                              @endif
                            </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-6">
                            <h4 class="card-title order-details-heading mb-0">Remarks</h4>
                          </div>
                          <div class="col-6">
                            <h4 class="card-title order-details-heading mb-0 text-right text-primary" id="viewStatus">Status: {{$order->lastStatus->status ?? "Not available"}}</h4>
                          </div>
                        </div>
                      </div>
                      <div class="card-content" >
                            <div class="card-body pt-0 pb-1">
                              <form action="">
                                <fieldset class="form-group">
                                  <textarea class="form-control" id="placeTextarea" rows="3" placeholder="Write note..."></textarea>
                                </fieldset>
                                <div class="text-right">
                                  <button type="submit" class="btn btn-primary">Submit</button>
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
  function orderStatus(data){
            $.ajax({
                type: "POST",
                url: '{{route('order.orderStatus')}}',
                data:{
                    'id':data,
                    '_token':"{{csrf_token()}}",
                    },
                success: function (response) {
                    $('#statusModal').html(response)
                    $('#statusChangeModal').modal('toggle');
                }
            });
        }
  function addPayment(data){
    console.log(data);
    $.ajax({
          url: '{{ route('transaction.payment') }}',
          method: 'post',
          data: {
              '_token': '{{csrf_token()}}',
              'orderId': data,
          },
          success: function (data) {
            // console.log(data);
            $('#paymentModal').html(data);
            $('#payment-Modal').modal();
          }
        });
  }

  function returnProduct(orderItemId){
            $.ajax({
                url: '{{ route('order.returnModal') }}',
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'orderItemId': orderItemId
                },
                success: function (data) {
                    $('#returnModal').html(data);
                    $('#return-Modal').modal();
                }
            });
  }    

  
</script>
@endsection