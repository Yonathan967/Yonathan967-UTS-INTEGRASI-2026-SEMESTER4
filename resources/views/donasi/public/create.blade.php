<link rel="stylesheet" href="{{ asset('css/donation-public.css') }}">

{{-- Midtrans Snap.js — selalu load di halaman create --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<div class="dp-form-page">

  {{-- ══ LEFT PANEL ══ --}}
  <div class="dp-form-left">

    <div class="dp-form-left__top">

   
      {{-- Headline --}}
      <h2 class="dp-form-left__title">
        Setiap rupiah<br>
        <em>menumbuhkan</em><br>
        harapan
      </h2>
      <p class="dp-form-left__desc">
        Donasi Anda langsung mendukung petani lokal Indonesia 
        dengan kebutuhan nyata di lapangan.
      </p>

      {{-- Impact strips --}}
      <div class="dp-form-impacts" id="impactStrips">
        <div class="dp-form-impact-item" data-min="10000" data-max="24999">
          <span class="dp-form-impact-item__icon">🌱</span>
          <span class="dp-form-impact-item__text">1 bibit sayuran unggul siap tanam</span>
          <span class="dp-form-impact-item__tag">Rp 10K</span>
        </div>
        <div class="dp-form-impact-item" data-min="25000" data-max="49999">
          <span class="dp-form-impact-item__icon">🌿</span>
          <span class="dp-form-impact-item__text">3 bibit organik untuk satu bedengan</span>
          <span class="dp-form-impact-item__tag">Rp 25K</span>
        </div>
        <div class="dp-form-impact-item active-impact" data-min="50000" data-max="99999">
          <span class="dp-form-impact-item__icon">🌾</span>
          <span class="dp-form-impact-item__text">5 bibit + satu karung pupuk organik</span>
          <span class="dp-form-impact-item__tag">Rp 50K</span>
        </div>
        <div class="dp-form-impact-item" data-min="100000" data-max="249999">
          <span class="dp-form-impact-item__icon">🚜</span>
          <span class="dp-form-impact-item__text">10 bibit + alat berkebun dasar</span>
          <span class="dp-form-impact-item__tag">Rp 100K</span>
        </div>
        <div class="dp-form-impact-item" data-min="250000" data-max="9999999">
          <span class="dp-form-impact-item__icon">👨‍🌾</span>
          <span class="dp-form-impact-item__text">Dukungan penuh satu petani kecil</span>
          <span class="dp-form-impact-item__tag">Rp 250K+</span>
        </div>
      </div>
    </div>

    {{-- Testimonial --}}
    <div class="dp-form-left__bottom">
      <div class="dp-form-testimonial">
        <p class="dp-form-testimonial__quote">
          "Dengan bantuan dari program TANI, saya bisa membeli bibit unggul 
          dan hasil panen saya meningkat hampir dua kali lipat musim ini."
        </p>
        <div class="dp-form-testimonial__author">
          <div class="dp-form-testimonial__avatar">🧑‍🌾</div>
          <div>
            <div class="dp-form-testimonial__name">Bapak Suharto</div>
            <div class="dp-form-testimonial__role">Petani, Jawa Tengah</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ══ RIGHT PANEL (FORM) ══ --}}
  <div class="dp-form-right">
    <div class="dp-form-right__inner">

      {{-- Step indicator --}}
      <div class="dp-form-step">
        <div class="dp-form-step__item active">
          <div class="dp-form-step__num">1</div>
          <span>Info Donatur</span>
        </div>
        <div class="dp-form-step__sep"></div>
        <div class="dp-form-step__item active">
          <div class="dp-form-step__num">2</div>
          <span>Nominal</span>
        </div>
        <div class="dp-form-step__sep"></div>
        <div class="dp-form-step__item">
          <div class="dp-form-step__num">3</div>
          <span>Pembayaran</span>
        </div>
      </div>

      <h1 class="dp-form-title">Form Donasi</h1>
      <p class="dp-form-subtitle">Isi detail berikut untuk melanjutkan donasi Anda</p>

      {{-- Alert error --}}
      <div id="alertError" class="dp-alert-error"></div>

      {{-- [FIXED] Form tidak pakai action/method biasa lagi, submit ditangani AJAX --}}
      <form id="donationForm">
        @csrf

        {{-- ── Informasi Donatur ── --}}
        <div class="dp-field-group">
          <label class="dp-field-label">Nama Lengkap *</label>
          <input type="text"
                 class="dp-input"
                 name="nama_donatur"
                 placeholder="Masukkan nama lengkap Anda"
                 required
                 value="{{ old('nama_donatur') }}">
        </div>

        <div class="dp-input-row dp-input-row--form">
          <div class="dp-field-group dp-field-group--no-mb">
            <label class="dp-field-label">Email</label>
            <input type="email"
                   class="dp-input"
                   name="email"
                   placeholder="nama@email.com"
                   value="{{ old('email') }}">
          </div>
          <div class="dp-field-group dp-field-group--no-mb">
            <label class="dp-field-label">No HP</label>
            <input type="text"
                   class="dp-input"
                   name="phone"
                   placeholder="08xxxxxxxxxx"
                   value="{{ old('phone') }}">
          </div>
        </div>

        {{-- ── Nominal ── --}}
        <div class="dp-field-group">
          <label class="dp-field-label">Pilih Nominal</label>
          <div class="dp-amount-grid">
            <button type="button" class="dp-amount-btn" data-amount="10000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 10.000</span>
              <span class="dp-amount-btn__desc">1 bibit</span>
            </button>
            <button type="button" class="dp-amount-btn" data-amount="25000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 25.000</span>
              <span class="dp-amount-btn__desc">3 bibit</span>
            </button>
            <button type="button" class="dp-amount-btn active" data-amount="50000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 50.000</span>
              <span class="dp-amount-btn__desc">Bibit + pupuk</span>
            </button>
            <button type="button" class="dp-amount-btn" data-amount="100000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 100.000</span>
              <span class="dp-amount-btn__desc">+ alat</span>
            </button>
            <button type="button" class="dp-amount-btn" data-amount="250000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 250.000</span>
              <span class="dp-amount-btn__desc">Support petani</span>
            </button>
            <button type="button" class="dp-amount-btn" data-amount="500000">
              <span class="dp-amount-btn__check">✓</span>
              <span class="dp-amount-btn__val">Rp 500.000</span>
              <span class="dp-amount-btn__desc">Full support</span>
            </button>
          </div>

          <div class="dp-custom-wrap">
            <span class="dp-custom-prefix">Rp</span>
            <input type="number"
                   class="dp-input dp-input--custom"
                   id="customAmount"
                   name="jumlah"
                   placeholder="Nominal lainnya"
                   min="1000"
                   step="1000"
                   value="{{ old('jumlah', 50000) }}">
          </div>
          <p class="dp-field-hint">Minimal donasi Rp 1.000</p>
        </div>

        {{-- ── Impact Preview ── --}}
        <div class="dp-impact-display" id="impactPreview">
          <span class="dp-impact-display__icon">🌾</span>
          <span class="dp-impact-display__text" id="impactText">
            Rp 50.000 = 5 bibit sayuran + 1 karung pupuk organik
          </span>
        </div>

        {{-- ── Metode Pembayaran ── --}}
        <div class="dp-field-group">
          <label class="dp-field-label">Metode Pembayaran *</label>
          <input type="hidden" name="metode_pembayaran" id="paymentMethod" value="">
          <div class="dp-pay-grid" id="payGrid">
            <button type="button" class="dp-pay-btn" data-value="transfer">
              <span class="dp-pay-btn__icon">🏦</span>
              Transfer Bank
            </button>
            <button type="button" class="dp-pay-btn" data-value="ewallet">
              <span class="dp-pay-btn__icon">📱</span>
              E-Wallet
            </button>
            <button type="button" class="dp-pay-btn" data-value="qris">
              <span class="dp-pay-btn__icon">⬛</span>
              QRIS
            </button>
            <button type="button" class="dp-pay-btn" data-value="credit_card">
              <span class="dp-pay-btn__icon">💳</span>
              Kartu Kredit
            </button>
          </div>
        </div>

        {{-- ── Pesan ── --}}
        <div class="dp-field-group">
          <label class="dp-field-label">Pesan <span class="dp-field-label__opt">(opsional)</span></label>
          <textarea class="dp-input dp-input--textarea"
                    name="pesan"
                    placeholder="Tulis pesan semangat untuk para petani..."
                    rows="3">{{ old('pesan') }}</textarea>
        </div>

        {{-- ── Submit ── --}}
        <button type="submit" class="dp-submit" id="submitBtn">
          ❤️ Donasi Sekarang
        </button>
      </form>

      <a href="{{ route('donasi.public.index') }}" class="dp-form-back">← Kembali ke halaman donasi</a>
      <p class="dp-form-note">🔒 Data Anda aman dan terenkripsi</p>

    </div>
  </div>

</div>

<script>
  // ── Amount buttons ──
  const amountBtns   = document.querySelectorAll('.dp-amount-btn');
  const customInput  = document.getElementById('customAmount');
  const impactText   = document.getElementById('impactText');
  const impactStrips = document.querySelectorAll('.dp-form-impact-item');

  const impacts = {
    10000:  'Rp 10.000 = 1 bibit sayuran organik siap tanam',
    25000:  'Rp 25.000 = 3 bibit sayuran untuk satu bedengan',
    50000:  'Rp 50.000 = 5 bibit sayuran + 1 karung pupuk organik',
    100000: 'Rp 100.000 = 10 bibit + satu set alat berkebun dasar',
    250000: 'Rp 250.000 = Dukungan penuh 1 petani kecil',
    500000: 'Rp 500.000 = Support lengkap 1 petani satu musim panen',
  };

  function formatRupiah(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
  }

  function updateImpact(amount) {
    let msg = impacts[amount];
    if (!msg) {
      const bibit = Math.max(1, Math.floor(amount / 10000));
      msg = formatRupiah(amount) + ' = ' + bibit + ' bibit sayuran organik';
    }
    impactText.textContent = msg;

    // Highlight matching strip
    impactStrips.forEach(strip => {
      const min = parseInt(strip.dataset.min);
      const max = parseInt(strip.dataset.max);
      strip.classList.toggle('active-impact', amount >= min && amount <= max);
    });

    // Auto-scroll to impact section
    const impactSection = document.querySelector('.dp-form-impacts');
    if (impactSection) {
      setTimeout(() => {
        impactSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }, 300);
    }
  }

  amountBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      amountBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      customInput.value = btn.dataset.amount;
      updateImpact(parseInt(btn.dataset.amount));
    });
  });

  customInput.addEventListener('input', () => {
    const val = parseInt(customInput.value) || 0;
    if (val >= 1000) {
      amountBtns.forEach(b => {
        b.classList.toggle('active', parseInt(b.dataset.amount) === val);
      });
      updateImpact(val);
    }
  });

  // ── Payment method ──
  const payBtns  = document.querySelectorAll('.dp-pay-btn');
  const payInput = document.getElementById('paymentMethod');
  const payGrid  = document.getElementById('payGrid');

  payBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      payBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      payInput.value = btn.dataset.value;
      payGrid.style.outline = ''; // hilangkan error highlight
    });
  });

  // ── [FIXED] Form submit via AJAX → dapat snap_token → panggil snap.pay() ──
  document.getElementById('donationForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const alertBox  = document.getElementById('alertError');
    const submitBtn = document.getElementById('submitBtn');

    // Validasi metode pembayaran
    if (!payInput.value) {
      payGrid.style.outline      = '2px solid #dc3545';
      payGrid.style.borderRadius = '12px';
      payGrid.scrollIntoView({ behavior: 'smooth', block: 'center' });
      setTimeout(() => { payGrid.style.outline = ''; }, 2000);
      return;
    }

    // Tampilkan loading
    submitBtn.disabled     = true;
    submitBtn.textContent  = '⏳ Memproses...';
    alertBox.style.display = 'none';

    // Kumpulkan data form
    const formData = new FormData(this);

    try {
      const response = await fetch('{{ route("donasi.public.store") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
          'Accept': 'application/json',
        },
        body: formData,
      });

      const data = await response.json();

      if (!response.ok || !data.success) {
        throw new Error(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
      }

      // [FIXED] Panggil Midtrans Snap popup dengan token yang baru didapat
      // Fix untuk ngrok - tambahkan environment check
      const isNgrok = window.location.hostname.includes('ngrok');
      
      window.snap.pay(data.snap_token, {
        onSuccess: function(result){
        console.log('Payment Success:', result);
        
        // Update stats in real-time before redirect
        fetch('/api/donasi/stats')
          .then(response => response.json())
          .then(data => {
            console.log('Stats updated:', data);
            
            // Update parent window stats if this is a popup
            if (window.opener) {
              window.opener.postMessage({
                type: 'donation_success',
                stats: data
              }, '*');
            }
          })
          .catch(error => console.log('Error updating stats:', error));
        
        // Redirect to success page after a short delay
        setTimeout(() => {
          window.location.href = '{{ route("donasi.public.success") }}';
        }, 1000);
      },
        onPending: function(result) {
          console.log('Payment pending:', result);
          window.location.href = data.redirect.pending;
        },
        onError: function(result) {
          console.log('Payment error:', result);
          window.location.href = data.redirect.error;
        },
        onClose: function() {
          // User menutup popup tanpa bayar
          submitBtn.disabled    = false;
          submitBtn.textContent = 'Donasi Sekarang';
          alertBox.style.display = 'block';
          alertBox.textContent   = 'Pembayaran dibatalkan. Klik tombol lagi untuk melanjutkan.';
        }
      });

    } catch (err) {
      alertBox.style.display = 'block';
      alertBox.textContent   = '' + err.message;
      submitBtn.disabled     = false;
      submitBtn.textContent  = ' Donasi Sekarang';
    }
  });

  // Init
  updateImpact(50000);
</script>