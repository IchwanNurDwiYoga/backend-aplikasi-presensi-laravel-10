@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pegawai Create Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/pegawai">Admin Pegawai</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Pegawai</div>
                            <div class="d-flex justify-content-end">
                                {{-- <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#excelModal">Import Excel</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/admin/pegawai" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="text" name="nip" required>
                                            <div class="field-placeholder">NIP <span class="text-danger">*</span></div>
                                            <div class="form-text">
                                                NIP tidak boleh sama dengan pegawai lain.
                                            </div>
                                        </div>
                                        <!-- Field wrapper end -->

                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="text" name="nama" required>
                                            <div class="field-placeholder">Name <span class="text-danger">*</span></div>
                                            <div class="form-text">
                                                Nama Lengkap Pegawai.
                                            </div>
                                        </div>
                                        <!-- Field wrapper end -->

                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <select class="select-single js-states select2" name="jenis_kelamin"
                                                title="Select Product Category" data-live-search="true" required>
                                                <option value="Laki - Laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <div class="field-placeholder">Jenis Kelamin <span class="text-danger">*</span>
                                            </div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <select class="select-single js-states select2" name="jabatan_id"
                                                title="Select Product Category" data-live-search="true" required>
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
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="email" name="email" required>
                                            <div class="field-placeholder">Email <span class="text-danger">*</span></div>
                                            <div class="form-text">
                                                We'll never share your email with anyone.
                                            </div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="file" name="gambar" id="input-foto"
                                                onchange="previewImg();" accept=".jpg, .jpeg, .png">
                                            <div class="field-placeholder">Gambar</div>
                                            <div class="form-text">
                                                Foto Pegawai.
                                            </div>
                                        </div>
                                        <!-- Field wrapper end -->

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <img src="{{ url('') }}/assets/img/pegawai/default.jpg"
                                            class="img-thumbnail foto-pegawai" alt="Foto Pegawai" style="width: 90%;">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('') }}/admin/excel_pegawai" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="excelModalLabel">Import Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95%;">
                        <div class="modal-body" style="overflow: hidden; width: auto; height: 95%;">
                            <div class="row gutters">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="doc-block" style="padding: 13px;">
                                        <div class="doc-icon">
                                            <img src="{{ url('') }}/assets/img/docs/xls.svg" alt="Doc Icon">
                                        </div>
                                        <div class="doc-title">Template Excel</div>
                                        <a href="{{ url('') }}/admin/download_excel" class="btn btn-primary"
                                            target="_blank">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="field-wrapper mt-3">
                                <input class="form-control" type="file" name="excel" accept=".xls, .xlsx" required>
                                <div class="field-placeholder">excel</div>
                                <div class="form-text">
                                    File Excel.
                                </div>
                            </div>
                            <!-- Field wrapper end -->


                        </div>
                        <div class="slimScrollBar"
                            style="background: rgb(214, 219, 230); width: 5px; position: absolute; top: 0px; opacity: 0.8; display: block; border-radius: 0px; z-index: 99; right: 1px; height: 55.798px;">
                        </div>
                        <div class="slimScrollRail"
                            style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(214, 219, 230); opacity: 0.2; z-index: 90; right: 1px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {!! session('pesan') !!}
@endsection
@push('myscript')
    <script>
        $('.select2').select2();

        function previewImg() {
            const gambar = document.querySelector('#input-foto');
            const imgPreview = document.querySelector('.foto-pegawai');

            const filegambar = new FileReader();
            filegambar.readAsDataURL(gambar.files[0]);

            filegambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
@endpush
