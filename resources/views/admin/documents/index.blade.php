@extends('layouts.app')

@section('title', 'Master Dokumen')
@section('title_dashboard', 'Master Dokumen')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold">Master Dokumen</h4>
            <p class="text-muted mb-0">
                Kelola dokumen PDF dan Word
            </p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.documents.create') }}"
               class="btn btn-primary">
                <i class="bi bi-upload"></i> Upload Dokumen
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Judul Dokumen</th>
                        <th width="120">Tipe</th>
                        <th width="180">Tanggal Upload</th>
                        <th width="120">Status</th>

                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $doc->judul }}</strong>
                                @if($doc->keterangan)
                                    <div class="text-muted small">
                                        {{ $doc->keterangan }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info text-uppercase">
                                    {{ $doc->tipe }}
                                </span>
                            </td>
                            <td>
    @if($doc->is_publish)
        <span class="badge bg-success">Publish</span>
    @else
        <span class="badge bg-secondary">Draft</span>
    @endif
</td>

                            <td>
                                {{ $doc->created_at->format('d M Y') }}
                            </td>
                            <td>
                              <a href="{{ asset('storage/' . $doc->file) }}"
                                target="_blank"
                                class="btn btn-sm btn-info">
                                Lihat
                                </a>

                                <form action="{{ route('admin.documents.destroy', $doc->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                       Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada dokumen
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
