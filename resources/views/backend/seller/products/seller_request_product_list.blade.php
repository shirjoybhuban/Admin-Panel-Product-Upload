@extends('backend.layouts.master')
@section("title","Seller Request Product List ")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Seller Request Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Seller Request Product List</li>
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
                        <h3 class="card-title float-left">Seller Request Product List</h3>
                        <div class="float-right">
                            <a href="{{route('admin.products.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Total Stock</th>
                                <th>Base Price</th>
                                <th>Today's Deal</th>
                                <th>Published</th>
                                <th>Featured</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <img src="{{url($product->thumbnail_img)}}" width="32" height="32" alt="">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->current_stock}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>
                                        <div class="form-group col-md-2">
                                            <label class="switch" style="margin-top:40px;">
                                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" {{$product->todays_deal == 1? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-2">
                                            <label class="switch" style="margin-top:40px;">
                                                <input onchange="update_published(this)" value="{{ $product->id }}" {{$product->published == 1 ? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-2">
                                            <label class="switch" style="margin-top:40px;">
                                                <input onchange="update_featured(this)"  value="{{ $product->id }}" {{$product->featured == 1 ? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    {{--<td>
                                        <div class="dropdown">
                                           --}}{{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>--}}{{--
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="bg-info dropdown-item" href="{{route('admin.products.edit',$product->id)}}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                --}}{{--<button class="bg-danger dropdown-item" type="button"
                                                        onclick="deleteProduct({{$product->id}})">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>--}}{{--
                                                <form id="delete-form-{{$product->id}}" action="{{route('admin.products.destroy',$product->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Total Stock</th>
                                <th>Base Price</th>
                                <th>Today's Deal</th>
                                <th>Published</th>
                                <th>Featured</th>
                                {{--<th>Action</th>--}}
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
        function deleteProduct(id) {
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
        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Todays Deal updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        //product published
        function update_published(el){
            if(el.checked){
                //alert('if')
                var status = 1;
            }
            else{
                //alert('else')
                var status = 0;
            }
            $.post('{{ route('admin.products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Published products updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        //product featured product
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Featured products updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
