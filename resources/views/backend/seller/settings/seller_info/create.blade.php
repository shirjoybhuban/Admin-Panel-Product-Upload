@extends('backend.seller.layouts.master')
@section("title","Add Seller Info")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Seller Info</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Seller Info</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 30px;">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Add Seller Info</h3>
                        <div class="float-right">
                            <a href="{{route('seller.seller-info.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('seller.seller-info.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nid_number">NID Number</label>
                                <input type="text" class="form-control" name="nid_number" id="nid_number" placeholder="Enter NID Number" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label ml-3">Trade Licence Images</label>
                                <div class="ml-3 mr-3">
                                    <div class="row" id="trade_licence_images"></div>
{{--                                    <div class="row" id="photos_alt"></div>--}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
{{--    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>--}}
{{--    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>--}}
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
    </script>

@endpush
