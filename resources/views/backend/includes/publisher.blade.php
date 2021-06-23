<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;border-radius: 0px 25px 25px 0px;">
    <!-- Brand Logo -->
{{--<a href="#" class="brand-link">
    <img src="{{asset('backend/images/logo.png')}}" width="150" height="100" alt="Aamar Bazar" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    --}}{{--<span class="brand-text font-weight-light">Farazi Home Care</span>--}}{{--
</a>--}}
<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
{{--                <img src="{{asset('frontend/img/logo-mudi-hat.png')}}" class="" alt="User Image" width="100%">--}}
                <h3 class="font-weight-bold text-light">TaraHuralifestyle</h3>
            </div>
        </div>

    @if(Auth::user()->user_type == 'publisher')
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{(Request::is('admin/brands*')
                        || Request::is('admin/categories*')
                        || Request::is('admin/subcategories*')
                        || Request::is('admin/sub-subcategories*')
                        || Request::is('admin/products*')
                        || Request::is('admin/offers*')
                        || Request::is('admin/request/products*')
                        || Request::is('admin/all/seller/products*')
                        || Request::is('admin/attributes*'))
                    ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Product Management
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.attributes.index')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/attributes*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/attributes*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>Attributes</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.brands.index')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/brands*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/brands*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>Brands</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}"
                               class="nav-link {{Request::is('admin/categories*') ? 'active' :''}}">
                                <i class="fa fa-{{Request::is('admin/categories*') ? 'folder-open':'folder'}} nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.subcategories.index')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/subcategories*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/subcategories*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>Subcategories</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.sub-subcategories.index')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/sub-subcategories*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/sub-subcategories*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>Sub Subcategories</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}"
                               class="nav-link {{Request::is('admin/products*') ? 'active' :''}}">
                                <i class="fa fa-{{Request::is('admin/products*') ? 'folder-open':'folder'}} nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.offers.index')}}"
                               class="nav-link {{Request::is('admin/offers*') ? 'active' :''}}">
                                <i class="fa fa-{{Request::is('admin/offers*') ? 'folder-open':'folder'}} nav-icon"></i>
                                <p>Offer</p>
                            </a>
                        </li>
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.products.request.form.seller')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/request/products/from/seller*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/request/products/from/seller*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>Seller Req Products</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('admin.all.seller.products')}}"--}}
                        {{--                                   class="nav-link {{Request::is('admin/all/seller/products*') ? 'active' :''}}">--}}
                        {{--                                    <i class="fa fa-{{Request::is('admin/all/seller/products*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
                        {{--                                    <p>All Seller Products</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                    </ul>
                </li>
                <li class="nav-item ">

                    <a href="{{route('admin.site.optimize')}}" class="nav-link {{Request::is('admin/site-optimize*') ? 'active' : ''}}">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Site Optimize
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        @endif
    </div>
    <!-- /.sidebar -->
</aside>


