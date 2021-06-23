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
                <h3 class="font-weight-bold text-light">Watch</h3>
            </div>
        </div>
    
    @if (Auth::check()  && (Auth::user()->user_type == 'admin')  )
        <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('admin.products.index')}}"
                           class="nav-link {{Request::is('admin/products*') ? 'active' :''}}">
                            <i class="fa fa-{{Request::is('admin/products*') ? 'folder-open':'folder'}} nav-icon"></i>
                            <p>Products</p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
    <!-- /.sidebar -->
</aside>


