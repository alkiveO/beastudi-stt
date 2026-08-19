<div>
    <div class="card">
        <div class="card-body">
            {{-- ================= INFO PENGUMPULAN ================= --}}
            <div class="alert 
    {{ $isMonitoringActive ? 'alert-info' : 'alert-warning' }}
    d-flex justify-content-between align-items-center">

                <div>
                    @if($isMonitoringActive)
                    <i class="fa fa-lock-open me-1"></i>
                    @else
                    <i class="fa fa-lock me-1"></i>
                    @endif

                    {{ $statusMonitoringText }}

                    {{-- JAM & TANGGAL TUTUP --}}
                    @if($tanggalTutupMonitoring)
                    <div class="small text-muted mt-1">
                        <i class="fa fa-clock me-1"></i>
                        Ditutup pada <strong>{{ $tanggalTutupMonitoring }}</strong>
                    </div>
                    @endif
                </div>
            </div>

            @if(!$isDataDiriLengkap)
            <div class="alert alert-warning d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa fa-exclamation-triangle me-1"></i>
                    <strong>Lengkapi terlebih dahulu data diri anda</strong> sebelum mengisi Laporan Semester (LPJ/SPB).
                    @if(count($missingDataDiri) > 0)
                    <div class="small mt-1">
                        Field yang belum lengkap:
                        @foreach($missingDataDiri as $field)
                        <span class="badge badge-warning">{{ str_replace('_', ' ', $field) }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                <a href="{{ route('mahasiswa.data-diri') }}" class="btn btn-sm btn-warning">Lengkapi Data Diri</a>
            </div>
            @endif

            @if($isDataDiriLengkap)
            <div class="row">

                <div class="col-md-3">

                    <label class="form-label text-dark">Semester</label>
                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="semester-select" class="default-select form-control wide" wire:model.debounce.300="semester" {{ !$isMonitoringActive ? 'disabled' : '' }}>

                            <option hidden>Nothing Selected</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <div class="dropdown-menu">
                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-dark">Periode</label>

                    <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                        <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300="periode_id" {{ !$isMonitoringActive ? 'disabled' : '' }}>
                            <option hidden>Nothing Selected</option>
                            @foreach($list_periode as $periode)
                            <option value="{{ $periode->id }}">
                                {{ $periode->nama }} | {{ $periode->jenis_semester }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 🔔 INFO STATUS --}}
                    @if($semester && $periode_id)

                    @if($isMonitoringActive)
                    <small class="text-warning d-block mt-1">
                        <i class="fa fa-clock me-1"></i>
                        {{ $statusMonitoringText }}

                        @if($tanggalTutupMonitoring)
                        <br>
                        <span class="text-muted">
                            Ditutup pada {{ $tanggalTutupMonitoring }}
                        </span>
                        @endif
                    </small>
                    @else
                    <small class="text-danger d-block mt-1">
                        <i class="fa fa-lock me-1"></i>
                        {{ $statusMonitoringText }}
                    </small>
                    @endif


                </div>

                {{-- ================= INFO WAKTU INPUT ================= --}}
                @if($monitoring)
                <div class="alert alert-light border small mb-3">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div>
                            <i class="fa fa-calendar-plus me-1 text-success"></i>
                            <strong>Dibuat:</strong>
                            {{ $monitoring->created_at->translatedFormat('d F Y H:i') }}
                        </div>

                        <div>
                            <i class="fa fa-calendar-check me-1 text-primary"></i>
                            <strong>Terakhir Diperbarui:</strong>
                            {{ $monitoring->updated_at->translatedFormat('d F Y H:i') }}
                        </div>
                    </div>
                </div>
                @endif


                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data Diri</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="tanggal_isi" class="form-label text-dark input">
                                            Tanggal Isi
                                        </label>
                                        <input type="date" class="form-control" id="tanggal_isi" autocomplete="off" wire:model.debounce='tanggal_isi'>
                                        <span class="required">@error('tanggal_isi') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="nim" class="form-label text-dark">
                                            NIM
                                        </label>
                                        <input type="number" class="form-control" id="nim" autocomplete="off" wire:model.debounce='nim' disabled>
                                        <span class="required">@error('nim') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ips" class="form-label text-dark">
                                            IPS
                                        </label>
                                        <input type="text" class="form-control" id="ips" autocomplete="off" wire:model.debounce='ips' oninput="validateNumberInput(event)" maxlength="4">
                                        <span class="required">@error('ips') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ipk" class="form-label text-dark">
                                            IPK
                                        </label>
                                        <input type="text" class="form-control" id="ipk" autocomplete="off" wire:model.debounce='ipk' oninput="validateNumberInput(event)" maxlength="4">
                                        <span class="required">@error('ipk') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                {{-- ================= ALTERNATIF: STANDARD SELECT (PA) ================= --}}
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">Pembimbing Akademik</label>
                                        
                                        {{-- 
                                            SOLUSI STABIL: Menggunakan Standard Select HTML.
                                            Kita menambahkan class 'form-control' dan 'form-select' agar tampilannya rapi.
                                            Tidak menggunakan 'bootstrap-select' ataupun 'wire:ignore' disini.
                                        --}}
                                        <select class="form-control form-select" wire:model.debounce='pembimbing_akademik_id'>
                                            <option value="" selected hidden>Pilih Pembimbing</option>
                                            @foreach($pembimbing_akademik as $pa)
                                                <option value="{{ $pa->id }}">{{ $pa->nama }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <span class="required">@error('pembimbing_akademik_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                {{-- ================= ALTERNATIF: STANDARD SELECT (KONTRIBUSI) ================= --}}
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">Kontribusi Khusus</label>
                                        
                                        {{-- SOLUSI STABIL: Standard Select HTML --}}
                                        <select class="form-control form-select" wire:model.debounce='kontribusi_khusus_id'>
                                            <option value="" selected hidden>Pilih Kontribusi</option>
                                            @foreach($kontribusi_khusus as $kontribusi)
                                                <option value="{{ $kontribusi->id }}">{{ $kontribusi->nama }}</option>
                                            @endforeach
                                        </select>

                                        <span class="required">@error('kontribusi_khusus_id') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <h5 class="mb-0">Evaluasi dan Rencana</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deskripsi_capaian" class="form-label text-dark">
                                                Capaian Semester
                                            </label>
                                            <textarea class="form-control monitoring" id="deskripsi_capaian" autocomplete="off" wire:model.debounce='deskripsi_capaian' style="resize:none;" maxLength='500' placeholder="Ceritakan capaianmu di semester ini maks. 500 kata"></textarea>
                                            <span class="required">@error('deskripsi_capaian') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deskripsi_kendala" class="form-label text-dark">
                                                Kendala Semester
                                            </label>
                                            <textarea class="form-control monitoring" id="deskripsi_kendala" autocomplete="off" wire:model.debounce='deskripsi_kendala' style="resize:none;" maxLength='500' placeholder="Ceritakan kendalamu di semester ini maks. 500 kata"></textarea>
                                            <span class="required">@error('deskripsi_kendala') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deskripsi_rencana" class="form-label text-dark">
                                                Rencana Semester Selanjutnya
                                            </label>
                                            <textarea class="form-control monitoring" id="deskripsi_rencana" autocomplete="off" wire:model.debounce='deskripsi_rencana' style="resize:none;" maxLength='500' placeholder="Ceritakan rencanamu di semester depan maks. 500 kata"></textarea>
                                            <span class="required">@error('deskripsi_rencana') {{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <h5 class="mb-0">Unggah Bukti Dokumen</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5>Tambah kegiatan lomba atau prestasi</h5>
                                        <p>Tambahkan lomba bila mengikuti lebih dari satu lomba atau prestasi serta
                                            unggah sertifikat dalam bentuk file <strong>.PDF</strong>
                                        </p>

                                        @if(count($arrPrestasi) > 0)
                                        <h6>Daftar Prestasi</h6>

                                        @foreach($arrPrestasi as $item)
                                        <div class="d-flex justify-content-between">
                                            <p class="text-dark">{{ $loop->iteration }}. {{ $item->nama }}</p>
                                            <p class="text-dark">Kategori: {{ $item->kategori_prestasi->nama }}</p>
                                            <p><a href="{{ Storage::url($item->file) }}" target="_blank" class="text-dark">Lihat Dokumen</a></p>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        @foreach ($prestasi as $index => $item)
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-4 mb-2">
                                                <input type="text" class="form-control" placeholder="Lomba atau prestasi" wire:model.defer="prestasi.{{ $index }}.nama">
                                                @error('prestasi.' . $index . '.nama')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select class="form-control" wire:model.defer="prestasi.{{ $index }}.kategori_prestasi_id">
                                                    <option value="">Pilih Kategori Prestasi</option>
                                                    @foreach($kategori_prestasi as $kategoriPrestasiItem)
                                                    <option value="{{ $kategoriPrestasiItem->id }}">{{ $kategoriPrestasiItem->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- Input file prestasi juga diberi ID unik berdasarkan index --}}
                                                <input type="file" id="file_prestasi_{{$index}}" class="form-control" wire:model.defer="prestasi.{{ $index }}.file">
                                                @error('prestasi.' . $index . '.file')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <button class="btn btn-danger btn-sm" wire:click.prevent="hapusPrestasi({{ $index }})">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach

                                        <a href="" class="btn btn-sm btn-secondary" wire:click.prevent="tambahPrestasi">
                                            tambah kegiatan
                                        </a>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-7">
                                        <h5>Unggah Dokumen SPK dan LPJ</h5>
                                        <p>
                                            Pastikan dokumen SPK & LPJ diunggah dengan menggunakan aturan dokumen
                                            yang sesuai dan gambar pada dokumen tersebut harus jelas.
                                            Unggah dalam bentuk <strong>.PDF</strong> dengan ukuran maksimum 2MB
                                        </p>

                                        <h6>Dokumen yang telah di unggah</h6>

                                        {{-- ================= EXISTING: SPK ================= --}}
                                        @if($monitoring && $monitoring->file_spb)
                                        <div class="d-flex justify-content-between align-items-center" style="padding-right:30%;">
                                            <span class="text-dark">SPK</span>

                                            <div class="d-flex align-items-center gap-2">
                                                @if($status_file_spb == 'terima')
                                                <span class="badge bg-success">Diterima</span>
                                                @elseif($status_file_spb == 'tolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                                @endif

                                                <a href="{{ asset('storage/monitoring/file-spb/' . $monitoring->file_spb) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    Lihat
                                                </a>

                                                <a href="{{ asset('storage/monitoring/file-spb/' . $monitoring->file_spb) }}" download class="btn btn-sm btn-outline-success">
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                        @if($status_file_spb == 'tolak' && $keterangan_file_spb)
                                        <div class="alert alert-danger py-2 mt-1 small">
                                            Dokumen SPK ditolak. Keterangan: {{ $keterangan_file_spb }}
                                        </div>
                                        @endif
                                        @endif

                                        {{-- ================= EXISTING: LPJ ================= --}}
                                        @if($monitoring && $monitoring->file_lpj)
                                        <div class="d-flex justify-content-between align-items-center" style="padding-right:30%;">
                                            <span class="text-dark">LPJ</span>

                                            <div class="d-flex align-items-center gap-2">
                                                @if($status_file_lpj == 'terima')
                                                <span class="badge bg-success">Diterima</span>
                                                @elseif($status_file_lpj == 'tolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                                @endif

                                                <a href="{{ asset('storage/monitoring/file-lpj/' . $monitoring->file_lpj) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    Lihat
                                                </a>

                                                <a href="{{ asset('storage/monitoring/file-lpj/' . $monitoring->file_lpj) }}" download class="btn btn-sm btn-outline-success">
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                        @if($status_file_lpj == 'tolak' && $keterangan_file_lpj)
                                        <div class="alert alert-danger py-2 mt-1 small">
                                            Dokumen LPJ ditolak. Keterangan: {{ $keterangan_file_lpj }}
                                        </div>
                                        @endif
                                        @endif

                                        {{-- ================= TAMBAHAN: DOKUMEN DARI TABEL documents ================= --}}
                                        @if(isset($documents) && $documents->count())
                                        <hr>
                                        <h6>Dokumen Referensi</h6>

                                        @foreach($documents as $doc)
                                        <div class="d-flex justify-content-between align-items-center mb-2" style="padding-right:30%;">
                                            <span class="text-dark">
                                                {{ $doc->judul }}
                                            </span>

                                            <div class="d-flex gap-2">

                                                <a href="{{ Storage::url($doc->file) }}" download class="btn btn-sm btn-outline-success">
                                                    Download
                                                </a>

                                            </div>
                                        </div>
                                        @endforeach
                                        @endif

                                    </div>
                                </div>

                                {{-- ================= FIX: UPLOAD FILE MOBILE SUPPORT ================= --}}
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        @if($monitoring && $monitoring->file_spb)
                                        <label for="file_spb" class="form-label text-dark">Unggah dokumen SPK</label>
                                        @else
                                        <label for="file_spb" class="form-label text-dark">Unggah dokumen SPK <span class="text-danger">*</span></label>
                                        @endif
                                        
                                        {{-- ID UNIK --}}
                                        <input class="form-control" type="file" id="file_spb" wire:model='file_spb'>
                                        
                                        {{-- LOADING INDICATOR --}}
                                        <div wire:loading wire:target="file_spb" class="text-info small mt-1">
                                            <i class="fa fa-spinner fa-spin"></i> Sedang mengunggah...
                                        </div>
                                        <div class="text-danger">@error('file_spb') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="col-md-3">
                                        @if($status_file_lpj == 'tolak')
                                        <label for="file_lpj" class="form-label text-dark">Unggah dokumen LPJ</label>
                                        <div class="alert alert-danger py-2 mt-1 small">
                                            <i class="fa fa-ban me-1"></i>
                                            LPJ ditolak. Anda tidak dapat mengunggah kembali dokumen LPJ.
                                        </div>
                                        @else
                                            @if($monitoring && $monitoring->file_lpj)
                                            <label for="file_lpj" class="form-label text-dark">Unggah dokumen LPJ</label>
                                            @else
                                            <label for="file_lpj" class="form-label text-dark">Unggah dokumen LPJ <span class="text-danger">*</span></label>
                                            @endif
                                            
                                            {{-- ID UNIK --}}
                                            <input class="form-control" type="file" id="file_lpj" wire:model='file_lpj'>

                                            {{-- LOADING INDICATOR --}}
                                            <div wire:loading wire:target="file_lpj" class="text-info small mt-1">
                                                <i class="fa fa-spinner fa-spin"></i> Sedang mengunggah...
                                            </div>
                                            <div class="text-danger">@error('file_lpj') {{ $message }} @enderror</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer" style="border: none;">
                                <div>
                                    {{-- FIX: DISABLE TOMBOL SAAT LOADING --}}
                                    <button 
                                        class="btn btn-primary"
                                        wire:loading.attr="disabled"
                                        wire:target="file_spb, file_lpj, prestasi, store">
                                        
                                        <span wire:loading wire:target="file_spb, file_lpj, prestasi">
                                            <i class="fa fa-spinner fa-spin"></i> Loading...
                                        </span>
                                        <span wire:loading.remove wire:target="file_spb, file_lpj, prestasi">
                                            Simpan
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>
                @endif
            </div>
            @endif

            @push('script')
            <script>
                function validateNumberInput(event) {
                    const input = event.target;
                    let value = input.value;
                    value = value.replace(/[^0-9.]/g, '');
                    if (value.length > 4) {
                        value = value.slice(0, 2);
                    }
                    if (value.length === 2 && !value.endsWith('.')) {
                        value = value.charAt(0) + '.';
                    }
                    if (value.length === 1 && !value.match(/^\d$/)) {
                        value = '';
                    }
                    input.value = value;
                }

                // Kita bisa menghapus fungsi initSelectPicker yang kompleks 
                // karena kita sudah beralih ke Native Select untuk dropdown yang bermasalah.
                // Hanya sisakan untuk semester dan periode jika memang masih ingin pakai plugin disana.

                function initSelectPicker() {
                    $('.default-select').selectpicker('refresh');
                }

                document.addEventListener('livewire:load', function() {
                    initSelectPicker();
                });

                document.addEventListener('livewire:update', function() {
                    initSelectPicker();
                });

                $('#semester-select').on('changed.bs.select', function() {
                    var selectedSemester = $(this).val();
                    @this.set('semester_select', selectedSemester);
                });

                $('#periode-select').on('changed.bs.select', function() {
                    var selectedPeriode = $(this).val();
                    @this.set('periode_select', selectedPeriode);
                });
            </script>
            @endpush
        </div>