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
                    <h1>Edit Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form role="form" id="choice_form" action="{{route('admin.products.update2',$product->id)}}" method="post"
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
                            <div class="form-group ">
                                <label for="name">Product Alternative Name</label>
                                <input type="text" class="form-control" name="alternative_name" id="name" placeholder="Enter Alternative Name" value="{{$product->alternative_name}}"  required>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (SEO Url) <small class="text-danger">(requried* and
                                                                                            unique)</small></label>
                                <input type="text" id="slug" name="slug" class="form-control"
                                       placeholder="Slug (e.g. this-is-test-product-title)" value="{{$product->slug}}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id[]" id="category_id" class="form-control demo-select2" required multiple>
                                    @foreach($categories as $category)

                                        <option value="{{$category->id}}" {{in_array($category->id,$product_category) ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_id"> Estimated Release Date </label>
                                <input type="date"  placeholder="Date" name="release_date" value="{{$product->release_date}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="brand">Publisher</label>
                                <select name="publisher_id" id="author_id" class="form-control demo-select2" required>
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher->id}}" {{$product->publisher_id == $publisher->id ? 'selected' : ''}}>{{$publisher->name}}</option>
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
                            <label class="control-label ml-3">Gallery Images<small class="text-danger">(Size: 600 *
                                                                                                       695)</small></label>
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
                        {{-- <div class="form-group ml-3 mr-3">
                            <label for="video_link">Video Url</label>
                            <input type="url" class="form-control " name="video_link" id="video_link"
                                   placeholder="Enter youtube video link" value="{{$product->video_link}}">
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row m-2">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Product Inventory</p>
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
                                        <div class="form-group col-md-5">
                                            <label for="discount">Discount</label>
                                            <input type="number" min="0" value="{{$product->discount}}" step="0.01" placeholder="Discount"
                                                   name="discount" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="discount">Discount Type</label>
                                            <select class="form-control " name="discount_type" tabindex="-1"
                                                    aria-hidden="true">
                                                <option value="flat" {{$product->discount_type == 'amount' ? 'selected' : ''}}>Flat</option>
                                                <option value="percent" {{$product->discount_type == 'percent' ? 'selected' : ''}}>Percent</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="translator">Translator</label>
                                            <input type="text"  placeholder="Translator" name="translator" value="{{$product->translator}}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="unit_price">ISBN</label>
                                            <input type="text"  placeholder="ISBN" name="isbn" value="{{$product->isbn}}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="discount">Books Total Page</label>
                                            <input type="text"  placeholder="Total Page" name="page_no" value="{{$product->page_no}}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="discount">Edition</label>
                                            <input type="text"  placeholder="Edition" name="edition" value="{{$product->edition}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                                <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                    <div class="form-group">
                                        <label for="description">Specification</label>
                                        <textarea name="description" id="description"  class="form-control">{{$product->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                    <div class="form-group">
                                        <label for="description"> Summary</label>
                                        <textarea name="summery" id="description2"  class="form-control"> {!!  $product->summery !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
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


        $(document).ready(function () {

            $('.demo-select2').select2();
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

                },
                onRemoveRow : function(index){

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

                },
                onRemoveRow : function(index){

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


                },
                onRemoveRow : function(index){

                },
            });
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });

            //CKEDITOR.replace( 'description' );
            CKEDITOR.replace( 'description', {
                filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });


        });

        CKEDITOR.replace( 'description2' );



        $('.demo-select2').select2();




    </script>
@endpush
