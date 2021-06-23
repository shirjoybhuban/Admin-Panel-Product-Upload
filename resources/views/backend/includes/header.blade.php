<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="{{url('/')}}" class="nav-link"  data-toggle="frontend" data-placement="bottom" data-original-title="Browse Frontend">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        {{--<li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Profile</a>
        </li>--}}
    </ul>
    

<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user-circle"></i> <strong>{{Auth::user()->name}}</strong>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="image text-center">
                    <img src="{{asset('backend/images/logo.png')}}" width="60px" height="60px" class="img-circle elevation-2 mt-2" alt="User Image">
                </div>
                <span class="dropdown-item dropdown-header">
                    <strong>{{Auth::user()->name}}</strong><br>
                    <small>{{Auth::user()->created_at->diffForHumans()}}</small>
                </span>
                <div class="dropdown-divider"></div>
                <div class="float-left">
                    <a href="" class="dropdown-item">
                        <i class="fa fa-user-circle-o mr-2"></i> Profile
                    </a>
                </div>
                <div class="float-right">
                    <a href="#" class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i--}}
        {{--                    class="fa fa-th-large"></i></a>--}}
        {{--        </li>--}}
    </ul>
</nav>
