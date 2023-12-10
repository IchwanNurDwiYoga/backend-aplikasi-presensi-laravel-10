@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p style="font-size: 2em;font-weight: bold">
                                {{ $rekapPresensi->jmlHadir ? $rekapPresensi->jmlHadir : 0 }} <sub
                                    style="font-size: 12px; font-weight: normal">/ {{ $jumlahPegawai }}</sub></p>
                            <small>Total Pegawai Hadir</small>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <p style="font-size: 2em;font-weight: bold">
                                {{ $rekapPresensi->jmlTepatwaktu ? $rekapPresensi->jmlTepatwaktu : 0 }} <sub
                                    style="font-size: 12px; font-weight: normal">/ {{ $rekapPresensi->jmlHadir }}</sub></p>

                            <small>Hadir Tepat Waktu / Total Kehadiran</small>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-check"
                                width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20.942 13.021a9 9 0 1 0 -9.407 7.967"></path>
                                <path d="M12 7v5l3 3"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <p style="font-size: 2em;font-weight: bold">
                                {{ $rekapPresensi->jmlTelat ? $rekapPresensi->jmlTelat : 0 }} <sub
                                    style="font-size: 12px; font-weight: normal">/ {{ $rekapPresensi->jmlHadir }}</sub></p>

                            <small>Pegawai Terlambat / Total Kehadiran</small>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm-off"
                                width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="#BB2D3B"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7.587 7.566a7 7 0 1 0 9.833 9.864m1.35 -2.645a7 7 0 0 0 -8.536 -8.56"></path>
                                <path d="M12 12v1h1"></path>
                                <path d="M5.261 5.265l-1.011 .735"></path>
                                <path d="M17 4l2.75 2"></path>
                                <path d="M3 3l18 18"></path>
                            </svg>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <p style="font-size: 2em;font-weight: bold">
                                {{ $rekapIzin->jmlIzin ? $rekapIzin->jmlIzin : 0 }} </p>

                            <small>Pegawai Mengajukan Izin</small>
                        </div>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text"
                                width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="#D9A406"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                </path>
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                </path>
                                <path d="M9 12h6"></path>
                                <path d="M9 16h6"></path>
                            </svg>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">Riwayat Kehadiran Pegawai</div>
                        <div class="card-body">
                            @if ($presensiDetail == null)
                                <p>Daftar Presensi Belum Dibuat</p>
                            @else
                                @include('content.dashboard.tabel_riwayat_presensi')
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">Riwayat Pengajuan Izin Pegawai</div>
                        <div class="card-body">
                            @if ($presensiDetail == null)
                                <p>Daftar Presensi Belum Dibuat</p>
                            @else
                                @include('content.dashboard.tabel_riwayat_izin')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        {!! session('pesan') !!}
@endsection
