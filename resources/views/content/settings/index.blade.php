@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Stting Page</li>
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
                    <div class="consulting-banner">
                        <div class="consulting-banner-bg"></div>
                        <div class="consulting-body">
                            <div class="consulting-content">
                                <h4>Pengaturan Jadwal Presesnsi</h4>
                                <p>Atur Jadwal Jam Masuk & Jam Keluar <br>Atur Lokasi Kantor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- row start --}}
            <div class="row">
                <div class="col-12">
                    {{-- card start --}}
                    <div class="card">
                        <div class="card-body">
                            @if ($settings != null)
                                <form action="/admin/settings/{{ $settings->id }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="field-wrapper">
                                                <input type="hidden" class="form-control" name="id"
                                                    value="{{ $settings->id }}">
                                                <input type="time" class="form-control" name="jam_masuk"
                                                    value="{{ $settings->jam_masuk }}">
                                                <div class="field-placeholder">Jam Masuk<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Jam Masuk Kerja</div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="field-wrapper">
                                                <input type="time" class="form-control" name="toleransi"
                                                    value="{{ $settings->toleransi }}">
                                                <div class="field-placeholder">Toleransi<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Toleransi Keterlambatan</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="time" class="form-control" name="jam_pulang"
                                                    value="{{ $settings->jam_pulang }}">
                                                <div class="field-placeholder">Jam Pulang<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Jam Pulang Kerja</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="text" class="form-control" name="lat_long"
                                                    value="{{ $settings->lat }}, {{ $settings->long }}">
                                                <div class="field-placeholder">Garis Lintang - Bujur<span
                                                        class="text-danger">*</span></div>
                                                <div class="form-text">Latitude Longitude / Garis Lintang - Bujur</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="text" class="form-control" name="batas_jarak"
                                                    value="{{ $settings->batas_jarak }}">
                                                <div class="field-placeholder">Batas Jarak<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">jarak dalam satuan meter</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="/admin/settings" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="field-wrapper">
                                                <input type="time" class="form-control" name="jam_masuk"
                                                    required>
                                                <div class="field-placeholder">Jam Masuk<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Jam Masuk Kerja</div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="field-wrapper">
                                                <input type="time" class="form-control" name="toleransi"
                                                    required>
                                                <div class="field-placeholder">Toleransi<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Toleransi Jam Keterlambatan</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="time" class="form-control" name="jam_pulang"
                                                    required>
                                                <div class="field-placeholder">Jam Pulang<span class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">Jam Pulang Kerja</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="text" class="form-control" name="lat_long"
                                                    required>
                                                <div class="field-placeholder">Garis Lintang - Bujur<span
                                                        class="text-danger">*</span></div>
                                                <div class="form-text">Latitude Longitude / Garis Lintang - Bujur</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="field-wrapper">
                                                <input type="text" class="form-control" name="batas_jarak"
                                                    required>
                                                <div class="field-placeholder">Batas Jarak<span
                                                        class="text-danger">*</span>
                                                </div>
                                                <div class="form-text">jarak dalam satuan meter</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    {{-- card end --}}
                </div>
            </div>
            {{-- row end --}}

            {{-- row start --}}
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body" style="height: 400px">
                            <iframe style="width: 100%; height: 100%;"
                                @if ($settings != null) src="https://www.google.com/maps?q={{ $settings->lat }}, {{ $settings->long }}&hl=es;z=14&output=embed" @endif
                                frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($settings != null)
                                <button type="button" class="btn btn-primary stripes-btn" style="width: 100%;"> Jam
                                    Masuk
                                    {{ $settings->jam_masuk }}</button>
                                <button type="button" class="btn btn-primary stripes-btn mt-3" style="width: 100%;"> Jam
                                    Keluar
                                    {{ $settings->jam_pulang }}</button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            {{-- row end --}}
        </div>
    </div>
    {!! session('pesan') !!}
@endsection
