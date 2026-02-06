<div>
    {{-- 1. NOTIFIKASI GLOBAL (MUNCUL OTOMATIS JIKA ADA PEMANGGILAN) --}}
    @if(!empty($pemberitahuanGlobal))
        <div class="alert alert-danger shadow-lg mb-4" style="border-left: 8px solid #850000;">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fa fa-exclamation-circle fa-3x me-3 text-danger pulse-animation"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="alert-heading fw-bold">PANGGILAN PENTING!</h4>
                    <p class="mb-1">
                        Halo <strong>{{ auth()->guard('mahasiswa')->user()->nama }}</strong>, Anda memiliki status 
                        <span class="badge bg-white text-danger">{{ $pemberitahuanGlobal['jenis'] }}</span> pada 
                        Semester {{ $pemberitahuanGlobal['semester'] }} (T.A {{ $pemberitahuanGlobal['periode'] }}).
                    </p>
                    <hr class="my-2">
                    <p class="mb-0 text-dark"><strong>Pesan Admin:</strong> {{ $pemberitahuanGlobal['keterangan'] }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-start">
            <div>
                <h2 class="card-title">
                    Halo Mahasiswa Beastudi Nurul Fikri 🤗
                </h2>
                <div class="mt-1" style="font-size: 15px;">
                    <strong>NIM:</strong> {{ auth()->guard('mahasiswa')->user()->nim }} <br>
                    <strong>Email:</strong> {{ auth()->guard('mahasiswa')->user()->email }}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted">Filter Semester dan Periode untuk melihat detail status:</p>
                    
                    <div class="row">
                        <div class="col-sm-6 mt-2">
                            <div wire:ignore>
                                <select id="semester-select" class="default-select form-control wide" wire:model='semester'>
                                    <option value="">Pilih Semester</option>
                                    @foreach(range(1, 8) as $sem)
                                        <option value="{{ $sem }}">{{ $sem }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <div wire:ignore>
                                <select id="periode-select" class="default-select form-control wide" wire:model='periode_id'>
                                    <option value="">Pilih Periode</option>
                                    @foreach($list_periode as $periodeItem)
                                        <option value="{{ $periodeItem->id }}">{{ $periodeItem->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <h4 class="mb-3 border-bottom pb-2">Informasi Monitoring</h4>
                            
                            <p class="fs-5 text-black">
                                Status Monitoring: <br>
                                <span class="{{ $textTypeMonitoring }}">{{ $pesanMonitoring ?? 'Silahkan pilih filter' }}</span> 
                            </p>

                            <p class="fs-5 text-black">
                                Status Beastudi: <br>
                                <span class="{{ $textTypeBeastudi }}">
                                    {{ $pesanBeastudi ?? 'Silahkan pilih filter' }}
                                </span>
                            </p>

                            {{-- INFO EVALUASI/SP BERDASARKAN FILTER --}}
                            @if(!empty($jenisSp))
                                <div class="mt-3 p-2 border-top">
                                    @if($jenisSp === 'Pemanggilan')
                                        <div class="alert alert-danger shadow-sm">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            <strong>STATUS: PEMANGGILAN KHUSUS</strong>
                                            <p class="small mb-0 mt-1">{{ $keteranganEvaluasi }}</p>
                                        </div>
                                    @else
                                        <div class="text-danger fw-bold">Status SP: {{ $jenisSp }}</div>
                                        <div class="text-muted small">Ket: {{ $keteranganEvaluasi }}</div>
                                        <div class="mt-2">
                                            <a href="{{ route('mahasiswa.surat-peringatan', $monitoring->id) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-file-pdf"></i> Cetak Surat Evaluasi
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @livewire('mahasiswa-ipk-chart')
                </div>
            </div>
        </div>
    </div>

    <style>
        .pulse-animation {
            animation: pulse-red 2s infinite;
        }
        @keyframes pulse-red {
            0% { transform: scale(0.95); opacity: 0.7; }
            70% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.7; }
        }
        .border-left-decoration {
            border-left: 5px solid #850000 !important;
        }
    </style>

    @push('script')
        <script>
            // Inisialisasi ulang selectpicker jika menggunakan bootstrap-select
            $(document).ready(function() {
                $('.default-select').selectpicker();
            });

            $('#semester-select').on('changed.bs.select', function () {
                @this.set('semester', $(this).val());
            });

            $('#periode-select').on('changed.bs.select', function () {
                @this.set('periode_id', $(this).val());
            });
        </script>
    @endpush
</div>