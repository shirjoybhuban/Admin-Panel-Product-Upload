<?php

namespace App\Http\Controllers\Frontend;
use App\Author;
use App\Helpers\UserInfo;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\Offer;
use App\Model\Product;
use App\Model\Quote;
use App\Model\Seller;
use App\Model\Shop;
use App\Model\Slider;
use App\Model\Subcategory;
use App\Model\VerificationCode;
use App\Publisher;
use App\Setting;
use App\TrandingCategory;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index() {
        return redirect()->route('admin.products.index');

    }
}
