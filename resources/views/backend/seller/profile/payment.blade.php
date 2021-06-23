@extends('backend.seller.layouts.master')
@section("title","Payment Settings")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Payment Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <form role="form" id="choice_form" action="{{route('seller.payment.update')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="added_by" value="seller">
        <section class="content">
            <div class="row m-2">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Payment Settings</p>

                        <div class="card-body">
                            <div class="form-group">
                                <label class="col-form-label col-md-2">Cash Payment</label>
                                <label class="switch" style="margin-top:40px;">
                                    <input onchange="update_cash_on_delivery_status(this)" value="{{ $pay->id }}" {{$pay->cash_on_delivery_status == 1? 'checked':''}} type="checkbox" >
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-md-2">Bank Payment</label>
                                <label class="switch" style="margin-top:40px;">
                                    <input onchange="update_bank_payment_status(this)" value="{{ $pay->id }}" {{$pay->bank_payment_status == 1? 'checked':''}} type="checkbox" >
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{$pay->bank_name}}" placeholder="Bank Name" required>
                            </div>
                            <div class="form-group">
                                <label for="bank_acc_name">Bank Account Name</label>
                                <input type="text" class="form-control" name="bank_acc_name" id="bank_acc_name" value="{{$pay->bank_acc_name}}" placeholder="Bank Account Name" required>
                            </div>
                            <div class="form-group">
                                <label for="bank_acc_no">Bank Account Number</label>
                                <input type="text" class="form-control" name="bank_acc_no" id="bank_acc_no" value="{{$pay->bank_acc_no}}" placeholder="Bank Account Number" required>
                            </div>
                            <div class="float-center">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>
@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        //today's deals
        function update_cash_on_delivery_status(el){
            console.log(el);
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('seller.payment.cash_on_delivery_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                console.log(data);
                if(data == 1){
                    toastr.success('success', 'Payment Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        function update_bank_payment_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('seller.payment.bank_payment_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Payment Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }


    </script>

@endpush
