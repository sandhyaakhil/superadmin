@extends('layouts.main')

@section('content')

@include('dashboard.customer.partials.header', ['page'=>'create'])


    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Customer Details') }}</h3>
                        </div>
                    </div>


                    <div class="card-body">
                        <form method="post" action="{{ route('admin.customer.store') }}" autocomplete="off">

                          @csrf

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

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-mobile">{{ __('Mobile') }}</label>
                                    <input type="number" name="mobile" id="input-mobile" class="form-control form-control-alternative{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="{{ __('Mobile') }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-grou">
                                  <label>Status</label>
                                  <select class="form-control" name="status" required>
                                       <option value="" selected >Select</option>
                                      <option  value="1" >Active</option>
                                      <option  value="0">InActive</option>
                                      <option  value="2">Email Verified</option>
                                      <option  value="3">Mobile Verified</option>

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
