@extends('backend.seller.layouts.master')
@section("title","Completed Order")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Completed Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Completed Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Completed Orders</h3>
                        <div class="float-right">
                            {{--<a href="{{route('admin.p.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Date</th>
                                <th>Invoice ID</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Discount</th>
                                <th>Total Vat</th>
                                <th title="Delivery Status">D.Status</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Completed as $key => $Complete)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{date('j-m-Y',strtotime($Complete->created_at))}}</td>
                                    <td>{{$Complete->invoice_code}}</td>
                                    <td>{{$Complete->payment_type}}</td>
                                    <td>{{$Complete->grand_total }}</td>
                                    <td>{{$Complete->discount }}</td>
                                    <td>{{$Complete->total_vat }}</td>
                                    <td>
                                        <span class="badge badge-success">{{$Complete->delivery_status}}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('seller.order-details',encrypt($Complete->id))}}">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#ID</th>
                                <th>Date</th>
                                <th>Invoice ID</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Discount</th>
                                <th>Total Vat</th>
                                <th title="Delivery Status">D.Status</th>
                                <th>Details</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
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
    </script>
@endpush
