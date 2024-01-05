<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <!-- Google Font: Source Sans Pro -->
    @include('partials.css')
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navbar -->
    @include('partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @if (session('success'))
            <div class="row mt-2">
                <div class="col-md-8 pl-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{session('success')}}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="row mt-2">
                <div class="col-md-8 pl-2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{session('error')}}
                    </div>
                </div>
            </div>
        @endif


        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    @include('partials.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('partials.js')
@stack('js')
</body>
</html>
