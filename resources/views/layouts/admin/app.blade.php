<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pembangunan Monitoring - Bina Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('asset-admin/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    @include('layouts.admin.css')

</head>

<body class="bg-dark text-light">
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Content Start -->
        <div class="content w-100">
            <!-- Navbar -->
            @include('layouts.admin.header')

            <!-- Main Content -->
            <div class="container-fluid pt-4 px-4" style="min-height: calc(100vh - 150px);">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="container-fluid pt-4 px-4 mt-auto">
                <div class="bg-secondary rounded-top p-3 text-center">
                    @include('layouts.admin..footer')
                </div>
            </div>
        </div>

            <i class="bi bi-arrow-up"></i>
        </a>
    </div>

    @include('layouts.admin.js')

</body>
</html>
