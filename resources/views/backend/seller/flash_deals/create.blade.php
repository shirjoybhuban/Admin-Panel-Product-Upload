@extends('backend.seller.layouts.master')
@section("title","Flash Deals")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
    <style>
        .input-group-addon {
            padding: 6px 2px;
            font-size: 20px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
        }
        .input-daterange .input-group-addon {
            width: auto;
            min-width: 21px;
            padding: 4px 19px;
            line-height: 1.42857143;
            border-width: 1px 0;
            margin-left: -5px;
            margin-right: -5px;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Flash Deals</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Flash Deals</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form role="form" id="choice_form" action="{{route('seller.flash_deals.store')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <section class="content">
            <div class="row m-2">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Flash Deals Info</p>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control " name="title" id="name" placeholder="Enter Flash sales title"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="demo-dp-range">
                                        <label for="name">Select Date Range</label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control" name="start_date" autocomplete="off" required>
                                            <span class="input-group-addon">To</span>
                                            <input type="text" class="form-control" name="end_date" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-sm-12">
                                    <label class="control-label" for="products">Products</label>
                                    <div class="">
                                        <select name="products[]" id="products" class="form-control demo-select2" multiple required data-placeholder="Choose Products">
                                            @foreach(\App\Model\Product::where('added_by','seller')->where('user_id',Auth::id())->get() as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="form-group" id="discount_table">

                            </div>
                            <div>
                                <button class="btn btn-success float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@stop
@push('js')
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $('.demo-select2').select2();
        $("#demo-dp-range .input-daterange").datepicker({
            startDate: "-0d",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
        });
        $(document).ready(function(){
            $('#products').on('change', function(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('seller.flash_deals.product_discount') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids}, function(data){
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            });
        });

    </script>
@endpush
