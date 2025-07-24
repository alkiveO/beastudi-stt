<div wire:ignore.self class="modal fade" id="modal-delete-mahasiswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Master Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="card-body">
        Yakin ingin menghapus data <strong> {{ $nim }} {{ $nama }}</strong>?
      </div>
       <div class="card-footer" style="border: none;">
        <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button wire:click="delete" class="btn btn-danger">Hapus</button>
        </div>
    </div>
  </div>
</div>
