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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="d-flex">

        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <span>&#9776;</span>
        </button>

        <!-- Sidebar -->
        @include('Admin.layouts.sidebar')

        <!-- Overlay for mobile -->
        <div class="sidebar-overlay"></div>

        <div class="main-content">
            @include('Admin.layouts.header')

            <!-- Flash Messages -->
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

            <!-- Page Content -->
            @yield('content')
        </div>

    </div>

    @include('Admin.layouts.footer')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Datatable Init

         if (($("#example tbody tr").not(':has(td[colspan])').length > 0)) {
                $('#example').DataTable({
                    paging: true,
                    lengthChange: false,
                    searching: true,
                    ordering: true,
                    info: true,
                    language: {
                        search: "Search:",
                        searchPlaceholder: "",
                        emptyTable: "No data available in table"
                    },
                    dom: '<"d-flex align-items-center justify-content-start"f>t<"d-flex justify-content-between"ip>',
                     buttons: [
                        { extend: 'excelHtml5', text: 'Export Excel', className: 'btn btn-success' },
                        { extend: 'pdfHtml5', text: 'Export PDF', className: 'btn btn-danger' },
                        { extend: 'csvHtml5', text: 'Export CSV', className: 'btn btn-info' },
                        { extend: 'print', text: 'Print', className: 'btn btn-secondary' }
                    ]
                });
            }



            // Sidebar open
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').addClass('open');
                $('body').addClass('sidebar-open');
                $('.sidebar-overlay').show();
            });

            // Sidebar close (icon)
            $('.sidebar-close').on('click', function() {
                $('.sidebar').removeClass('open');
                $('body').removeClass('sidebar-open');
                $('.sidebar-overlay').hide();
            });

            // Sidebar close (overlay)
            $('.sidebar-overlay').on('click', function() {
                $('.sidebar').removeClass('open');
                $('body').removeClass('sidebar-open');
                $(this).hide();
            });

            // Auto dismiss flash messages after 3 seconds
            setTimeout(function() {
                $('.custom-alert').slideUp(500);
            }, 3000); // 3 seconds
        });
    </script>


</body>
</html>
