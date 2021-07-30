@extends('layouts.main')

@section('content')

@include('dashboard.customer.partials.header')


    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Customer Details') }}</h3>
                        </div>
                    </div>


                    <div class="card-body">
                        <form method="post" action="{{ route('admin.customer.update', $customer->id) }}">

                          @csrf
                          <input type="text" class="hidden" value="{{ $customer->email }}" required name="eemail">
                          <input type="text" class="hidden" value="{{ $customer->mobile }}" required name="emobile">

                            <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                            @if (count($errors) > 0)

                                <div class="alert alert-danger">

                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                                        <ul>

                                                @foreach ($errors->all() as $error)

                                                        <li>{{ $error }}</li>

                                                @endforeach

                                        </ul>

                                </div>

                            @endif
                            @if ($message = Session::get('success'))

                            <div class="alert alert-success alert-block">

                                    <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ $message }}</strong>

                            </div>
                            @endif
                            @if ($message = Session::get('error'))

                            <div class="alert alert-danger alert-block">

                                    <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ $message }}</strong>

                            </div>
                            @endif

                            <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <li class="nav-item active"><a class="nav-link" href="#tab_general" data-toggle="tab">General</a></li>

                            </ul> -->


                            <!-- <div class="pl-lg-4"> -->
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_general">

                              <div class="box-body">

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Name</label>
                                  <input type="text" class="form-control" value="{{ old('name',$customer->name) }}" required name="name" placeholder="Enter Name">
                                </div>
                                  <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="text" class="form-control" value="{{ old('email',$customer->email) }}"  name="email" placeholder="Enter Email">
                                </div>
                                  <div class="form-group">
                                  <label for="exampleInputEmail1">Mobile</label>
                                  <input type="text" class="form-control" value="{{ old('mobile',$customer->mobile) }}" required name="mobile" placeholder="Enter Mobile">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label>
                                  <input type="password" class="form-control" value="{{ old('password') }}"  name="password"  placeholder="Password">
                                </div>

                                <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required >
                                     <option value="" selected >Select Status</option>
                                    <option  value="1" {{ old('status',$customer->status) == 1 ? 'selected' : '' }}     >Active</option>
                                    <option  value="0" {{ old('status',$customer->status) == 0 ? 'selected' : '' }}  >InActive</option>
                                    <option  value="2" {{ old('status',$customer->status) == 2 ? 'selected' : '' }}     >Email Verified</option>
                                    <option  value="3" {{ old('status',$customer->status) == 3 ? 'selected' : '' }}  >Mobile Verified</option>

                                </select>
                              </div>


                                </div>
                              </div>


                            </div>
                            <!-- /.tab-content -->

                          <!-- nav-tabs-custom -->


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
