<div>
    <div>
        @include('partials.modal-edit-mou')
    </div>

    <div class="container-fluid">
        <div class="card h-auto">
            <div class="card-header p-0">
                <div class="user-bg w-100">
                    <div class="user-svg">
                        <svg width="264" height="109" viewBox="0 0 264 109" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.0107422" y="0.6521" width="263.592" height="275.13" rx="20" fill="#F26A18"></rect>
                        </svg>
                    </div>
                    <div class="user-svg-1">
                        <svg width="264" height="59" viewBox="0 0 264 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="0.564056" width="263.592" height="275.13" rx="20" fill="#FCC43E"></rect>
                        </svg>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="user">
                        <div class="user-media">
                            <img src="{{ asset('images/avatar/9.jpg') }}" alt="" class="avatar avatar-xxl">
                        </div>
                        <div>
                            <h2 class="mb-0">{{ $mou->mahasiswa }}</h2>
                            <p class="text-primary font-w600">Mahasiswa, {{ $mou->angkatan }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-3 col-xxl-6 col-sm-6 mt-4">
                        <ul class="student-details">
                            <li class="me-2">
                                <a class="icon-box bg-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-mortarboard text-white" viewBox="0 0 16 16">
                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"></path>
                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"></path>
                                    </svg>
                                </a>

                            </li>
                            <li><span>Angkatan:</span>
                                <h5 class="mb-0">{{ $mou->angkatan }}</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6 mt-4">
                        <ul class="student-details">
                            <li class="me-2">
                                <a class="icon-box bg-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-mortarboard text-white" viewBox="0 0 16 16">
                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"></path>
                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"></path>
                                    </svg>
                                </a>

                            </li>
                            <li><span>Jurusan:</span>
                                <h5 class="mb-0">{{ ucwords($mou->prodi->nama) }}</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6 mt-4">
                        <ul class="student-details">
                            <li class="me-2">
                                <a class="icon-box bg-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-mortarboard text-white" viewBox="0 0 16 16">
                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"></path>
                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"></path>
                                    </svg>
                                </a>

                            </li>
                            <li><span>File MOU</span>
                                <h5 class="mb-0">
                                    <a href="{{ asset('storage/mou/' . $mou->file) }}" target="__blank">{{ $mou->file }}</a>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-3 col-xxl-6 col-sm-6 mt-4">
                        <a href="{{ route('mahasiswa.mou.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-info" wire:click='$emit("showEditMouModal", {{ $mou }})'>Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('livewire/mou.js') }}"></script>
    @endpush
</div>
