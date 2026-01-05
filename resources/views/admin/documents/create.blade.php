@extends('layouts.app')

@section('title', 'Upload Dokumen')
@section('title_dashboard', 'Upload Dokumen')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12">

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Upload Dokumen</h5>
                </div>

                <div class="card-body">

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.documents.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Judul Dokumen <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="judul"
                                   class="form-control"
                                   value="{{ old('judul') }}"
                                   required>
                        </div>

                        {{-- File --}}
                        <div class="mb-3">
                            <label class="form-label">
                                File Dokumen <span class="text-danger">*</span>
                            </label>
                            <input type="file"
                                   name="file"
                                   class="form-control"
                                   accept=".pdf,.doc,.docx"
                                   required>
                            <small class="text-muted">
                                Format: PDF, DOC, DOCX (Max 5MB)
                            </small>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan"
                                      class="form-control"
                                      rows="3">{{ old('keterangan') }}</textarea>
                        </div>

                        {{-- Status Publish --}}
                        <div class="mb-4">
                            <label class="form-label">Status Dokumen</label>
                            <select name="is_publish" class="form-select">
                                <option value="1" selected>Publish</option>
                                <option value="0">Tidak Publish</option>
                            </select>
                        </div>

                        {{-- Button --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.documents.index') }}"
                               class="btn btn-secondary me-2">
                                Kembali
                            </a>
                            <button class="btn btn-primary">
                                <i class="bi bi-upload"></i> Upload Dokumen
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
