@extends('backend.layouts.master')
@section("title","Manage Password")
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('publisher.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <form role="form" id="choice_form" action="{{route('publisher.password.update')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="added_by" value="publisher">
        <section class="content-fluid">
            <div class="row m-2">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <p class="pl-2 pb-0 mb-0 bg-info">Manage Password</p>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Old Password</label>
                                <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" required>
                            </div>
                            <div class="form-group">
                                <label for="name">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                            <div class="float-center">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>
@stop
@push('js')
@endpush
