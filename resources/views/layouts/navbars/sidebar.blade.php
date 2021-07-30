<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('assets') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('assets') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>

            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-settings-gear-65 text-primary"></i> {{ __('Settings') }}
                    </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="#settings_menu" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="settings_menu">
                        <i class="ni ni-settings-gear-65 text-primary" ></i>
                        <span class="nav-link-text" >{{ __('Settings') }}</span>
                    </a>

                    <div class="collapse" id="settings_menu">
                        <ul class="nav nav-sm flex-column">
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.settings.configurations', 'basic') }}">
                                <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                  {{ __('Basic') }}
                              </a>
                          </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'site') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Site Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'auth') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Auth Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'category') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Category Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'email') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Email Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'sms') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('SMS Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'payment') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Payment Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'social') }}">
                                      <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Social Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'courier') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Courier Settings') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.settings.configurations', 'address') }}">
                                    <!-- <i class="fa fa-circle text-primary text-xs" ></i> -->
                                    {{ __('Address Field Settings') }}
                                </a>
                            </li>
                          </ul>
                      </div>
                  </li>


              </ul>



                    </div>

        </div>
    </div>
</nav>
