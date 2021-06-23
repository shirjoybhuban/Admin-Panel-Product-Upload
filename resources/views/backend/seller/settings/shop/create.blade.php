@extends('backend.seller.layouts.master')
@section("title","Shop Settings")
@push('css')
    <style>
        .bk-autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            left: 0;
            right: 0;
            z-index: 10001;
            padding: 1px!important; ;
            margin-top: -8px;
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 0 0 5px 5px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shop Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Shop Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <form role="form" id="choice_form" action="{{route('seller.shop.store')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="added_by" value="seller">
        <section class="content">
            <div class="row m-2">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Shop Settings</p>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Shop Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $shop_set->name }}" id="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (SEO Url)</label>
                                <input type="text" id="slug" name="slug" class="form-control" value="{{$shop_set->slug}}"
                                       placeholder="Slug (e.g. this-is-test-shop-title)" readonly>
                            </div>

                            <div class="form-group">
                                <label for="bksearch">Shop Address</label>
                                <div class="form-group form-group--style-1">
                                    <input type="text" class="form-control bksearch {{ $errors->has('bksearch') ? ' is-invalid' : '' }}" value="{{ $shop_set->address }}" placeholder="Enter Your Shop Address" name="bksearch" readonly>
                                </div>
                                <div class="bklist"></div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="address" value="{{$shop_set->address}}">
                                <input type="hidden" name="city" value="{{$shop_set->city}}">
                                <input type="hidden" name="area" value="{{$shop_set->area}}">
                                <input type="hidden" name="latitude" value="{{$shop_set->latitude}}">
                                <input type="hidden" name="longitude" value="{{$shop_set->longitude}}">
                            </div>
                            <div class="form-group">
                                <label for="about">About Shop </label>
                                <textarea name="about" id="about" rows="5"  class="form-control">{{ $shop_set->about }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook Url</label>
                                <input type="url" class="form-control" name="facebook" id="facebook"
                                       value="{{ $shop_set->facebook }}">
                            </div>
                            <div class="form-group">
                                <label for="google">Google Url</label>
                                <input type="url" class="form-control" name="google" id="google"
                                       value="{{ $shop_set->google }}">
                            </div>
                            <div class="form-group">
                                <label for="twitter">Twitter Url</label>
                                <input type="url" class="form-control" name="twitter" id="twitter"
                                       value="{{ $shop_set->twitter }}">
                            </div>
                            <div class="form-group">
                                <label for="youtube">YouTube Url</label>
                                <input type="url" class="form-control" name="youtube" id="youtube"
                                      value="{{ $shop_set->youtube }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="form-group pl-3 pr-3">
                            <label for="meta_title">Meta Title </label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $shop_set->meta_title }}" placeholder="Meta Title">
                        </div>
                        <div class="form-group pl-3 pr-3">
                            <label for="meta_description">Meta Description </label>
                            <textarea name="meta_description" id="meta_description" rows="4"  class="form-control">{{ $shop_set->meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label ml-3">Logo <small class="text-danger">(Size: 120 *
                                    120px)</small></label>
                            <div class="ml-3 mr-3">
                                <div class="row" id="logo">
                                    @if ($shop_set->logo != null)
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="img-upload-preview" style="width: 160px; height: 200px">
                                                <img loading="lazy"  src="{{ url($shop_set->logo) }}" alt="" class="img-responsive" width="150">
                                                <input type="hidden" name="previous_logo" value="{{ $shop_set->logo }}">
                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-success" type="submit">Save</button>
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
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>
    <script>
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row"><div class="col-lg-2 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{'Enter choice values' }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $("#name").keyup(function () {
            var name = $("#name").val();
            console.log(name);
            $.ajax({
                url: "{{URL('/seller/products/slug')}}/" + name,
                method: "get",
                success: function (data) {
                    //console.log(data.response)
                    $('#slug').val(data.response);
                }
            });
        })

        $("#sliders").spartanMultiImagePicker({
                fieldName: 'sliders[]',
                maxCount: 10,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '150000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('File size too big');
                },
                // onAddRow:function(index){
                //     var altData = '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                //     //var index = index + 1;
                //     //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //     //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                // },
                onRemoveRow : function(index){
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },

        });
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '1000000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },
            onAddRow:function(index){
                var altData = '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });

        Bkoi.onSelect(function () {
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(selectedPlace)
            // center of the map
            document.getElementsByName("address")[0].value = selectedPlace.address;
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;

        })
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    </script>
@endpush
