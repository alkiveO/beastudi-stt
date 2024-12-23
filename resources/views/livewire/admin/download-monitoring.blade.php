<div>
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label class="form-label text-dark">Periode</label>
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300='periode_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_periode as $periode)
                                    <option value="{{ $periode->id }}">{{ $periode->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="dropdown-menu">
                                    <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                        <ul class="dropdown-menu inner show" role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <button class="btn btn-success" wire:click='download'>Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
