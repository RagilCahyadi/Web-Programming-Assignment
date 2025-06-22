<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- @yield untuk data dinamis dan dihubungkan ke title views lain --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSRF token untuk keamanan form --}}    <style>
        /* Sticky Footer Layout */
        html {
            height: 100%;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        
        .main-content {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        .footer-sticky {
            flex-shrink: 0;
            margin-top: auto;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        
        /* Pastikan container menggunakan semua ruang yang tersedia */
        .container {
            flex: 1;
        }
        
        /* Wrapper untuk konten agar bisa expand */
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }
        
        /* Pastikan halaman pendek juga memiliki footer di bawah */
        @media (max-height: 600px) {
            .footer-sticky {
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <div class="main-content">
        <div class="container">
            @yield('content')
            {{-- @yield untuk data dinamis dan dihubungkan ke isi konten views lain --}}
        </div>
    </div>

    <!-- jQuery AJAX-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
