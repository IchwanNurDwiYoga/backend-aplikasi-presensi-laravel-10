<form action="{{ url('') }}/admin/pegawai/edit/{{$pegawai->nip}}" method="post" enctype="multipart/form-data" id="editForm">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="overflow-y: scroll;">

        <!-- Field wrapper start -->
        <div class="field-wrapper">
            <input class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}" readonly required>
            <div class="field-placeholder">NIP <span class="text-danger">*</span></div>
        </div>
        <!-- Field wrapper end -->

        <!-- Field wrapper start -->
        <div class="field-wrapper">
            <input class="form-control" id="nama" type="text" name="nama" value="{{ $pegawai->nama }}"
                required>
            <div class="field-placeholder">Name Pegawai <span class="text-danger">*</span></div>
        </div>
        <!-- Field wrapper end -->

        <div class="row">
            <div class="col-6">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                    <select class="form-select select-single js-states" id="jenis_kelamin" name="jenis_kelamin"
                        title="Select Product Category" data-live-search="true" required>
                        <option value="{{ $pegawai->jenis_kelamin }}" selected>{{ $pegawai->jenis_kelamin }}</option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="field-placeholder">Jenis Kelamin <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
            </div>

            <div class="col-6">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                    <select class="form-select select-single js-states select2" name="jabatan_id"
                        title="Select Product Category" data-live-search="true" required>
                        @foreach ($pegawai->jabatan as $item)
                            <option value="{{ $item->id }}" selected disabled> {{ $item->nama }} </option>
                        @endforeach
                        @foreach ($jabatan as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="field-placeholder">Jabatan <span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
            </div>
        </div>




        <!-- Field wrapper start -->
        <div class="field-wrapper">
            <input class="form-control" type="email" id="email" name="email" value="{{ $pegawai->email }}"
                required>
            <div class="field-placeholder">Email <span class="text-danger">*</span></div>
        </div>
        <!-- Field wrapper end -->

        <!-- Field wrapper start -->
        <div class="field-wrapper">
            <input class="form-control" type="password" id="password" name="password" placeholder="Tulis hanya jika ingin mengubah password">
            <div class="field-placeholder">Password</div>
        </div>
        <!-- Field wrapper end -->

        <!-- Field wrapper start -->
        {{-- <div class="field-wrapper">
            <select class="form-select" id="is_active" name="is_active" title="Select Product Category"
                data-live-search="true" required>
                <option value="{{ $pegawai->is_active }}" selected>{{ $pegawai->is_active == 1 ? 'Active' : "Non-active"}}</option>
                <option value="1">Active</option>
                <option value="0">Non-active</option>
            </select>
            <div class="field-placeholder">Is Active <span class="text-danger">*</span></div>
        </div> --}}

        <!-- Field wrapper end -->
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="gambar"></div>
            </div>
        </div>
        <!-- Field wrapper start -->

        {{-- <div class="field-wrapper mt-3">
            <input class="form-control" type="file" name="gambar" id="input-foto" onchange="previewImg();"
                accept=".jpg, .jpeg, .png">
            <div class="field-placeholder">Gambar</div>
            <div class="form-text">
                Foto Pegawai.
            </div>
        </div>
        <!-- Field wrapper end -->
        <input type="hidden" name="gambar_lama" id="gambar_lama"> --}}

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
