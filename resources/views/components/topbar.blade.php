
<img src="{{ Auth::user()->photo 
    ? asset('storage/' . Auth::user()->photo) 
    : asset('img/default-user.png') }}">


<div class="topbar">
    <div class="topbar-left">
        <h4>Selamat datang di Reece farm {{ Auth::user()->name }}</h4>
    </div>

    <div class="topbar-right">
        <button class="icon-btn">
            <i class="fa-solid fa-gear"></i>
        </button>

        <div class="user-info">
            <img src="/img/user.png" alt="User">

            <div>
                <span class="name">
                    {{ Auth::user()->name }}
                </span>
                <small class="role">
                    {{ ucfirst(Auth::user()->role) }}
                </small>
            </div>
        </div>
    </div>
</div>
