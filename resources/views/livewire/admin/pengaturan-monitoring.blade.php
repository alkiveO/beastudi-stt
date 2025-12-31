<div class="card">
    <div class="card-body text-center">
        <h4>Status Pengumpulan Laporan</h4>

        @if($is_active)
            <span class="badge bg-success mb-3">AKTIF</span>
        @else
            <span class="badge bg-danger mb-3">DITUTUP</span>
        @endif

        <div class="mt-3">
            <button wire:click="toggle"
                class="btn {{ $is_active ? 'btn-danger' : 'btn-success' }}">
                {{ $is_active ? 'Tutup Pengumpulan' : 'Buka Pengumpulan' }}
            </button>
        </div>
    </div>
</div>
