<div class="modal fade" id="downloadSpbModal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="downloadSpbModalLabel">Download SPB</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div>
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label text-dark">Semester</label>
                            <div class="dropdown bootstrap-select default-select form-control wide">
                                <select name="semester" class="default-select form-control wide" required>
                                    <option value="" hidden>Nothing Selected</option>
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

                        <div class="form-group mt-2">
                            <label class="form-label text-dark">Periode</label>
                            <div class="dropdown bootstrap-select default-select form-control wide">
                                <select name="periode" class="default-select form-control wide" required>
                                    <option value="" hidden>Nothing Selected</option>
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

                        <!-- saat klik download spb -->
                        <input type="hidden" id="input-nim" name="nim">
                    </div>

                    <div class="card-footer" style="border: none;">
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="download">Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
