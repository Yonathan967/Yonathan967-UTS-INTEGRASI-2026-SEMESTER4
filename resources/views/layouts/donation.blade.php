<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reece Farm - Donasi Pertanian')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('halaman_depan/css/HalamanDepan.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="{{ asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="Background">
            <img src="{{ asset('halaman_depan/images/icons/logo_reece.ico') }}" class="logo" alt="Logo Reece Farm">
        </div>

        <div class="right-side">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>