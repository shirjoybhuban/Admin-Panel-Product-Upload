<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Http\Controllers\Controller;


use App\Http\Helpers;
use App\Language;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Subcategory;
use App\Model\SubSubcategory;
use App\Model\Product;
use App\Model\ProductStock;
use App\Product_category;
use App\Publisher;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();

        return view('backend.admin.products.index', compact('products'));
    }


    public function ajaxSlugMake($name)
    {
        $data = Str::slug($name);
        return response()->json(['success'=> true, 'response'=>$data]);
    }


    public function create()
    {
        return view('backend.admin.products.create',);
    }
    public function sku_combination(Request $request)
    {


    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'thumbnail_img' => 'required',
            'unit_price' => 'required',
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->case_size = $request->case;
        $product->display = $request->display;
        $product->gps = $request->gps;
        $product->oxygen = $request->oxygen;
        $product->ecg = $request->ecg;
        $product->water_resistance = $request->water;
        $product->unit_price = $request->unit_price;
        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
        }else{
            $product->thumbnail_img="uploads/products/product_default_thumbnail.png";
        }

//        $product->meta_title = $request->meta_title;
//        $product->meta_description = $request->meta_description;
        $product->slug = $request->slug.'-'.Str::random(5);
        $product->save();

        Toastr::success("Product Inserted Successfully","Success");
        return redirect()->route('admin.products.index');


    }

    public function show($id)
    {
        //
    }

//    public function edit($id)
//    {
//
//        $categories = Category::all();
//        $authors = Author::all();
//        $publishers = Publisher::all();
//        $product = Product::find(decrypt($id));
//        $languages = Language::all();
//        //$tags = json_decode($product->tags);
//        $product_category=Product_category::where('product_id',decrypt($id))->pluck('category_id')->toArray();
//        //dd($product_category);
//        return view('backend.admin.products.edit',compact('authors', 'categories','publishers','product','languages','product_category'));
//    }
//
//
//    public function update(Request $request, $id){}
//    public function update2(Request $request, $id)
//    {
//        //dd($request->all());
//        $categories=$request->category_id;
//        $product = Product::find($id);
//        $product->name = $request->name;
//        $product->alternative_name = $request->alternative_name;
//        $product->category_id = $categories[0];
//        $product->release_date = $request->release_date;
//        $product->author_id = $request->author_id;
//        $product->publisher_id = $request->publisher_id;
//        $product->language_id = $request->language_id;
//        $product->translator = $request->translator;
//        $product->isbn = $request->isbn;
//        $product->page_no = $request->page_no;
//        $product->edition = $request->edition;
//        $product->current_stock = $request->current_stock;
//
//
//        if($request->has('previous_photos')){
//            $photos = $request->previous_photos;
//        }
//        else{
//            $photos = array();
//        }
//
//        if($request->hasFile('photos')){
//            foreach ($request->photos as $key => $photo) {
//                $path = $photo->store('uploads/products/photos');
//                array_push($photos, $path);
//            }
//        }
//        $product->photos = json_encode($photos);
//
//        if($request->has('previous_readmore_photos')){
//            $readphotos = $request->previous_readmore_photos;
//        }
//        else{
//            $readphotos = array();
//        }
//
//        if($request->hasFile('readMore_img')){
//            foreach ($request->readMore_img as $key => $photo) {
//                // $path = $photo->store('uploads/products/photos');
//                // $img = Image::make(public_path('uploads/products/photos'));
//                // $img->insert(public_path('frontend/images/logo/header_logo.png'), 'center', 10, 10);
//                // $img->save(public_path('uploads/products/photos'));
//                $currentDate = Carbon::now()->toDateString();
//                $Mainimg = $currentDate . '-' . uniqid() . '.' . $photo->getClientOriginalExtension();
//// resize image for category and upload
//                $MainImage = Image::make($photo)->resize(486, 686)->save($photo->getClientOriginalExtension());
//                $MainImage->insert(public_path('uploads/products/header_logo.png'), 'bottom-right', 8, 8);
//                Storage::disk('public')->put('uploads/products/readmore/' . $Mainimg, $MainImage);
//
//                array_push($readphotos, 'uploads/products/readmore/' . $Mainimg);
//                //ImageOptimizer::optimize(base_path('public/').$path);
//            }
//        }
//        $product->readmorephotos = json_encode($readphotos);
//
//        $product->thumbnail_img = $request->previous_thumbnail_img;
//        if($request->hasFile('thumbnail_img')){
//            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
//        }
//        $product->unit = $request->unit;
//        //$product->min_qty = $request->min_qty;
//        //$product->tags = implode('|',$request->tags);
//        $product->description = $request->description;
//        $product->summery = $request->summery;
//        //$product->video_provider = $request->video_provider;
//        $product->video_link = $request->video_link;
//        $product->unit_price = $request->unit_price;
//        $product->purchase_price = $request->purchase_price;
//        //$product->tax = $request->tax;
//        //$product->tax_type = $request->tax_type;
//        $product->discount = $request->discount;
//        $product->discount_type = $request->discount_type;
//        $product->meta_title = $request->meta_title;
//        $product->meta_description = $request->meta_description;
//        $product->slug = $request->slug;
//
//        if($request->discount_type == 'percent'){
//            $calculated_price = ($request->unit_price * $request->discount) / 100;
//            $dis_price=$request->unit_price-$calculated_price;}
//        else{
//            $dis_price=$request->unit_price-$request->discount;
//        }
//        $product->discount_price = $dis_price;
//
//        $product->update();
//
//        $delCat=Product_category::where('product_id',$product->id)->get();
//
//        foreach ($delCat as $cat){
//            $cat->delete();
//        }
//        foreach ($categories as $cat){
//            $category=new Product_category();
//            $category->product_id=$product->id;
//            $category->category_id=$cat;
//            $category->save();
//        }
//
//        Toastr::success("Product Updated Successfully","Success");
//        return redirect()->route('admin.products.index');
//
//    }
    public function destroy($id)
    {
        //
    }

    //today's deals update
    public function updateTodaysDeal(Request $request)
    {

    }
    //product published
    public function updatePublished(Request $request)
    {

    }
    //featured product status updated
    public function updateFeatured(Request $request)
    {

    }





}
