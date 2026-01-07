<div>
    <form wire:submit.prevent="store">
        <div class="card">
            <div class="card-body">

                {{-- Pilih Jenis --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Pilih Publish Redaksi</label>
                            <div wire:ignore>
                                <select class="form-control" wire:model="jenis">
                                    <option hidden>Nothing Selected</option>
                                    <option value="login page mahasiswa">Login Page Mahasiswa</option>
                                    <option value="login spb mahasiswa">Login SPB Mahasiswa</option>
                                </select>
                            </div>
                            @error('jenis') <span class="required">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 custom-form">
                            <label class="form-label text-dark">Judul Redaksi</label>
                            <input type="text" class="form-control" wire:model.defer="judul">
                            @error('judul') <span class="required">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 custom-form" wire:ignore>
                            <label class="form-label text-dark">Deskripsi Redaksi</label>
                            <textarea id="deskripsi" class="form-control"></textarea>
                            @error('deskripsi') <span class="required">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer border-0">
                <button class="btn btn-primary">Publish</button>
            </div>
        </div>
    </form>
</div>
@push('script')
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
document.addEventListener('livewire:load', function () {

    $('#deskripsi').summernote({
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ],
        callbacks: {
            onChange: function(contents) {
                Livewire.find(@this.__instance.id)
                    .set('deskripsi', contents);
            }
        }
    });

    // 🔥 TERIMA DATA DARI LIVEWIRE
    window.addEventListener('set-summernote', event => {
        $('#deskripsi').summernote('code', event.detail.deskripsi ?? '');
    });

});
</script>
@endpush
