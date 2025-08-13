<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />


    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


    {{--  UI --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


    {{-- style --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    {{-- @stack('styles') --}}
</head>

<body>
    <div class="">

        <!-- Sidebar Toggle Button -->
        {{-- <button class="sidebar-toggle" id="sidebarToggle">
            <span>&#9776;</span>
        </button> --}}


        <!-- Sidebar -->



        <!-- Overlay for mobile -->
        <div class="sidebar-overlay"></div>

        @include('Admin.layouts.sub_header')

         <div class="container-fluid mt-3">
                @if (session('success'))
                    <div class="alert alert-success custom-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger custom-alert" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
        </div>

        @yield('content')

        @include('Admin.layouts.sub_footer')

    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <!-- jQuery (already included in your app, but ensure version >= 3.6) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

     <script>
        $(document).ready(function() {

            // Auto dismiss flash messages after 3 seconds
             setTimeout(function() {
                $('.custom-alert').slideUp(500);
            }, 3000); // 3 seconds
        });
    </script>

</body>

</html>
