<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>AnonymusÜgyvitel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    {{--Syles--}}

    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/ugyvitel.css")}}">
    {{--<link href="{{ asset('../css/bootstrap.min.css') }}" rel="stylesheet">--}}

</head>
<body>
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-sm-12">
@include('layouts.topnav')
    </div>
</div>
@if (session('success'))
    <div class="row">
    <div class="col-mg-6 alert alert-success">
        {{session('success')}}
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-2 col-md-2 col-sm-2">
        @if(Auth::check())

        @include('layouts.EmployeeSidenav')
    </div>
    <div class="col-lg-10 col-md-10 cl-sm-10">
        @yield('content')
    </div>
    {{--<main class="py-4">--}}
        {{--@yield('content')--}}
    {{--</main>--}}
@else @yield('login_content')
</div>

@endif

@include('layouts.footer')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
{{--<!-- Include all compiled plugins (below), or include individual files as needed -->--}}
{{--<script src="{{ asset('../js/bootstrap.min.js') }}"></script>--}}
{{----}}

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>{{--//Csak 1 helyen szerepeljen vagy felülíródik--}}

</body>
</html>
