<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('storage/logo/himalayan_face_logo.ico') }}" type="image/x-icon">
    @yield('csslink')
</head>
<body>

    <nav class="px-4 navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/logo/himalayan_face_logo.ico') }}" alt="">
            @yield('title')
        </a>
        <button class="navbar-toggler" type="button" id="navbarToggle" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fa-solid fa-power-off"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="height: 90%;">
        <div class="row h-100">
            <div class="col-lg-2 col-md-12 sidebar py-3">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link  font-weight-bolder" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bolder" href="{{ route('order') }}">Order</a>
                        <span class="">
                            <a class="nav-link text-secondary" href="{{ route('assign_order_view') }}">Assign Order</a>
                        </span>
                        <span class="">
                            <a class="nav-link text-secondary" href="{{ route('submit_order_view') }}">Submit Order</a>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bolder" href="{{ route('employee') }}">Employee</a>
                        <span>
                            <a class="nav-link text-secondary" href="">X</a>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bolder" href="#">Reports</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bolder" href="#">Settings</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-12 col-lg-10 py-2" style="height: 100%;overflow:auto">
                <div class="position-relative w-100 d-flex justify-content-center">
                    @if(session('success'))
                        <div id="msgBox" class="text-center alert alert-success position-absolute w-50">
                            {{ session('success') }}
                        </div>
                    @elseif(session('danger'))
                        <div id="msgBox" class="text-center alert alert-danger position-absolute w-50">
                            {{ session('danger') }}
                        </div>
                    @endif
                </div>
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" style="background: transparent;">
                        @yield('breadcrumb')
                    </ol>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    @yield('jslink');
   </body>
</html>
