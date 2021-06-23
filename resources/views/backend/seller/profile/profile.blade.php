@extends('backend.layouts.master')
@section("title","Publisher Profile")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
{{--                    <h1>Profile</h1>--}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('publisher.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Update Profile</h3>
                        <div class="float-right">
{{--                            <a href="{{route('admin.publisher.index')}}">--}}
{{--                                <button class="btn btn-success">--}}
{{--                                    <i class="fa fa-backward"> </i>--}}
{{--                                    Back--}}
{{--                                </button>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('publisher.profile.update',$userInfo->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$userInfo->name}}" name="name" class="form-control" id="inputName" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="number" value="{{$userInfo->phone}}" name="phone" class="form-control" id="inputPhone" {{$userInfo->phone ? 'readonly' : ''}}>
                                </div>
                            </div>
                             <div class="form-group">
                                 <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                 <div class="col-sm-10">
                                     <input type="email" value="{{$userInfo->email}}" name="email" class="form-control" id="inputEmail" >
                                 </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

{{--                        <form  role="form" action="{{route('publisher.profile.update',$userInfo->id)}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            @method('PUT')--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>--}}
{{--                                    <div class="col-sm-10">--}}
{{--                                        <input type="text" value="{{$userInfo->name}}" name="name" class="form-control" id="inputName" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>--}}
{{--                                    <div class="col-sm-10">--}}
{{--                                        <input type="number" value="{{$userInfo->phone}}" name="phone" class="form-control" id="inputPhone" {{$userInfo->phone ? 'readonly' : ''}}>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>--}}
{{--                                    <div class="col-sm-10">--}}
{{--                                        <input type="email" value="{{$userInfo->email}}" name="email" class="form-control" id="inputEmail" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group row">--}}
{{--                                    <div class="offset-sm-2 col-sm-10">--}}
{{--                                        <button type="submit" class="btn btn-danger">Update</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}



@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
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
            $.post('{{ route('publisher.payment.cash_on_delivery_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
            $.post('{{ route('publisher.payment.bank_payment_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Payment Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
    <script>
        $("#trade_licence_images").spartanMultiImagePicker({
            fieldName: 'trade_licence_images[]',
            maxCount: 10,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '1600000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 1.5Mb');
            },
            onAddRow:function(index){
                var altData = '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    </script>
@endpush
