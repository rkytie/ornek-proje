@if(Auth::user()->permission != 1)
    @php
        header("Location: " . URL::to('/'), true, 302);
        exit();
    @endphp

@endif

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> @yield('title') | Fonstersida Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-light.png') }}" type="image/x-icon">

    @yield('css')
    <!-- App favicon -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    <!-- Custom Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>


<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div id="loading">
            <img id="loading-image" width="100" height="100" src="{{asset('assets/images/loading.gif')}}" alt="Loading..." />
        </div>

        @include('includes.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('includes.left-sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('includes.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @include('includes.script')

    @yield('script')
</body>

</html>
