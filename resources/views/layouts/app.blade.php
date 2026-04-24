<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reece Farms</title>

    <link rel="stylesheet" href="{{ asset('dashboard/Sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/Topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/table.css') }}">
   <link rel="stylesheet" href="{{ asset('dashboard/dashboard_card.css') }}">
   <link rel="stylesheet" href="{{ asset('dashboard/dashboard.css') }}">
   <link rel="stylesheet" href="{{ asset('halaman_depan/css/HalamanDepan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donasiadmin.css') }}">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @stack('styles')
</head>
<body>

    @include('components/sidebar')
    @include('components/topbar')
    
    <!-- Notifikasi System -->
    @include('components.notifications')

    <main class="content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
