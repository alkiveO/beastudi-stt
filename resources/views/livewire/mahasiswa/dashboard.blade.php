<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Halo Mahasiswa Beastudi Nurul Fikri 🤗
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p>Filter Semester dan Periode untuk melihat status monitoring dan beastudi.</p>
                    <div class="row">
                        <div class="mt-2">
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="semester-select" class="default-select form-control wide" wire:model.debounce.300='semester'>
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
                        <div class="mt-2">
                            <div class="dropdown bootstrap-select default-select form-control wide" wire:ignore>
                                <select id="periode-select" class="default-select form-control wide" wire:model.debounce.300='periode_id'>
                                    <option hidden>Nothing Selected</option>
                                    @foreach($list_periode as $periodeItem)
                                    <option value="{{ $periodeItem->id }}">{{ $periodeItem->nama }}</option>
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
                        <h4 class="mb-3">Informasi Mahasiswa</h4>
                        <p class="fs-5 text-black">Status Monitoring: <span class="{{ $textTypeMonitoring }}">{{ $pesanMonitoring ?? '-' }}</span> </p>
                        <p class="fs-5 text-black">Status Beastudi: <span class="{{ $textTypeBeastudi }}">{{ $pesanBeastudi ?? '-' }}</span> </p>
                    </div>
                </div>
                <div class="col-md-6">
                    @livewire('mahasiswa-ipk-chart')
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $('#semester-select').on('changed.bs.select', function () {
                var selectedSemester = $(this).val();
                @this.set('semester', selectedSemester);
            });

            $('#periode-select').on('changed.bs.select', function () {
                var selectedPeriode = $(this).val();
                @this.set('periode_id', selectedPeriode);
            });
        </script>
    @endpush
</div>
