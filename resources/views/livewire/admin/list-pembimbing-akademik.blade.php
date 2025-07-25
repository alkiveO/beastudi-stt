<div>
    @section('title', 'Pembimbing Akademik')
    @section('title_dashboard', 'Pembimbing Akademik')

    @livewire('create-pembimbing-akademik')

    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="mb-3 d-flex justify-content-center">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{ $program_studi === 'bisnis digital' ? 'active' : '' }}" wire:click.prevent="$set('program_studi', 'bisnis digital')">
                                        <i class="fa fa-briefcase text-primary"></i> Bisnis Digital
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{ $program_studi === 'sistem informasi' ? 'active' : '' }}" wire:click.prevent="$set('program_studi', 'sistem informasi')">
                                        <i class="fa fa-database text-success"></i> Sistem Informasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{ $program_studi === 'teknik informatika' ? 'active' : '' }}" wire:click.prevent="$set('program_studi', 'teknik informatika')">
                                        <i class="fa fa-cogs text-danger"></i> Teknik Informatika
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPembimbingAkademik">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead style="background:#FF4747;">
                                <tr>
                                    <th style="color:white !important;">Dosen</th>
                                    <th style="color:white !important;">Program Studi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembimbing_akademik as $pembimbingAkademik)
                                    <tr wire:key="pembimbing-{{ $pembimbingAkademik->id }}">
                                        <td>{{ $pembimbingAkademik->nama }}</td>
                                        <td>{{ ucwords($pembimbingAkademik->program_studi) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $pembimbing_akademik->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
