<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ecommerce Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('adm') }}/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="{{ asset('adm') }}/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('adm') }}/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="{{ asset('adm') }}/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="{{ asset('adm') }}/dist/css/sweetalert.css">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('adm') }}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('adm') }}/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- <script src="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
        <script src="{{ asset('js') }}/moment.min.js"></script>
        <script src="{{ asset('adm') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="{{ asset('adm') }}/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="{{ asset('adm') }}/plugins/select2/select2.min.js"></script>
        <script src="{{ asset('adm') }}/dist/js/sweetalert.min.js"></script>
        <script>
          $(function () {
            $("#example1").DataTable({
                "autoWidth": false,
                "responsive": true,
               @if(\Request::route()->getName() == 'admin.product.index') "pageLength": 50 @endif
               @if(\Request::route()->getName() == 'admin.order.index') "order": [[ 1, "desc" ]] @endif
            });

            $(".select2").select2();



              $('#datetimerange').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })

          });
            </script>
    </head>
    <body class="{{ $class ?? '' }}">
      @if(session()->has('logged_in') && Session::get('logged_in')==true)
            <form id="logout-form"  method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endif

        <div class="main-content" id="panel">
            @include('layouts.headers.common')
            @yield('content')
        </div>

        @if(!session()->has('logged_in') ||  (session()->has('logged_in')&&Session::get('logged_in')==false))
            @include('layouts.footers.guest')
        @endif



        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script>
        $(function () {
          //  $('#datetimerange').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        })
        </script>
    </body>
</html>
