<div>
    <form wire:submit.prevent="update">
        <div class="card-body">

            {{-- Periode --}}
            <div class="form-group mb-3">
                <label for="nama" class="form-label text-dark">
                    Periode
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="nama"
                    autocomplete="off"
                    wire:model.blur="nama"
                    placeholder="Contoh: 2024/2025"
                >
                <div class="text-danger">
                    @error('nama') {{ $message }} @enderror
                </div>
            </div>

            {{-- Jenis Semester --}}
            <div class="form-group">
                <label class="form-label text-dark">
                    Jenis Semester
                </label>
                <select
                    class="form-control"
                    wire:model="jenis_semester"
                >
                    <option value="">-- Pilih Semester --</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
                <div class="text-danger">
                    @error('jenis_semester') {{ $message }} @enderror
                </div>
            </div>

        </div>

        <div class="card-footer" style="border: none;">
            <div>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update
                </button>
            </div>
        </div>
    </form>
</div>
