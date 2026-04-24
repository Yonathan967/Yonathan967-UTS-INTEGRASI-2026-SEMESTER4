@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/profile.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-photo-section">
            <div class="profile-photo">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
        </div>
        
        <div class="profile-info">
            <h2 class="profile-name">{{ $user->name }}</h2>
            <span class="profile-role">{{ ucfirst($user->role) }}</span>
        </div>
    </div>

    <div class="profile-body">
        <div class="profile-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Informasi Akun
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Role</div>
                        <div class="info-value">{{ ucfirst($user->role) }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Bergabung</div>
                        <div class="info-value">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <h3 class="section-title">
                <i class="fas fa-cog"></i>
                Pengaturan Profile
            </h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Nama Lengkap:
                        </label>
                        <input type="text" id="name" name="name" class="form-control" 
                               value="{{ $user->name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email:
                        </label>
                        <input type="email" id="email" name="email" class="form-control" 
                               value="{{ $user->email }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="photo">
                            <i class="fas fa-camera"></i>
                            Foto Profile:
                        </label>
                        <input type="file" id="photo" name="photo" class="form-control" 
                               accept="image/*">
                        <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
