@extends('backend.seller.layouts.master')
@section("title","Customer Reviews")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 0px 6px!important;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Reviews</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Reviews</li>
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
                        <h3 class="card-title float-left">Customer Reviews</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Rating</th>
                                <th>Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $key => $review)
                                <tr>
                                    <td>
                                        {{$key + 1}}
                                        @if($review->viewed == 0)
                                            <span class="badge badge-danger">New</span>
                                        @endif
                                    </td>
                                    <td>{{$review->user->name}}</td>
                                    <td>{{$review->product->name}}</td>
                                    <td>{{$review->rating}}</td>
                                    <td>{{$review->comment}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Rating</th>
                                <th>Comment</th>
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
    </script>
@endpush
