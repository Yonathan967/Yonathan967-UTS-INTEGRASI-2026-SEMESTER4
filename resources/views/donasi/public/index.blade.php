<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi - TANI</title>

    <link rel="stylesheet" href="{{ asset('css/donation-public.css') }}">
    <style>
        .main-sidebar, .sidebar, aside, .app-sidebar { display: none !important; }
        body { margin: 0 !important; padding: 0 !important; background: #fff; }
        html { scroll-behavior: smooth; }

        /* ── Top Donor Hall of Fame ── */
        .dp-hof {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            padding: 48px 0;
            position: relative;
            overflow: hidden;
        }
        .dp-hof::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 50%, rgba(255,255,255,.06) 0%, transparent 60%);
        }
        .dp-hof__inner {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .dp-hof__head {
            text-align: center;
            margin-bottom: 32px;
        }
        .dp-hof__crown {
            font-size: 2rem;
            display: block;
            margin-bottom: 8px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-6px); }
        }
        .dp-hof__title {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 4px;
        }
        .dp-hof__sub {
            color: rgba(255,255,255,.65);
            font-size: .875rem;
        }

        /* Podium top 3 */
        .dp-hof__podium {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 16px;
            margin-bottom: 32px;
        }
        .dp-hof__pod {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            min-width: 140px;
        }
        .dp-hof__pod:hover {
            background: rgba(255,255,255,.12);
            transform: translateY(-2px);
        }
        .dp-hof__pod--1st {
            order: 2;
            transform: scale(1.1);
            background: rgba(255,215,0,.15);
            border-color: rgba(255,215,0,.3);
        }
        .dp-hof__pod--2nd {
            order: 1;
        }
        .dp-hof__pod--3rd {
            order: 3;
        }
        .dp-hof__pod-rank {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        .dp-hof__pod-avatar {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-weight: 800;
            color: #fff;
            font-size: 1.1rem;
        }
        .dp-hof__pod-name {
            color: #fff;
            font-weight: 700;
            margin-bottom: 4px;
            font-size: .9rem;
        }
        .dp-hof__pod-amount {
            color: #95d5b2;
            font-size: .8rem;
        }

        /* Ticker */
        .dp-hof__ticker-wrap {
            position: relative;
            overflow: hidden;
            background: rgba(0,0,0,.1);
            border-radius: 12px;
            padding: 12px 0;
        }
        .dp-hof__ticker {
            display: flex;
            animation: scroll 30s linear infinite;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .dp-hof__chip {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 20px;
            padding: 6px 12px;
            margin: 0 8px;
            white-space: nowrap;
        }
        .dp-hof__chip-avatar {
            width: 24px;
            height: 24px;
            background: rgba(255,255,255,.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .7rem;
            font-weight: 700;
            color: #fff;
        }
        .dp-hof__chip-name {
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
        }
        .dp-hof__chip-amount {
            color: #95d5b2;
            font-size: .75rem;
        }

        /* Button Styles */
        .dp-btn-primary {
            background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .dp-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 106, 79, 0.3);
            color: white;
            text-decoration: none;
        }

        .dp-btn-ghost {
            background: transparent;
            color: #2d6a4f;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 2px solid #2d6a4f;
            cursor: pointer;
        }

        .dp-btn-ghost:hover {
            background: #2d6a4f;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .dp-btn-light {
            background: white;
            color: #2d6a4f;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dp-btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: #2d6a4f;
            text-decoration: none;
        }

        /* Hero Actions */
        .dp-hero__actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        /* CTA Band */
        .dp-cta-band {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            border-radius: 20px;
            padding: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            margin: 64px 0;
        }

        .dp-cta-band__title {
            color: white;
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .dp-cta-band__sub {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .dp-cta-band {
                flex-direction: column;
                text-align: center;
                padding: 32px 24px;
            }

            .dp-hero__actions {
                flex-direction: column;
                align-items: center;
            }

            .dp-btn-primary,
            .dp-btn-ghost,
            .dp-btn-light {
                width: 100%;
                max-width: 280px;
            }
        }
    </style>
</head>

<body>
<div class="dp">

  {{-- NAV --}}
  <div class="dp-container">
    <nav class="dp-nav">
      <a href="#" class="dp-nav__brand">
        <div class="dp-nav__logo">🌱</div>
        <span class="dp-nav__name">TANI</span>
      </a>
      <div class="d-flex gap-2">
        <a href="{{ route('donasi.public.create') }}" class="dp-btn-primary" style="font-size:.82rem;padding:10px 20px">
          Donasi Sekarang →
        </a>
      </div>
    </nav>
  </div>

  {{-- HERO --}}
  <div class="dp-container">
    <div class="dp-hero">

      <div class="dp-hero__left">
        <div class="dp-hero__tag">Platform Donasi Pertanian</div>
        <h1 class="dp-hero__title">
          Bersama tumbuhkan<br>
          <em>ketahanan pangan</em><br>
          Indonesia
        </h1>
        <p class="dp-hero__sub">
          Setiap donasi Anda langsung menyentuh kehidupan petani lokal —
          dari bibit, pupuk organik, hingga alat pertanian modern.
        </p>
        <div class="dp-hero__actions">
          <a href="{{ route('donasi.public.create') }}" class="dp-btn-primary">
            ❤️ Mulai Donasi
          </a>
          
          <a href="#dampak" class="dp-btn-ghost">
            Lihat dampak ↓
          </a>
        </div>
      </div>

      <div class="dp-hero__visual">
        <div class="dp-hero__card">
          <div class="dp-hero__img">🌾</div>
          <div class="dp-hero__card-body">
            <div class="dp-hero__progress-label">
              Progress donasi bulan ini
            </div>

            <div class="dp-hero__progress-bar">
              <div class="dp-hero__progress-fill"
                   id="progressFill"
                   style="width: 0%">
              </div>
            </div>

            <div class="dp-hero__card-stat">
              <div>
                <div class="dp-hero__num" id="heroTotal">
                  Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                </div>
                <div class="dp-hero__lbl">terkumpul</div>
              </div>
              <div style="text-align:right">
          
                <div class="dp-hero__num">
                  Rp {{ number_format($targetDonasi ?? 500000, 0, ',', '.') }}
                </div>
                <div class="dp-hero__lbl">target</div>
              </div>
            </div>
          </div>
        </div>

        <div class="dp-hero__badge">
          👨‍🌾 <span id="heroDonatur">{{ $totalDonatur }}</span> donatur aktif
        </div>
      </div>

    </div>
  </div>

  {{-- STATS --}}
  <div class="dp-container">
    <div class="dp-stats">
      <div class="dp-stat">
        <span class="dp-stat__num" id="statDonatur">{{ $totalDonatur }}</span>
        <span class="dp-stat__lbl">Total Donatur</span>
      </div>
      <div class="dp-stat">
        <span class="dp-stat__num" id="statTotal">
          Rp {{ number_format($totalDonasi, 0, ',', '.') }}
        </span>
        <span class="dp-stat__lbl">Dana Terkumpul</span>
      </div>
      <div class="dp-stat">
        <span class="dp-stat__num">{{ $recentDonations->count() }}</span>
        <span class="dp-stat__lbl">Donasi Terbaru</span>
      </div>
    </div>
  </div>


  <div class="dp-hof" id="dampak">
    <div class="dp-hof__inner">

      <div class="dp-hof__head">
        <span class="dp-hof__crown">👑</span>
        <h2 class="dp-hof__title">Hall of Fame Donatur</h2>
        <p class="dp-hof__sub">Pahlawan ketahanan pangan Indonesia</p>
      </div>

      {{-- Podium Top 3 --}}
      @if($topDonatur->count() > 0)
      <div class="dp-hof__podium">

        {{-- 2nd place --}}
        @if($topDonatur->count() >= 2)
        <div class="dp-hof__pod dp-hof__pod--2nd">
          <div class="dp-hof__pod-rank">🥈</div>
          <div class="dp-hof__pod-avatar">
            {{ strtoupper(substr($topDonatur[1]->nama_donatur, 0, 1)) }}
          </div>
          <div class="dp-hof__pod-name">{{ $topDonatur[1]->nama_donatur }}</div>
          <div class="dp-hof__pod-amount">Rp {{ number_format($topDonatur[1]->total, 0, ',', '.') }}</div>
        </div>
        @endif

        {{-- 1st place --}}
        <div class="dp-hof__pod dp-hof__pod--1st">
          <div class="dp-hof__pod-rank">🥇</div>
          <div class="dp-hof__pod-avatar">
            {{ strtoupper(substr($topDonatur[0]->nama_donatur, 0, 1)) }}
          </div>
          <div class="dp-hof__pod-name">{{ $topDonatur[0]->nama_donatur }}</div>
          <div class="dp-hof__pod-amount">Rp {{ number_format($topDonatur[0]->total, 0, ',', '.') }}</div>
        </div>

        {{-- 3rd place --}}
        @if($topDonatur->count() >= 3)
        <div class="dp-hof__pod dp-hof__pod--3rd">
          <div class="dp-hof__pod-rank">🥉</div>
          <div class="dp-hof__pod-avatar">
            {{ strtoupper(substr($topDonatur[2]->nama_donatur, 0, 1)) }}
          </div>
          <div class="dp-hof__pod-name">{{ $topDonatur[2]->nama_donatur }}</div>
          <div class="dp-hof__pod-amount">Rp {{ number_format($topDonatur[2]->total, 0, ',', '.') }}</div>
        </div>
        @endif

      </div>
      @endif

      @if($allDonaturTicker->count() > 0)
      <div class="dp-hof__ticker-wrap">
        <div class="dp-hof__ticker" id="ticker">
          {{-- Duplikat untuk efek infinite --}}
          @foreach($allDonaturTicker as $d)
          <div class="dp-hof__chip">
            <div class="dp-hof__chip-avatar">{{ strtoupper(substr($d->nama_donatur, 0, 1)) }}</div>
            <span class="dp-hof__chip-name">{{ $d->nama_donatur }}</span>
            <span class="dp-hof__chip-amount">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</span>
          </div>
          @endforeach
        
          @foreach($allDonaturTicker as $d)
          <div class="dp-hof__chip">
            <div class="dp-hof__chip-avatar">{{ strtoupper(substr($d->nama_donatur, 0, 1)) }}</div>
            <span class="dp-hof__chip-name">{{ $d->nama_donatur }}</span>
            <span class="dp-hof__chip-amount">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</span>
          </div>
          @endforeach
        </div>
      </div>
      @endif

    </div>
  </div>

  {{-- DONATUR TERBARU --}}
  <div class="dp-container">
    <section class="dp-section">
      <div class="dp-section__head">
        <div class="dp-section__eyebrow">Komunitas Donatur</div>
        <h2 class="dp-section__title">Donasi Terbaru</h2>
      </div>

      <div class="dp-donors-grid" id="donorGrid">
        @forelse($recentDonations as $d)
        <div class="dp-donor-card">
          <div class="dp-donor-card__avatar">
            {{ strtoupper(substr($d->nama_donatur, 0, 1)) }}
          </div>
          <div>
            <div class="dp-donor-card__name">{{ $d->nama_donatur }}</div>
            <div class="dp-donor-card__row">
              <span class="dp-donor-card__amount">
                Rp {{ number_format($d->jumlah, 0, ',', '.') }}
              </span>
              <span class="dp-donor-card__sep">·</span>
              <span class="dp-donor-card__date">
                {{ $d->created_at->diffForHumans() }}
              </span>
            </div>
            @if($d->pesan)
            <div class="dp-donor-card__msg">"{{ $d->pesan }}"</div>
            @endif
          </div>
        </div>
        @empty
        <p style="text-align:center;color:#6c757d">Belum ada donasi. Jadilah yang pertama! 🌱</p>
        @endforelse
      </div>
    </section>
  </div>

  {{-- CTA --}}
  <div class="dp-container">
    <div class="dp-cta-band">
      <div>
        <h2 class="dp-cta-band__title">Siap membantu petani Indonesia?</h2>
        <p class="dp-cta-band__sub">
          Donasi mulai dari Rp 10.000 — sekecil apapun berarti besar.
        </p>
      </div>
      <a href="{{ route('donasi.public.create') }}" class="dp-btn-light">
        Donasi Sekarang →
      </a>
    </div>
  </div>

</div>

<script>
  
  const targetDonasi = {{ $targetDonasi ?? 500000 }};
  const totalDonasi  = {{ $totalDonasi }};
  const progressPct  = totalDonasi > 0 ? Math.min((totalDonasi / targetDonasi) * 100, 100) : 0;


  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('progressFill').style.width = progressPct + '%';
    }, 400);
  });

 
  function formatRupiah(n) {
    return 'Rp ' + parseInt(n).toLocaleString('id-ID');
  }

  function refreshStats() {
    console.log('Refreshing stats...');
    
    fetch('/api/donasi/stats')
      .then(r => {
        console.log('Stats API response status:', r.status);
        return r.json();
      })
      .then(data => {
        console.log('Stats data received:', data);
        
        // Untuk update angka stats
        document.getElementById('statDonatur').textContent = data.total_donatur;
        document.getElementById('statTotal').textContent   = formatRupiah(data.total_donasi);
        document.getElementById('heroDonatur').textContent = data.total_donatur;
        document.getElementById('heroTotal').textContent   = formatRupiah(data.total_donasi);

        // Update progress bar
        const newPct = data.total_donasi > 0
          ? Math.min((data.total_donasi / targetDonasi) * 100, 100)
          : 0;
        document.getElementById('progressFill').style.width = newPct + '%';
        
        console.log('Stats updated successfully');
      })
      .catch(error => {
        console.error('Error refreshing stats:', error);
      });
  }

  // Update donor grid menggunakan API endpoint ─
  function refreshDonorGrid() {
    console.log('Refreshing donor grid...');
    
    fetch('/api/donasi/donors')
      .then(response => {
        console.log('Donor API response status:', response.status);
        return response.json();
      })
      .then(data => {
        console.log('Donor data received:', data);
        
        if (data.success && data.donors) {
          const currentGrid = document.querySelector('#donorGrid');
          if (currentGrid) {
            console.log('Updating donor grid with', data.donors.length, 'donors');
            
          
            currentGrid.innerHTML = '';
            
            if (data.donors.length === 0) {
              currentGrid.innerHTML = '<p style="text-align:center;color:#6c757d">Belum ada donasi. Jadilah yang pertama! 🌱</p>';
            } else {
              
              data.donors.forEach((donor, index) => {
                const donorCard = document.createElement('div');
                donorCard.className = 'dp-donor-card';
                donorCard.style.animation = `slideInUp 0.5s ease ${index * 0.1}s both`;
                
                donorCard.innerHTML = `
                  <div class="dp-donor-card__avatar">${donor.avatar}</div>
                  <div>
                    <div class="dp-donor-card__name">${donor.nama_donatur}</div>
                    <div class="dp-donor-card__row">
                      <span class="dp-donor-card__amount">Rp ${donor.jumlah.toLocaleString('id-ID')}</span>
                      <span class="dp-donor-card__sep">·</span>
                      <span class="dp-donor-card__date">${donor.created_at}</span>
                    </div>
                    ${donor.pesan ? `<div class="dp-donor-card__msg">"${donor.pesan}"</div>` : ''}
                  </div>
                `;
                
                currentGrid.appendChild(donorCard);
              });
            }
            
            console.log('Donor grid updated successfully');
          }
        } else {
          console.error('Invalid donor data format:', data);
        }
      })
      .catch(error => {
        console.error('Error refreshing donor grid:', error);
      });
  }


  function refreshAll() {
    refreshStats();
    refreshDonorGrid();
  }

  setInterval(refreshAll, 30000);

  document.addEventListener('visibilitychange', () => {
    if (!document.hidden) refreshAll();
  });

  let clickCount = 0;
  document.addEventListener('click', () => {
    clickCount++;
    if (clickCount >= 3) {
      console.log('Manual refresh triggered!');
      refreshAll();
      clickCount = 0;
    }
    setTimeout(() => { clickCount = 0; }, 2000);
  });

  
  setTimeout(() => {
    console.log('Initial refresh triggered...');
    refreshAll();
  }, 2000);

  
  window.addEventListener('message', (event) => {
    if (event.data.type === 'donation_success') {
      console.log('Received donation success update:', event.data.stats);
      
      // Update stats immediately
      document.getElementById('statDonatur').textContent = event.data.stats.total_donatur;
      document.getElementById('statTotal').textContent   = formatRupiah(event.data.stats.total_donasi);
      document.getElementById('heroDonatur').textContent = event.data.stats.total_donatur;
      document.getElementById('heroTotal').textContent   = formatRupiah(event.data.stats.total_donasi);

      // Update progress bar
      const newPct = event.data.stats.total_donasi > 0
        ? Math.min((event.data.stats.total_donasi / targetDonasi) * 100, 100)
        : 0;
      document.getElementById('progressFill').style.width = newPct + '%';

      
      refreshDonorGrid();
    }
  });

  //  CSS animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  `;
  document.head.appendChild(style);
</script>

</body>
</html>
