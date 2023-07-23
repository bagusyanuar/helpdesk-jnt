<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Helpdesk J&T Express</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<nav class="main-header navbar navbar-expand elevation-1">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link navbar-link-item" data-widget="pushmenu" href="#" role="button"><i
                    class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link navbar-link-item">Logout</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
{{--        <img src="{{ asset('/assets/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">--}}
        <span class="brand-text" style="font-size: 16px; font-weight: bold;">J&T Express</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/assets/user.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="font-size: 14px;">{{ auth()->user()->username }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">
                        <i class="fa fa-tachometer nav-icon" aria-hidden="true"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                    Master Data
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengguna') }}"
                       class="nav-link">
                        <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                    Ticket
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ticket.baru') }}"
                       class="nav-link">
                        <i class="fa fa-ticket nav-icon" aria-hidden="true"></i>
                        <p>Baru</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ticket.proses') }}"
                       class="nav-link">
                        <i class="fa fa-spinner nav-icon" aria-hidden="true"></i>
                        <p>Proses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ticket.closed') }}"
                       class="nav-link">
                        <i class="fa fa-power-off nav-icon" aria-hidden="true"></i>
                        <p>Tutup</p>
                    </a>
                </li>

                <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                    Laporan
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.report.ticket') }}"
                       class="nav-link">
                        <i class="fa fa-bar-chart nav-icon" aria-hidden="true"></i>
                        <p>Ticket</p>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.laporan.pendapatan') }}"--}}
{{--                       class="nav-link">--}}
{{--                        <i class="fa fa-money nav-icon" aria-hidden="true"></i>--}}
{{--                        <p>Pendapatan</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
    </div>
</aside>
<div class="content-wrapper p-3">
    @yield('content-title')
    @yield('content')
</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
@yield('js')
</body>
</html>
