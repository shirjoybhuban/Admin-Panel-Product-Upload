<?php
/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */


use App\Author;
use App\Model\OrderDetails;
use App\Model\ProductReview;
use App\Model\Product;
use App\ProductStock;
use App\Publisher;
use App\Seller;
use App\Shop;
use App\ShopCategory;
use App\User;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Advertisement;
use App\Slider;
use Illuminate\Support\Facades\DB;


//function homeDiscountedPrice($id)
//{
//    $product = Product::findOrFail($id);
//    $lowest_price = $product->unit_price;
//    $highest_price = $product->unit_price;
//
//    if ($product->variant_product) {
//        foreach ($product->stocks as $key => $stock) {
//            if($lowest_price > $stock->price){
//                $lowest_price = $stock->price;
//            }
//            if($highest_price < $stock->price){
//                $highest_price = $stock->price;
//            }
//        }
//    }
//
//    $flash_deals = FlashDeal::where('status', 1)->get();
//    $inFlashDeal = false;
//    foreach ($flash_deals as $flash_deal) {
//        if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
//            $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
//            if($flash_deal_product->discount_type == 'percent'){
//                $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
//                $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
//            }
//            elseif($flash_deal_product->discount_type == 'amount'){
//                $lowest_price -= $flash_deal_product->discount;
//                $highest_price -= $flash_deal_product->discount;
//            }
//            $inFlashDeal = true;
//            break;
//        }
//    }
//
//    if (!$inFlashDeal) {
//        if($product->discount_type == 'percent'){
//            $lowest_price -= ($lowest_price*$product->discount)/100;
//            $highest_price -= ($highest_price*$product->discount)/100;
//        }
//        elseif($product->discount_type == 'amount'){
//            $lowest_price -= $product->discount;
//            $highest_price -= $product->discount;
//        }
//    }
//
//    return $lowest_price.' - '.$highest_price;
//}

//function home_base_price($id)
//{
//    $product = Product::findOrFail($id);
//    return $product->unit_price;
//}

//function home_discounted_base_price($id)
//{
//
//    $product = Product::findOrFail($id);
//    $price = $product->unit_price;
//
//    $flash_deals = FlashDeal::where('status', 1)->get();
//    $inFlashDeal = false;
//    foreach ($flash_deals as $flash_deal) {
//        if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
//            $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
//            if($flash_deal_product->discount_type == 'Percent'){
//                $price -= ($price*$flash_deal_product->discount)/100;
//            }
//            elseif($flash_deal_product->discount_type == 'Flat'){
//                $price -= $flash_deal_product->discount;
//            }
//            $inFlashDeal = true;
//            break;
//        }
//    }
//
//    if (!$inFlashDeal) {
//        if($product->discount_type == 'Percent'){
//            $price -= ($price*$product->discount)/100;
//        }
//        elseif($product->discount_type == 'Flat'){
//            $price -= $product->discount;
//        }
//    }
//    //dd($price);
//    return $price;
//
//}

//function variantProductPrice($variant_id)
//{
//    $variant=ProductStock::find($variant_id);
//    $product = Product::findOrFail($variant->product_id);
//    $price =$variant->price;
//    if($product->discount_type == 'percent'){
//
//        $price -= ($variant->price*$product->discount)/100;
//    }
//    elseif($product->discount_type == 'amount'){
//        $price -= $product->discount;
//    }
//    return $price;
//}



// product variant price


// product price
if (!function_exists('productPrice')) {
    function productPrice($product_id)
    {

        $priceData = [
            'unit_price' => 0,
            'discount_status' => false,
            'discount_price' => 0,
            'discount_percent' => 0
        ];
        $product = Product::findOrFail($product_id);

        $author_discount=\App\Discount::where('author_id',$product->author_id)->where('status',1)->first();

        if (!empty($author_discount)){

            if($author_discount->discount_type == 'percent'){
                $calculated_price = ($product->unit_price * $author_discount->discount_amount) / 100;
                $priceData = [
                    'unit_price' => $product->unit_price,
                    'discount_status' => true,
                    'discount_price' => $calculated_price,
                    'discount_percent' => $author_discount->discount_amount,
                    'discount_amount' => $product->unit_price-$calculated_price,
                ];
            }else{
                $calculated_price = ($product->unit_price - $author_discount->discount_amount);
                $discount_parcent=($calculated_price*100)/$product->unit_price;
                $priceData = [
                    'unit_price' => $product->unit_price,
                    'discount_status' => true,
                    'discount_price' => $calculated_price,
                    'discount_percent' =>100-round($discount_parcent),
                    'discount_amount' => $author_discount->discount_amount,
                ];
            }
        }else{

            if($product->discount==0){
                $priceData = [
                    'unit_price' => $product->unit_price,
                    'discount_status' => false,
                    'discount_price' => $product->unit_price,
                    'discount_percent' => 0
                ];
            }else{

                if($product->discount_type == 'percent'){

                    $calculated_price = ($product->unit_price * $product->discount) / 100;
                    //dd($calculated_price);
                    $priceData = [
                        'unit_price' => $product->unit_price,
                        'discount_status' => true,
                        'discount_price' => $product->unit_price-$calculated_price,
                        'discount_percent' => $product->discount,
                        'discount_amount' => $calculated_price,
                    ];
                }else{

                    $calculated_price = ($product->unit_price - $product->discount);
                    $discount_parcent=($calculated_price*100)/$product->unit_price;
                    $priceData = [
                        'unit_price' => $product->unit_price,
                        'discount_status' => true,
                        'discount_price' => $calculated_price,
                        'discount_percent' =>100-round($discount_parcent),
                        'discount_amount' => $product->discount,
                    ];
                }
            }
        }



        return $priceData;
    }
}




// today flash deal products
//if (!function_exists('todayFlashDealProducts')) {
//    function todayFlashDealProducts()
//    {
//        $flashDealData = [
//            'flashDeal' => NULL,
//            'flashDealProducts' => NULL
//        ];
//
//        // flash sale
//        $flash_deal = FlashDeal::where('status',1)
//            ->where('start_date_time','<=',strtotime(date('d-m-Y')))
//            ->where('end_date_time','>=',strtotime(date('d-m-Y')))
//            ->first();
//
//        if(!empty($flash_deal)){
//            $flashDealData['flashDeal']=$flash_deal;
//
//            $flash_sale_products = DB::table('flash_deal_products')
//                ->join('products','flash_deal_products.product_id','products.id')
//                ->where('flash_deal_id',$flash_deal->id)
//                ->select(
//                    'flash_deal_products.flash_deal_id',
//                    'flash_deal_products.user_id',
//                    'flash_deal_products.role_id',
//                    'flash_deal_products.shop_id',
//                    //'flash_deal_products.discount_type',
//                    //'flash_deal_products.discount',
//                    'flash_deal_products.product_id',
//                    'products.name',
//                    'products.slug',
//                    'products.thumbnail_img'
//                )
//                ->get();
//
//            $data = [];
//            if(count($flash_sale_products) > 0){
//                foreach($flash_sale_products as $flash_sale_product){
//                    $nested_data['flash_deal_id']=$flash_sale_product->flash_deal_id;
//                    $nested_data['user_id']=$flash_sale_product->user_id;
//                    $nested_data['role_id']=$flash_sale_product->role_id;
//                    $nested_data['shop_id']=$flash_sale_product->shop_id;
//                    $nested_data['product_id']=$flash_sale_product->product_id;
//                    $nested_data['name']=$flash_sale_product->name;
//                    $nested_data['slug']=$flash_sale_product->slug;
//                    $nested_data['thumbnail_img']=$flash_sale_product->thumbnail_img;
//
//                    array_push($data, $nested_data);
//                }
//
//            }
//            $flashDealData['flashDealProducts']=$data;
//        }
//
//
//        return $flashDealData;
//    }
//}

// shop flash deal products
//if (!function_exists('shopFlashDealProducts')) {
//    function shopFlashDealProducts($shop_id)
//    {
//        $flashDealData = [
//            'flashDeal' => NULL,
//            'flashDealProducts' => NULL
//        ];
//
//        // flash sale
//        $flash_deal = FlashDeal::where('status',1)
//            ->where('start_date_time','<=',strtotime(date('d-m-Y')))
//            ->where('end_date_time','>=',strtotime(date('d-m-Y')))
//            ->where('shop_id',$shop_id)
//            ->first();
//
//        if(!empty($flash_deal)){
//            $flashDealData['flashDeal']=$flash_deal;
//
//            $flash_sale_products = DB::table('flash_deal_products')
//                ->join('products','flash_deal_products.product_id','products.id')
//                ->where('flash_deal_id',$flash_deal->id)
//                ->where('shop_id',$shop_id)
//                ->select(
//                    'flash_deal_products.flash_deal_id',
//                    'flash_deal_products.user_id',
//                    'flash_deal_products.role_id',
//                    'flash_deal_products.shop_id',
//                    //'flash_deal_products.discount_type',
//                    //'flash_deal_products.discount',
//                    'flash_deal_products.product_id',
//                    'products.name',
//                    'products.slug',
//                    'products.thumbnail_img'
//                )
//                ->get();
//
//            $data = [];
//            if(count($flash_sale_products) > 0){
//                foreach($flash_sale_products as $flash_sale_product){
//                    $nested_data['flash_deal_id']=$flash_sale_product->flash_deal_id;
//                    $nested_data['user_id']=$flash_sale_product->user_id;
//                    $nested_data['role_id']=$flash_sale_product->role_id;
//                    $nested_data['shop_id']=$flash_sale_product->shop_id;
//                    $nested_data['product_id']=$flash_sale_product->product_id;
//                    $nested_data['name']=$flash_sale_product->name;
//                    $nested_data['slug']=$flash_sale_product->slug;
//                    $nested_data['thumbnail_img']=$flash_sale_product->thumbnail_img;
//
//                    array_push($data, $nested_data);
//                }
//
//            }
//            $flashDealData['flashDealProducts']=$data;
//        }
//
//
//        return $flashDealData;
//    }
//}



// shop rating
if (!function_exists('shopRating')) {
    function shopRating($shop_id)
    {

        $fiveStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',5)->where('status',1)->sum('rating');
        $fourStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',4)->where('status',1)->sum('rating');
        $threeStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',3)->where('status',1)->sum('rating');
        $twoStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',2)->where('status',1)->sum('rating');
        $oneStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',1)->where('status',1)->sum('rating');
        $totalRating = ProductReview::where('shop_id',$shop_id)->sum('rating');


        if ($totalRating > 0){
            $rating = (5*$fiveStarRev + 4*$fourStarRev + 3*$threeStarRev + 2*$twoStarRev + 1*$oneStarRev) / ($totalRating);
            $totalRatingCount = number_format((float)$rating, 1, '.', '');
        }else{
            $totalRatingCount =number_format((float)0, 1, '.', '');
        }
        return $totalRatingCount;
    }
}

if (!function_exists('shopRatingStar')) {
    function shopRatingStar($round_shop_rating)
    {
        if($round_shop_rating == 5){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star"></small>
                </div>';
        }elseif($round_shop_rating == 4){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 3){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 2){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 1){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }else{
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }

        return $star;
    }
}

if (!function_exists('productRatingStar')) {
    function productRatingStar($rating)
    {
        if($rating == 5){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star"></small>
                </div>';
        }elseif($rating == 4){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 3){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 2){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 1){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }else{
            $star = '<div class="text-warning">
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }

        return $star;
    }
}

// product review count
if (!function_exists('productReviewCount')) {
    function productReviewCount($product_id)
    {
        return $product_reviews = \App\Model\Review::where('product_id',$product_id)->where('status',1)->get()->count();
    }
}

// product review average count
if (!function_exists('productReviewAverageCount')) {
    function productReviewAverageCount($product_id)
    {
        $star_rev_data = [
            'fiveStarRev'=>0,
            'fourStarRev'=>0,
            'threeStarRev'=>0,
            'twoStarRev'=>0,
            'oneStarRev'=>0,
        ];

        $star_rev_data['fiveStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',5)->where('status',1)->get()->count();
        $star_rev_data['fourStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',4)->where('status',1)->get()->count();
        $star_rev_data['threeStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',3)->where('status',1)->get()->count();
        $star_rev_data['twoStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',2)->where('status',1)->get()->count();
        $star_rev_data['oneStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',1)->where('status',1)->get()->count();

        return $star_rev_data;
    }
}

// product review comments
if (!function_exists('productReviewComments')) {
    function productReviewComments($product_id)
    {
        return $reviewsComments = ProductReview::where('product_id',$product_id)->where('status',1)->latest()->paginate(5);
    }
}


if (!function_exists('product_details')) {
    function product_details($product)
    {
        //dd(productReviewCount($product->id));
        $productPrice = productPrice($product->id);
        $photo=json_decode($product->photos);
        $rating='<li><i class="fa fa-star"></i></li>';
        if($product->rating){
            for($i=0;$i<$product->rating;$i++){
                $rating=$rating.'<li><i class="fa fa-star"></i></li>';
            }
        }else{
            for($i=0;$i<3;$i++){
                $rating=$rating.'<li><i class="fa fa-star"></i></li>';
            }
        }

        if($productPrice['discount_status']){
            $details='<div class="single-product">
                                <div class="product-img">
                                    <a href="/'.$product->slug.'">
                                        <img class="primary-img"  src="/'.$product->thumbnail_img.'" alt="">

                                    </a>
                                    <div class="sticker"><span>New</span></div>
                                    <div class="sticker-2"><span>-'.$productPrice["discount_percent"].'%</span></div>
                                </div>
                                <div class="product-content">
                                    <h2 class="product-name product-name-custom">
                                        <a href="/'.$product->slug.'">'.$product->name.'</a>
                                    </h2>
                                    <h2 class="product-name">
                                        <a href="/'.$product->slug.'">'.$product->author->name.'</a>
                                    </h2>
                                    <div class="rating-box">
                                        <ul class="rating">'.$rating.'
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price">৳'.$productPrice["discount_price"].'</span>
                                        <span class="old-price">৳'.$productPrice["unit_price"].'</span>
                                    </div>
                                    <div class="product-action">
                                        <ul class="product-action-link">
                                            <li class="shopping-cart_link add-to-cart" id="'.$product->id.'"><a href="#" title="Add to Cart"><i class="ion-bag"></i></a></li>
                                            <li><a href="/add/wishlist/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="fa fa-heart"></i></a></li>
                                            <li class="single-product_link"><a href="/'.$product->slug.'" title="Single Product"><i class="ion-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
        }else{
            $details='<div class="single-product">
                                <div class="product-img">
                                    <a href="/'.$product->slug.'">
                                        <img class="primary-img"  src="/'.$product->thumbnail_img.'" alt="">
                                    </a>
                                    <div class="sticker"><span>New</span></div>
                                </div>
                                <div class="product-content">
                                    <h2 class="product-name product-name-custom">
                                        <a href="/'.$product->slug.'">'.$product->name.'</a>
                                    </h2>
                                    <h2 class="product-name">
                                        <a href="/'.$product->slug.'">'.$product->author->name.'</a>
                                    </h2>
                                    <div class="rating-box">
                                        <ul class="rating">
                                            '.$rating.'
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price">৳'.$productPrice["discount_price"].'</span>
                                    </div>
                                    <div class="product-action">
                                        <ul class="product-action-link">
                                            <li class="shopping-cart_link add-to-cart" id="'.$product->id.'"><a href="#" title="Add to Cart"><i class="ion-bag"></i></a></li>
                                            <li><a href="/add/wishlist/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="fa fa-heart"></i></a></li>
                                            <li class="single-product_link"><a href="/'.$product->slug.'" title="Single Product"><i class="ion-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
        }

        return  $details;
    }
}

if (!function_exists('product_details_category')) {
    function product_details_category($product)
    {
        $productPrice = productPrice($product->id);
        $photo=json_decode($product->photos);
        if($productPrice['discount_status']){
            $details='<div class="single-product list-single_product">
                                                <div class="product-img list-product_img">
                                                    <a href="/'.$product->slug.'">
                                        <img class="primary-img"  src="'.$product->thumbnail_img.'" alt="">
                                        <img class="secondary-img" src="'.$photo[0].'" alt="">
                                    </a>
                                                    <div class="sticker"><span>New</span></div>
                                    <div class="sticker-2"><span>-'.$productPrice["discount_percent"].'%</span></div>
                                                </div>
                                                <div class="product-content list-product_content">
                                                    <h2 class="product-name product-name-custom">
                                                        <a href="/'.$product->slug.'">'.$product->name.'</a>
                                    </h2></a>
                                                    </h2>
            <h2 class="product-name">
                                        <a href="/'.$product->slug.'">'.$product->author->name.'</a>
                                    </h2>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="new-price">৳'.$productPrice["discount_price"].'</span>
                                        <span class="old-price">৳'.$productPrice["unit_price"].'</span>
                                                    </div>
                                                    <div class="product-action list-product_action">
                                                        <ul class="product-action-link">
                                            <li class="shopping-cart_link add-to-cart" id="'.$product->id.'"><a href="#" title="Add to Cart"><i class="ion-bag"></i></a></li>
                                            <li><a href="/add/wishlist/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="fa fa-heart"></i></a></li>
                                            <li class="single-product_link"><a href="/'.$product->slug.'" title="Single Product"><i class="ion-link"></i></a></li>
                                        </ul>
                                                    </div>
                                                </div>
                                            </div>';


        }else{
            $details='<div class="single-product list-single_product">
                                                <div class="product-img list-product_img">
                                                    <a href="/'.$product->slug.'">
                                        <img class="primary-img"  src="'.$product->thumbnail_img.'" alt="">
                                        <img class="secondary-img" src="'.$photo[0].'" alt="">
                                    </a>
                                                    <div class="sticker"><span>New</span></div>
                                                </div>
                                                <div class="product-content list-product_content">
                                                    <h2 class="product-name product-name-custom">
                                                        <a href="/'.$product->slug.'">'.$product->name.'</a>
                                    </h2></a>
                                                    </h2>
            <h2 class="product-name">
                                        <a href="/'.$product->slug.'">'.$product->author->name.'</a>
                                    </h2>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="new-price">৳'.$productPrice["discount_price"].'</span>
                                                    </div>
                                                    <div class="product-action list-product_action">
                                                        <ul class="product-action-link">
                                            <li class="shopping-cart_link add-to-cart" id="'.$product->id.'"><a href="#" title="Add to Cart"><i class="ion-bag"></i></a></li>
                                            <li><a href="/add/wishlist/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="fa fa-heart"></i></a></li>
                                            <li class="single-product_link"><a href="/'.$product->slug.'" title="Single Product"><i class="ion-link"></i></a></li>
                                        </ul>
                                                    </div>
                                                </div>
                                            </div>';
        }

        return  $details;
    }

    // last one year best sale products
    if (!function_exists('lastYearBestSaleProducts')) {
        function lastYearBestSaleProducts()
        {
            //$lastSevenDaysDate = date("Y-m-d", strtotime("7 days ago"));
            $lastYear = date("Y-m-d", strtotime("-1 years"));
            //dd($lastYear);
            //$custom_date = $lastSevenDaysDate.' 00:00:00';
            $custom_date = $lastYear.' 00:00:00';
            $orderDatas=DB::table('order_details')
                ->where('created_at','>=',$custom_date)
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->havingRaw('SUM(quantity) > 1')
                ->take(6)
                //->orderBy('id','desc')
                ->get();
            $prod_id = [];
            if(count($orderDatas) > 0){
                foreach ($orderDatas as $orderData){
                    $prod_id[] = $orderData->product_id;
                }
            }
            return $lastYearBestSaleProducts=Product::whereIn('id',$prod_id)->paginate(20);
        }
    }

    // weekly top authors
    if (!function_exists('weeklyTopAuthors')) {
        function weeklyTopAuthors()
        {
            //$lastSevenDaysDate = date("Y-m-d", strtotime("7 days ago"));
            $lastYear = date("Y-m-d", strtotime("-1 years"));
            //dd($lastYear);
            //$custom_date = $lastSevenDaysDate.' 00:00:00';
            $custom_date = $lastYear.' 00:00:00';

            $orderDatas=DB::table('order_details')
                ->where('created_at','>=',$custom_date)
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->havingRaw('SUM(quantity) > 1')
                ->take(6)
                //->orderBy('id','desc')
                ->get();
            $prod_id = [];
            if(count($orderDatas) > 0){
                foreach ($orderDatas as $orderData){
                    $prod_id[] = $orderData->product_id;
                }
            }
            $author_id = Product::whereIn('id',$prod_id)->pluck('author_id')->toArray();
            return $authores=Author::whereIn('id',$author_id)->get();
        }
    }

    if (!function_exists('author_details')) {
        function author_details($author)
        {
            //return $author;
            $details='<div class="single-product">
                            <div class="product-img">
                                <a href="/book/author/'.$author->slug.'">
                                    <img class="primary-img" style="border-radius:50%" src="uploads/author/'.$author->image.'" alt="">
                                </a>
                            </div>
                            <div class="product-content text-center">
                                <h2 class="product-name product-name-custom">
                                    <a href="/book/author/'.$author->slug.'">'.$author->name.'</a>
                                </h2>
                            </div>
                        </div>';


            return  $details;
        }
    }

    // best sale products
    if (!function_exists('bestSaleProducts')) {
        function bestSaleProducts()
        {

            $orderDatas=DB::table('order_details')
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->havingRaw('SUM(quantity) > 1')
                ->take(6)
                //->orderBy('id','desc')
                ->get();
            $prod_id = [];
            if(count($orderDatas) > 0){
                foreach ($orderDatas as $orderData){
                    $prod_id[] = $orderData->product_id;
                }
            }
            return $bestSaleProducts=Product::whereIn('id',$prod_id)->get();
        }
    }

    // best sale authors
    if (!function_exists('bestSaleAuthors')) {
        function bestSaleAuthors()
        {
            $orderDatas=DB::table('order_details')
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->havingRaw('SUM(quantity) > 1')
                ->take(6)
                //->orderBy('id','desc')
                ->get();
            $prod_id = [];
            if(count($orderDatas) > 0){
                foreach ($orderDatas as $orderData){
                    $prod_id[] = $orderData->product_id;
                }
            }
            $author_id = Product::whereIn('id',$prod_id)->pluck('author_id')->toArray();
            return $authores=Author::whereIn('id',$author_id)->get();
        }
    }

    // best sale publishers
    if (!function_exists('bestSalePublishers')) {
        function bestSalePublishers()
        {
            $orderDatas=DB::table('order_details')
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->havingRaw('SUM(quantity) > 1')
                ->take(6)
                //->orderBy('id','desc')
                ->get();
            $prod_id = [];
            if(count($orderDatas) > 0){
                foreach ($orderDatas as $orderData){
                    $prod_id[] = $orderData->product_id;
                }
            }

            $publisher_id = Product::whereIn('id',$prod_id)->pluck('publisher_id')->toArray();
            return $publishers=Publisher::whereIn('id',$publisher_id)->get();
        }
    }
}


