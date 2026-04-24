<div class="dashboard-card">
    <div class="card-icon">
        <i class="{{ $icon ?? 'fas fa-chart-line' }}"></i>
    </div>
    <div class="card-content">
        <h3 class="card-title">{{ $title }}</h3>
        <p class="card-value">{{ $value }}</p>
    </div>
    <div class="card-footer">
        <span class="card-trend">{{ $trend ?? 'normal' }}</span>
    </div>
</div>
