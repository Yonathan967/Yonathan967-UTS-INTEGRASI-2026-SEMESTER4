<!-- Notifikasi Container -->
<div id="notification-container" class="notification-container">
    <!-- Notifikasi akan dimunculkan di sini -->
</div>

<script>
// Fungsi untuk menampilkan notifikasi
function showNotification(message, type = 'info', duration = 5000) {
    const container = document.getElementById('notification-container');
    if (!container) return;

    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-icon">
                ${getNotificationIcon(type)}
            </div>
            <div class="notification-message">
                ${message}
            </div>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    container.appendChild(notification);

    // Animasi masuk
    setTimeout(() => {
        notification.classList.add('notification-show');
    }, 100);

    // Auto remove
    if (duration > 0) {
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.remove('notification-show');
                setTimeout(() => notification.remove(), 300);
            }
        }, duration);
    }
}

function getNotificationIcon(type) {
    const icons = {
        'success': '<i class="fas fa-check-circle"></i>',
        'error': '<i class="fas fa-exclamation-circle"></i>',
        'warning': '<i class="fas fa-exclamation-triangle"></i>',
        'info': '<i class="fas fa-info-circle"></i>',
        'stok-warning': '<i class="fas fa-boxes"></i>',
        'stok-error': '<i class="fas fa-times-circle"></i>'
    };
    return icons[type] || icons['info'];
}

// Fungsi notifikasi khusus untuk stok
function showStokWarning(product, stokTersedia, stokDibutuhkan) {
    showNotification(
        `⚠️ Stok ${product} tidak mencukupi! Tersedia: ${stokTersedia}, Dibutuhkan: ${stokDibutuhkan}`,
        'stok-warning',
        8000
    );
}

function showStokError(product, message) {
    showNotification(
        `❌ ${message}`,
        'stok-error',
        10000
    );
}

function showSuccess(message) {
    showNotification(`✅ ${message}`, 'success', 4000);
}

function showError(message) {
    showNotification(`❌ ${message}`, 'error', 6000);
}

function showInfo(message) {
    showNotification(`ℹ️ ${message}`, 'info', 5000);
}

// Listener untuk notifikasi dari server
document.addEventListener('DOMContentLoaded', function() {
    // Cek notifikasi dari session flash
    @php
        $notifications = session()->get('notifications', []);
        if (!is_array($notifications)) {
            $notifications = [];
        }
    @endphp
    
    const notifications = @json($notifications);
    notifications.forEach(notification => {
        showNotification(notification.message, notification.type, notification.duration);
    });

    // Clear session notifications
    fetch('{{ route("clear-notifications") }}', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).catch(error => console.log('Session notifications cleared'));
});
</script>

<style>
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
}

.notification {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 10px;
    transform: translateX(100%);
    opacity: 0;
    transition: all 0.3s ease;
    border-left: 4px solid #3b82f6;
}

.notification-show {
    transform: translateX(0);
    opacity: 1;
}

.notification-content {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    gap: 12px;
}

.notification-icon {
    font-size: 20px;
    flex-shrink: 0;
}

.notification-message {
    flex: 1;
    font-size: 14px;
    line-height: 1.4;
}

.notification-close {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    color: #6b7280;
    padding: 4px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.notification-close:hover {
    background-color: #f3f4f6;
}

/* Notification types */
.notification-success {
    border-left-color: #10b981;
}

.notification-success .notification-icon {
    color: #10b981;
}

.notification-error {
    border-left-color: #ef4444;
}

.notification-error .notification-icon {
    color: #ef4444;
}

.notification-warning {
    border-left-color: #f59e0b;
}

.notification-warning .notification-icon {
    color: #f59e0b;
}

.notification-info {
    border-left-color: #3b82f6;
}

.notification-info .notification-icon {
    color: #3b82f6;
}

.notification-stok-warning {
    border-left-color: #f59e0b;
    background-color: #fef3c7;
}

.notification-stok-warning .notification-icon {
    color: #f59e0b;
}

.notification-stok-error {
    border-left-color: #ef4444;
    background-color: #fee2e2;
}

.notification-stok-error .notification-icon {
    color: #ef4444;
}

/* Mobile responsive */
@media (max-width: 640px) {
    .notification-container {
        left: 10px;
        right: 10px;
        max-width: none;
    }
    
    .notification-content {
        padding: 10px 12px;
    }
    
    .notification-message {
        font-size: 13px;
    }
}
</style>
