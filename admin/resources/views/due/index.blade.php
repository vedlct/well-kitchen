@extends('layouts.main')

@section('header.css')
    <link rel="stylesheet" type="text/css"
          href="{{url('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
                <!-- unit datatable began -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Due</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            {{-- <li><a href="{{ route('unit.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li> --}}
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="dueTable"
                                                   class="table table-striped table-bordered nowrap">
                                            </table>
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
    <div class="modal" tabindex="-1" id="payment" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add payment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" id="orderId" name="orderId">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="deliveryFee">Payment amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" value="" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="deliveryFee">Date:</label>
                                <input type="date" name="date" id="date" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="paymentSubmit()"  class="btn btn-primary">Submit</button>
              <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!--/ Zero configuration table -->
@endsection
@section('footer.js')
    <script src="{{url('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{url('public/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#dueTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('due.list') }}",
                columns: [
                    {
                        title: 'orderId', data: 'orderId', name: 'orderId', className: "text-center", orderable: true, searchable: true
                    },
                    {
                        title: 'customer Name', data: 'firstName', name: 'user.firstName', className: "text-center", orderable: true, searchable: true,
                    },
                    {
                        title: 'orderTotal', data: 'orderTotal', name: 'customer.customerId', className: "text-center", orderable: true, searchable: true
                    },
                    {
                        title: 'Due', data: 'due', name: 'due', className: "text-center", orderable: false, searchable: false
                    },
                    {
                        title: 'Action', name: 'action', className: "text-center", orderable: false, searchable: false,
                        data:(data)=>{
                            return `<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="addPayment(${data.orderId})" title="Make payment"><i class="ft-plus"></i></a>`
                        }
                    }
                ]
            });
        });

        function addPayment(data) {
            console.log(data);
            $('#orderId').val(data)
            $('#payment').modal('toggle')
        }

        function paymentSubmit(){
            let form = new FormData($('#paymentForm')[0])
            form.append('payment_type','due')
            $.ajax({
            url: "{{ route('transaction.save.payment') }}",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function (data) {
                toastr.success(`${data.message}`)
                $('#paymentForm').trigger('reset')
                $('#payment').modal('toggle')
                $('#dueTable').DataTable().draw()
            }
        });
        }
    </script>
@endsection
