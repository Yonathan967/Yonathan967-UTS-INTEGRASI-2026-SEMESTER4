<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reece Farm</title>

    <link rel="stylesheet" href="{{ asset('halaman_login/css/Login.css') }}">
    
</head>
<body>

<div class="container">

   
    <div class="left-side">
        <img src="{{ asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="">
        <img src="{{ asset('halaman_depan/images/icons/logo_reece.ico') }}" class="logo" alt="">
    </div>

    
    <div class="right-side">

        <h1 class="title">MASUK</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    {{ $item }} 
                @endforeach
            </ul>
        </div>
    @endif

       <form action="{{ route('auth.login') }}" method="POST">

    @csrf

    <div class="input-group">
        <input type="text" name="username" value="{{ old('username') }}" placeholder="Nama Pengguna" required>
    </div>

    <div class="input-group">
        <input type="password" name="password" placeholder="Kata Sandi" required>
    </div>
<div class="btn-wrapper">
    <button type="submit" class="btn-masuk">Masuk</button>

    
</form>


        
        

    </div>

</div>

</body>
</html>
