@extends('backend.seller.layouts.master')
@section("title","Seller Info")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Seller Info</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Seller Info</li>
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
                        <h3 class="card-title float-left">Seller Info</h3>
                        <div class="float-right">
                            @if(empty($sellerInfo))
                            <a href="{{route('seller.seller-info.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>NID Number</th>
                                <th>Trade Licence Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$sellerInfo->user->name}}</td>
                                    <td>{{$sellerInfo->nid_number}}</td>
                                    <td>
                                        <div class="ml-3 mr-3">
                                            <div class="row" id="trade_licence_images">
                                                @if(is_array(json_decode($sellerInfo->trade_licence_images)))
                                                    @foreach (json_decode($sellerInfo->trade_licence_images) as $key => $photo)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"  src="{{url($photo)}}" alt="" class="img-responsive" width="100" height="100">
{{--                                                                <input type="hidden" name="previous_photos[]" value="{{url($photo)}}">--}}
{{--                                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>--}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            {{--                                    <div class="row" id="photos_alt"></div>--}}
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('seller.seller-info.edit',$sellerInfo->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>NID Number</th>
                                <th>Trade Licence Images</th>
                                <th>Action</th>
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

        //sweet alert
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
        //today's deals
        function update_is_home(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.categories.is_home') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Is Home updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
