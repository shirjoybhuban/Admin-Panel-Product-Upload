{{--<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;border-radius: 0px 25px 25px 0px;">--}}
{{--    <!-- Brand Logo -->--}}
{{--<a href="#" class="brand-link">--}}
{{--    <img src="{{asset('backend/images/logo.png')}}" width="150" height="100" alt="Aamar Bazar" class="brand-image img-circle elevation-3"--}}
{{--         style="opacity: .8">--}}
{{--    --}}{{----}}{{--<span class="brand-text font-weight-light">Farazi Home Care</span>--}}{{----}}{{----}}
{{--</a>--}}
{{--<!-- Sidebar -->--}}
{{--    <div class="sidebar" >--}}
{{--        <!-- Sidebar user panel (optional) -->--}}
{{--        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">--}}
{{--            <div class="">--}}
{{--                <img src="{{asset('frontend/img/logo-mudi-hat.png')}}" class="" alt="User Image" width="100%">--}}
{{--            </div>--}}
{{--            --}}{{--<div class="info">--}}
{{--                <a href="" class="d-block"><strong>Aamar Bazar</strong></a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    @if (Auth::check() && Auth::user()->user_type == 'seller' )--}}
{{--        <!-- Sidebar Menu -->--}}
{{--            <nav class="mt-2">--}}
{{--                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"--}}
{{--                    data-accordion="false">--}}
{{--                    <!-- Add icons to the links using the .nav-icon class--}}
{{--                         with font-awesome or any other icon font library -->--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('seller.dashboard')}}" class="nav-link {{Request::is('seller/dashboard') ? 'active' : ''}}">--}}
{{--                            <i class="nav-icon fas fa-home"></i>--}}
{{--                            <p>--}}
{{--                                Dashboard--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @if(Auth::user()->seller->verification_status == 1)--}}
{{--                    <li class="nav-item has-treeview {{(Request::is('seller/products*')) || (Request::is('seller/get/admin/products*')) || (Request::is('seller/flash_deals*'))--}}
{{--                    ? 'menu-open' : ''}}">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-shopping-cart"></i>--}}
{{--                            <p>--}}
{{--                                Product Management--}}
{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.products.index')}}" class="nav-link {{Request::is('seller/products*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/products*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>All Products</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.get.admin.products')}}" class="nav-link {{Request::is('seller/get/admin/products*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/get/admin/products*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Admin Inserted Products</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.flash_deals.index')}}" class="nav-link {{Request::is('seller/seller/flash_deals*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/flash_deals*') ? 'folder-open':'bolt'}} nav-icon"></i>--}}
{{--                                    <p>Flash Deals</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item has-treeview {{(Request::is('seller/order*')) ? 'menu-open' : ''}}">--}}
{{--                        <a href="" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-box"></i>--}}
{{--                            <p>--}}
{{--                                Order Management--}}
{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.pending')}}" class="nav-link {{Request::is('seller/order/pending*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/pending*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Pending Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.on-reviewed')}}" class="nav-link {{Request::is('seller/order/on-reviewed*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/on-reviewed*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>On Reviewed Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.on-delivered')}}" class="nav-link {{Request::is('seller/order/on-delivered*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/on-delivered*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>On Delivered Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.delivered')}}" class="nav-link {{Request::is('seller/order/delivered*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/delivered*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Delivered Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.completed')}}" class="nav-link {{Request::is('seller/order/completed*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/completed*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Completed Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('seller.order.canceled')}}" class="nav-link {{Request::is('seller/order/canceled*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('seller/order/canceled*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Cancel Order</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}

{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('seller.money.withdraw') }}" class="nav-link {{Request::is('seller/money*') ? 'active' : ''}}">--}}
{{--                            <i class="nav-icon fas fa-money-bill-wave"></i>--}}
{{--                            <p>--}}
{{--                                Money Withdraw--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('seller.payment.history')}}" class="nav-link {{Request::is('seller/payment/history*') ? 'active' : ''}}">--}}
{{--                                <i class="nav-icon fas fa-history"></i>--}}
{{--                                <p>--}}
{{--                                    Payment History--}}
{{--                                    --}}{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('seller.payment.report') }}" class="nav-link {{Request::is('seller/payment-report*') ? 'active' : ''}}">--}}
{{--                                <i class="nav-icon fas fa-chart-area"></i>--}}
{{--                                <p>--}}
{{--                                    Payment Report--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item has-treeview">--}}
{{--                            <a href="{{route('seller.customer.list')}}" class="nav-link {{Request::is('seller/customer/list*') ? 'active' : ''}}">--}}
{{--                                <i class="nav-icon fas fa-users"></i>--}}
{{--                                <p>--}}
{{--                                    Customer List--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @php--}}
{{--                    $shop = \App\Model\Shop::where('user_id',Auth::id())->first();--}}
{{--                    $new_review = \App\Model\Review::where('shop_id',$shop->id)->where('viewed',0)->count();--}}
{{--                        @endphp--}}
{{--                        <li class="nav-item has-treeview">--}}
{{--                            <a href="{{route('seller.customer.review')}}" class="nav-link {{Request::is('seller/customer/review*') ? 'active' : ''}}">--}}
{{--                                <i class="nav-icon fas fa-star"></i>--}}
{{--                                <p>--}}
{{--                                    Customer Review--}}
{{--                                    @if(!empty($new_review))--}}
{{--                                        <span class="badge badge-danger">{{$new_review}} New</span>--}}
{{--                                    @endif--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    <li class="nav-item has-treeview">--}}
{{--                        <a href="{{route('seller.profile.show')}}" class="nav-link {{Request::is('seller/profile*') ? 'active' : ''}}">--}}
{{--                            <i class="nav-icon fas fa-user-circle"></i>--}}
{{--                            <p>--}}
{{--                                Manage Profile--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            @php--}}
{{--                                $shop_set = App\Model\Shop::where('user_id',Auth::id())->select('slug')->first();--}}
{{--                            @endphp--}}
{{--                            <a href="{{route('seller.shop.manage',$shop_set->slug)}}" class="nav-link {{Request::is('seller/shop/manage*') ? 'active' :''}}">--}}
{{--                                <i class="nav-icon fas fa-shopping-bag"></i>--}}
{{--                                <p>Manage Shop</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @else--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('seller.profile.show')}}" class="nav-link {{Request::is('seller/manage-profile') ? 'active' : ''}}">--}}
{{--                                <i class="nav-icon fas fa-user-circle"></i>--}}
{{--                                <p>--}}
{{--                                    Manage Profile--}}
{{--                                    --}}{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            @php--}}
{{--                                $shop_set = App\Model\Shop::where('user_id',Auth::id())->select('slug')->first();--}}
{{--                            @endphp--}}
{{--                            <a href="{{route('seller.shop.manage',$shop_set->slug)}}" class="nav-link {{Request::is('seller/shop/manage*') ? 'active' :''}}">--}}
{{--                                <i class="nav-icon fas fa-shopping-bag"></i>--}}
{{--                                <p>Manage Shop</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item has-treeview {{(Request::is('seller/shop*')) || (Request::is('seller/seller-info*')) ? 'menu-open' : ''}}">--}}
{{--                            <a href="" class="nav-link ">--}}
{{--                                <i class="nav-icon fas fa-cog"></i>--}}
{{--                                <p>--}}
{{--                                    Settings--}}
{{--                                    <i class="right fa fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    @php--}}
{{--                                        $shop_set = App\Model\Shop::where('user_id',Auth::id())->select('slug')->first();--}}
{{--                                    @endphp--}}
{{--                                    <a href="{{route('seller.shop.manage',$shop_set->slug)}}" class="nav-link {{Request::is('seller/shop/manage*') ? 'active' :''}}">--}}
{{--                                        <i class="fa fa-{{Request::is('seller/shop*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                        <p>Shop Settings</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('seller.seller-info.index')}}" class="nav-link {{Request::is('seller/seller-info*') ? 'active' :''}}">--}}
{{--                                        <i class="fa fa-{{Request::is('seller/seller-info*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                        <p>Seller Info Settings</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--            <!-- /.sidebar-menu -->--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    <!-- /.sidebar -->--}}
{{--</aside>--}}


