<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\FlashDeal;
use App\Model\Product;
use App\Model\Review;
use App\Model\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getFeaturedProducts() {
        $products = Product::all();
        if (!empty($products))
        {
            return response()->json(['success'=>true,'response'=> $products], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
}
