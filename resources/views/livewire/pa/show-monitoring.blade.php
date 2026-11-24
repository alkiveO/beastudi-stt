<div>
    @section('title_dashboard', 'Detail Monitoring: ' . $mahasiswa->nama)

    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('pa.master-data') }}"
                       class="btn btn-light btn-sm me-2"
                       title="Kembali ke Master Data">
                        <i class="material-icons" style="vertical-align: middle;">
                            arrow_back
                        </i>
                    </a>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label text-dark">Semester</label>
                            <select class="form-control"
                                    wire:model="semester_select">
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-dark">Periode</label>
                            <select class="form-control"
                                    wire:model="periode_select">
                                <option value="">Pilih Periode</option>
                                @foreach($list_periode as $periode)
                                    <option value="{{ $periode->id }}">
                                        {{ $periode->nama }} | {{ $periode->jenis_semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @if($monitoring)
                    <div class="alert alert-light border small mx-3">
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

                @if($semester && $periode_id)
                    <form wire:submit.prevent="update">

                        {{-- DATA MONITORING --}}
                        <div class="card-header">
                            <h5 class="mb-0">Data Monitoring</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">
                                            Tanggal Isi
                                        </label>

                                        <input type="date"
                                               class="form-control"
                                               wire:model="tanggal_isi">

                                        @error('tanggal_isi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">NIM</label>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ $mahasiswa->nim }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">IPS</label>

                                        <input type="number"
                                               step="0.01"
                                               min="0"
                                               max="4"
                                               class="form-control"
                                               wire:model="ips">

                                        @error('ips')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">IPK</label>

                                        <input type="number"
                                               step="0.01"
                                               min="0"
                                               max="4"
                                               class="form-control"
                                               wire:model="ipk">

                                        @error('ipk')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">
                                            Pembimbing Akademik
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               value="{{ auth()->user()->pembimbingAkademik->nama ?? '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label text-dark">
                                            Kontribusi Khusus
                                        </label>

                                        <select class="form-control"
                                                wire:model="kontribusi_khusus_id">
                                            <option value="">Pilih Kontribusi</option>

                                            @foreach($kontribusi_khusus as $kontribusi)
                                                <option value="{{ $kontribusi->id }}">
                                                    {{ $kontribusi->nama }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('kontribusi_khusus_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- EVALUASI DAN RENCANA --}}
                        <div class="card-header">
                            <h5 class="mb-0">Evaluasi dan Rencana</h5>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label text-dark">
                                    Capaian Semester
                                </label>

                                <textarea class="form-control"
                                          rows="3"
                                          maxlength="500"
                                          style="resize:none;"
                                          wire:model="deskripsi_capaian"
                                          placeholder="Ceritakan capaian semester ini, maksimal 500 karakter"></textarea>

                                @error('deskripsi_capaian')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">
                                    Kendala Semester
                                </label>

                                <textarea class="form-control"
                                          rows="3"
                                          maxlength="500"
                                          style="resize:none;"
                                          wire:model="deskripsi_kendala"
                                          placeholder="Ceritakan kendala semester ini, maksimal 500 karakter"></textarea>

                                @error('deskripsi_kendala')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-dark">
                                    Rencana Semester Selanjutnya
                                </label>

                                <textarea class="form-control"
                                          rows="3"
                                          maxlength="500"
                                          style="resize:none;"
                                          wire:model="deskripsi_rencana"
                                          placeholder="Ceritakan rencana semester selanjutnya, maksimal 500 karakter"></textarea>

                                @error('deskripsi_rencana')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        {{-- PRESTASI --}}
                        <div class="card-header">
                            <h5 class="mb-0">Bukti Dokumen Prestasi</h5>
                        </div>

                        <div class="card-body">
                            @forelse($prestasi ?? [] as $item)
                                <div class="d-flex justify-content-between flex-wrap mb-3">
                                    <p class="text-dark mb-1">
                                        {{ $loop->iteration }}. {{ $item->nama }}
                                    </p>

                                    <p class="text-dark mb-1">
                                        {{ $item->kategori_prestasi->nama ?? '-' }}
                                    </p>

                                    <a href="{{ Storage::url($item->file) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="text-dark">
                                        Lihat Dokumen
                                    </a>
                                </div>
                            @empty
                                <p class="mb-0">
                                    Belum ada prestasi yang ditambahkan.
                                </p>
                            @endforelse
                        </div>

                        {{-- TOMBOL SIMPAN --}}
                        <div class="card-footer" style="border:none;">
                            <button type="submit"
                                    class="btn btn-primary"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="update">
                                    Simpan Monitoring
                                </span>

                                <span wire:loading wire:target="update">
                                    Menyimpan...
                                </span>
                            </button>
                        </div>

                    </form>
                @else
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            Silakan pilih semester dan periode untuk melihat atau mengisi data Monitoring.
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>