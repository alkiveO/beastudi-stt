<div>
    <div class="row">
        <div class="col-md-3">
            <div class="mb-4">
                <label for="nim">NIM</label>
                <input type="text" wire:model="nim" class="form-control">
            </div>
        </div>

        <div class="col-md-3">
             <div class="mb-4">
                <label for="tahunAngkatan">Tahun Angkatan</label>
                <select wire:model="tahunAngkatan" class="form-control">
                    <option value="">Pilih Tahun Angkatan</option>
                    @foreach($daftarTahunAngkatan as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-4">
                <label for="tahunAjaran">Tahun Ajaran</label>
                <select wire:model="tahunAjaran" class="form-control">
                    @foreach($daftarTahunAjaran as $daftarTahunAjaranItem)
                        <option value="{{ $daftarTahunAjaranItem->id }}">{{ $daftarTahunAjaranItem->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
