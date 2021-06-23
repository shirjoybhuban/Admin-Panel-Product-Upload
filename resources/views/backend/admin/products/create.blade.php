@extends('backend.layouts.master')
@section("title","Add Products")
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
                    <h1>Add Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form role="form" id="choice_form" action="{{route('admin.products.store')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="added_by" value="admin">
        <section class="content">
            <div class="row m-2">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Information</p>
                        <div class="card-body">
                            <div class="form-group ">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control " name="name" id="name" placeholder="Enter Name"
                                       onchange="update_sku()" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (SEO Url) <small class="text-danger">(requried* and
                                        unique)</small></label>
                                <input type="text" id="slug" name="slug" class="form-control"
                                       placeholder="Slug (e.g. this-is-test-product-title)">
                            </div>
                            <div class="form-group ">
                                <label for="name">Case</label>
                                <input type="text" class="form-control" name="case" id="name" placeholder="Case" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Display</label>
                                <input type="text" id="slug" name="display" class="form-control"
                                       placeholder="Display">
                            </div>
                            <div class="form-group">
                                <label for="slug">GPS</label>
                                <input type="text" id="slug" name="gps" class="form-control"
                                       placeholder="gps">
                            </div>
                            <div class="form-group">
                                <label for="slug">Oxygen</label>
                                <input type="text" id="slug" name="oxygen" class="form-control"
                                       placeholder="oxygen">
                            </div>
                            <div class="form-group">
                                <label for="slug">Ecg</label>
                                <input type="text" id="slug" name="ecg" class="form-control"
                                       placeholder="ecg">
                            </div>
                            
                            <div class="form-group">
                                <label for="slug">Water Resistance</label>
                                <input type="text" id="slug" name="water" class="form-control"
                                       placeholder="water">
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Image Gallery</p>
                        
                        <div class="form-group">
                            <label class="control-label ml-3">Thumbnail Images </label>
                            <div class="ml-3 mr-3">
                                <div class="row" id="thumbnail_img"></div>
                                <div class="row" id="thumbnail_img_alt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Price</p>
                        <div class="card-body pt-0 mt-1">
                            <div class="row">
                                <div class="col-md-12" style="border-right: 1px solid #ddd;">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="unit_price">Unit price</label>
                                            <input type="number" min="0" value="0" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product & SEO Descriptions</p>
                        <div class="card-body pt-0 mt-1">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                    <div class="form-group">
                                        <label for="description">Specification</label>
                                        <textarea name="description" id="description"  class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="5"  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sku_combination" id="sku_combination">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-success" type="submit">Save</button>
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
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>

        $(document).ready(function () {
            get_subcategories_by_category();
            //title to slug make
            $("#name").keyup(function () {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{URL('/admin/products/slug')}}/" + name,
                    method: "get",
                    success: function (data) {
                        //console.log(data.response)
                        $('#slug').val(data.response);
                    }
                });
            })
            $("#photos").spartanMultiImagePicker({
                fieldName: 'photos[]',
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
                    alert('Image size too big. Please upload below 150kb');
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

            $("#thumbnail_img").spartanMultiImagePicker({
                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '300000',
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
            $("#readMore_img").spartanMultiImagePicker({
                fieldName: 'readMore_img[]',
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
                    alert('Image size too big. Please upload below 150kb');
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


            //CKEDITOR.replace( 'description' );
            CKEDITOR.replace( 'description');

        });


        $('.demo-select2').select2();

        function get_subcategories_by_category() {
            var category_id = $('#category_id').val();
            //console.log(category_id)
            $.post('{{ route('admin.products.get_subcategories_by_category') }}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                $('#subcategory_id').html(null);
                //console.log(data)
                for (var i = 0; i < data.length; i++) {
                    $('#subcategory_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
                get_subsubcategories_by_subcategory();
            });
        }

        function get_subsubcategories_by_subcategory() {
            var subcategory_id = $('#subcategory_id').val();
            console.log(subcategory_id)
            $.post('{{ route('admin.products.get_subsubcategories_by_subcategory') }}', {
                _token: '{{ csrf_token() }}',
                subcategory_id: subcategory_id
            }, function (data) {
                //console.log(data)
                $('#subsubcategory_id').html(null);
                $('#subsubcategory_id').append($('<option>', {
                    value: null,
                    text: null
                }));
                for (var i = 0; i < data.length; i++) {
                    $('#subsubcategory_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $('.demo-select2').select2();
                $('.color-var-select').select2();

            });
        }

        $('#category_id').on('change', function () {
            get_subcategories_by_category();
        });
        $('#subcategory_id').on('change', function () {
            get_subsubcategories_by_subcategory();
        });

        //colors
        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
            } else {
                $('#colors').prop('disabled', false);
            }
            update_sku();
        });

        $('#colors').on('change', function () {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function () {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('admin.products.sku_combination') }}',
                data: $('#choice_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        //attribute choose
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
            update_sku();
        });
        CKEDITOR.replace( 'description2' );
    
    
    </script>
@endpush
