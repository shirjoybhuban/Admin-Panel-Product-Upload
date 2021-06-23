@extends('backend.layouts.master')
@section("title","Edit Products")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
    <style>
        .select2-container--default .color-preview {
            height: 12px;
            width: 12px;
            display: inline-block;
            margin-right: 5px;
            margin-top: 2px;
        }
    </style>
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
                        <li class="breadcrumb-item"><a href="{{route('publisher.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form role="form" id="choice_form" action="{{route('publisher.products.update2',$product->id)}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
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
                                       onchange="update_sku()" value="{{$product->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (SEO Url) <small class="text-danger">(requried* and
                                        unique)</small></label>
                                <input type="text" id="slug" name="slug" class="form-control"
                                       placeholder="Slug (e.g. this-is-test-product-title)" value="{{$product->slug}}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control demo-select2" required>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand">Publisher</label>
                                <select name="author_id" id="author_id" class="form-control demo-select2" required>
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher->id}}" {{$product->author_id == $publisher->id ? 'selected' : ''}}>{{$publisher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand">Author</label>
                                <select name="author_id" id="author_id" class="form-control demo-select2" required>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" {{$product->author_id == $author->id ? 'selected' : ''}}>{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Language</label>
                                <select name="language_id" id="language_id" class="form-control demo-select2" required>
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}" {{$product->language_id == $language->id ? 'selected' : ''}}>{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Image Gallery</p>
                        <div class="form-group">
                            <label class="control-label ml-3">Gallery Images</label>
                            <div class="ml-3 mr-3">
                                <div class="row" id="photos">
                                    @if(is_array(json_decode($product->photos)))
                                        @foreach (json_decode($product->photos) as $key => $photo)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <img loading="lazy"  src="{{url($photo)}}" alt="" class="img-responsive">
                                                    <input type="hidden" name="previous_photos[]" value="{{$photo}}">
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row" id="photos_alt"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ml-3">Thumbnail Images <small class="text-danger">(Size: 290 *
                                    300px)</small></label>
                            <div class="ml-3 mr-3">
                                <div class="row" id="thumbnail_img">
                                    @if ($product->thumbnail_img != null)
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="img-upload-preview">
                                                <img loading="lazy"  src="{{ url($product->thumbnail_img) }}" alt="" class="img-responsive">
                                                <input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row" id="thumbnail_img_alt"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label ml-3">Read Book Images</label>
                            <div class="ml-3 mr-3">
                                <div class="row" id="readMore_img">
                                    @if(is_array(json_decode($product->readmorephotos)))
                                        @foreach (json_decode($product->readmorephotos) as $key => $photo)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <img loading="lazy"  src="{{url($photo)}}" alt="" class="img-responsive">
                                                    <input type="hidden" name="previous_readmore_photos[]" value="{{$photo}}">
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row" id="photos_alt"></div>
                            </div>
                        </div>
{{--                        <div class="form-group ml-3 mr-3">--}}
{{--                            <label for="video_link">Video Url</label>--}}
{{--                            <input type="url" class="form-control " name="video_link" id="video_link"--}}
{{--                                   placeholder="Enter youtube video link" value="{{$product->video_link}}">--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Inventory And Variation</p>
                        <div class="card-body pt-0 mt-1">
                            <div class="row">
                                <div class="col-md-12" style="border-right: 1px solid #ddd;">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="unit_price">Unit price</label>
                                            <input type="number" min="0" value="{{$product->unit_price}}" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="purchase_price">Purchase price</label>
                                            <input type="number" min="0" value="{{$product->purchase_price}}" step="0.01"
                                                   placeholder="Purchase price" name="purchase_price"
                                                   class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="unit_price">Quantity</label>
                                            <label for="current_stock">Stock</label>
                                            <input type="number" min="0" value="{{$product->current_stock}}" step="1" placeholder="Quantity" name="current_stock" class="form-control" required="">
                                        </div>
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="unit_price">Quantity</label>--}}
{{--                                            <label for="current_stock">Stock</label>--}}
{{--                                            <select name="current_stock" id="current_stock" class="form-control {{$product->current_stock == 0 ? 'bg-danger' : 'bg-success'}}">--}}
{{--                                                <option value="1" {{$product->current_stock > 0 ? 'selected' : ''}} class="bg-success">Available</option>--}}
{{--                                                <option value="0" {{$product->current_stock == 0 ? 'selected' : ''}} class="bg-danger">Not Available</option>--}}
{{--                                            </select>--}}
{{--                                            --}}{{--<input type="number" min="0" value="{{$product->current_stock}}" step="1" placeholder="Quantity" name="current_stock" class="form-control" required="">--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-5">
                                            <label for="discount">Discount</label>
                                            <input type="number" min="0" value="{{$product->discount}}" step="0.01" placeholder="Discount"
                                                   name="discount" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="discount">Discount Type</label>
                                            <select class="form-control " name="discount_type" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="amount" {{$product->discount_type == 'amount' ? 'selected' : ''}}>Flat</option>
                                                <option value="percent" {{$product->discount_type == 'percent' ? 'selected' : ''}}>Percent</option>
                                            </select>
                                        </div>
{{--                                        <div class="form-group col-md-3">--}}
{{--                                            <label for="vat">VAT</label>--}}
{{--                                            <input type="number" min="0" value="{{$product->vat}}" step="0.01" placeholder="VAT"--}}
{{--                                                   name="vat" class="form-control" required="">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-5">--}}
{{--                                            <label for="discount">VAT Type</label>--}}
{{--                                            <select class="form-control " name="vat_type" tabindex="-1"--}}
{{--                                                    aria-hidden="true">--}}
{{--                                                <option value="amount" {{$product->vat_type == 'amount' ? 'selected' : ''}}>Flat</option>--}}
{{--                                                <option value="percent" {{$product->vat_type == 'percent' ? 'selected' : ''}}>Percent</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="vat">Labour cost</label>--}}
{{--                                            <input type="number" min="0" value="{{$product->labour_cost}}" step="0.01" placeholder="Labour cost"--}}
{{--                                                   name="labour_cost" class="form-control" required="">--}}
{{--                                        </div>--}}
                                    </div>
                                </div>

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-md-10">--}}
{{--                                            <label for="colors">Colors</label>--}}
{{--                                            @php--}}
{{--                                              $colors =  \App\Model\Color::orderBy('name', 'asc')->get();--}}
{{--                                                $pColors = json_decode($product->colors);--}}
{{--                                                $pColorArr = [];--}}
{{--                                                foreach ($pColors as $pColor){--}}
{{--                                                    $data = $pColor->code;--}}
{{--                                                    array_push($pColorArr, $data);--}}
{{--                                                }--}}
{{--                                            @endphp--}}
{{--                                           --}}{{-- {{dd($pColorArr)}}--}}
{{--                                            <select class="form-control color-var-select" name="colors[]" id="colors" multiple>--}}
{{--                                                @foreach ($colors as $key => $color)--}}
{{--                                                    <option value="{{ $color->code }}" <?php if(in_array($color->code, $pColorArr)) echo 'selected'?> >{{ $color->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <label class="switch" style="margin-top:40px;">--}}
{{--                                                <input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >--}}
{{--                                                <span class="slider round"></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="form-group col-md-12">--}}
{{--                                            <label for="attribute">Attribute</label>--}}
{{--                                            <select name="choice_attributes[]" id="choice_attributes"--}}
{{--                                                    class="form-control demo-select2" multiple--}}
{{--                                                    data-placeholder="Choose Attributes">--}}
{{--                                                @foreach (\App\Model\Attribute::all() as $key => $attribute)--}}
{{--                                                    <option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <hr>
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="customer_choice_options" id="customer_choice_options">--}}
{{--                                        @foreach (json_decode($product->choice_options) as $key => $choice_option)--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <div class="col-lg-2">--}}
{{--                                                    <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">--}}
{{--                                                    <input type="text" class="form-control" name="choice[]" value="{{ \App\Model\Attribute::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-9">--}}
{{--                                                    <input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-lg-1">--}}
{{--                                                    <button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sku_combination" id="sku_combination">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product & SEO Descriptions</p>
                        <div class="card-body pt-0 mt-1">
                            <div class="row">
                                <div class="col-md-12" style="border-right: 1px solid #ddd;">
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea name="description" id="description"  class="form-control">{{$product->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$product->meta_title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="5"  class="form-control">{{$product->meta_description}}</textarea>
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
        </section>
    </form>
@stop
@push('js')
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row"><div class="col-lg-2 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{'Enter choice values' }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $('input[name="colors_active"]').on('change', function() {
            if(!$('input[name="colors_active"]').is(':checked')){
                $('#colors').prop('disabled', true);
            }
            else{
                $('#colors').prop('disabled', false);
            }
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });
        function delete_row(em){
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
                url: '{{ route('publisher.products.sku_combination_edit') }}',
                data:$('#choice_form').serialize(),
                success: function(data){
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    }
                    else {
                        $('#quantity').show();
                    }
                }
            });
        }


        function get_subcategories_by_category() {
            var category_id = $('#category_id').val();
            //console.log(category_id)
            $.post('{{ route('publisher.products.get_subcategories_by_category') }}', {
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
                }
                $("#subcategory_id > option").each(function() {
                    if(this.value == '{{$product->subcategory_id}}'){
                        $("#subcategory_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_subsubcategories_by_subcategory();
            });
        }

        function get_subsubcategories_by_subcategory() {
            var subcategory_id = $('#subcategory_id').val();
            console.log(subcategory_id)
            $.post('{{ route('publisher.products.get_subsubcategories_by_subcategory') }}', {
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
                $("#subsubcategory_id > option").each(function() {
                    if(this.value == '{{$product->subsubcategory_id}}'){
                        $("#subsubcategory_id").val(this.value).change();
                    }
                });
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

        $(document).ready(function () {
            update_sku();
            get_subcategories_by_category();
            //title to slug make
            $("#name").keyup(function () {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{URL('/publisher/products/slug')}}/" + name,
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
                maxFileSize: '100000',
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

            $(".color-var-select").select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                },
            });
            //CKEDITOR.replace( 'description' );
            CKEDITOR.replace( 'description', {
                filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });

        });

        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function () {
            update_sku();
        });

        $('#choice_attributes').on('change', function() {
            //$('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if($(attribute).val() == $(choice_no).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var str = @php echo $product->attributes @endphp;

            $.each(str, function(index, value){
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute){
                    if(value == $(attribute).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    //console.log();
                    $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
                }
            });

            update_sku();
        });

        function colorCodeSelect(state) {
            var colorCode = $(state.element).val();
            if (!colorCode) return state.text;
            return (
                "<span class='color-preview' style='background-color:" +
                colorCode +
                ";'></span>" +
                state.text
            );
        }


    </script>
@endpush
