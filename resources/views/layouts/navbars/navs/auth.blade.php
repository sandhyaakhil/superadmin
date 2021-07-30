<!-- Top navbar -->
  @if(session()->has('logged_in') && Session::get('logged_in')==true)
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="Search" type="text">
                </div>
            </div>
        </form> -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('assets') }}/img/theme/avatar.png">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a id="logoutButton" href="" class="dropdown-item" onclick="event.preventDefault();logout()">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
@endif
<script>
    function logout() {
      //alert('rear')
      var url = '{{ route("logout") }}';

    //var data = {'email': $('#email').val(), 'password': $('#password').val()};
  $.ajax({
           //method:'POST',
           type: 'POST',
           url:url,
           data:'_token={{ csrf_token() }}',
           success:function(res){

             console.log(res)
            window.location=res.url;
             //document.location.href = '../home';
           },
           error:function(data)
           {
             alert('e');
               console.log(data);


           }

        });

        return false;

    }
</script>
