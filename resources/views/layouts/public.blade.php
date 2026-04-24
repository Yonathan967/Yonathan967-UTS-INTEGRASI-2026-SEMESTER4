<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reece Farm')</title>
    
    <link rel="stylesheet" href="{{ asset('halaman_depan/css/HalamanDepan.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @stack('styles')
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="{{ asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="Background">
            <img src="{{ asset('halaman_depan/images/icons/logo_reece.ico') }}" class="logo" alt="Logo Reece Farm">
        </div>

        <div class="right-side">
            <div class="public-header">
                <a href="/" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h1 class="title">Reece Farm</h1>
            </div>
            
            <main class="public-content">
                @yield('content')
            </main>
        </div>
    </div>

    <style>
    .public-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        text-decoration: none;
        margin-bottom: 20px;
        font-weight: 500;
        transition: color 0.3s;
    }
    
    .btn-back:hover {
        color: #28a745;
    }
    
    .public-content {
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .donation-form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .form-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .form-header h2 {
        margin: 0 0 10px 0;
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .form-header p {
        margin: 0;
        opacity: 0.9;
    }
    
    .form-section {
        padding: 30px;
    }
    
    .form-section h4 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }
    
    .required {
        color: #dc3545;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        font-size: 16px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
    
    /* Override for donation pages */
.donation-page-enhanced,
.donation-page {
    width: 100vw !important;
    max-width: none !important;
    margin: 0 -20px !important;
    padding: 0 !important;
}

.donation-page-enhanced .container,
.donation-page .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

@media (max-width: 768px) {
        .public-content {
            padding: 0 10px;
        }
        
        .form-section {
            padding: 20px;
        }
        
        .donation-page-enhanced,
        .donation-page {
            margin: 0 -10px !important;
        }
    }
    </style>
    
    @stack('scripts')
</body>
</html>
