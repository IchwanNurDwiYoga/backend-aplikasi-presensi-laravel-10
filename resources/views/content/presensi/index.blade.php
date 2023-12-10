@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Presensi Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Presensi Hari Ini</h5><br>
                    @if ($presensi === null)
                        <a href="/admin/presensi/create" class="btn btn-primary stripes-btn presensi-hari-ini">Presensi Hari
                            Ini</a>
                    @endif
                    <div class="table-responsive mt-2">
                        <table id="datatable" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Jumlah Pegawai</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Pulang</th>
                                    <th>Jumlah Izin</th>
                                    <th>Jumlah Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($presensi !== null)
                                    <tr>
                                        <td>{{ $presensi->jumlah_pegawai }} Pegawai</td>
                                        <td>{{ $presensi->jumlah_pegawai_masuk ? $presensi->jumlah_pegawai_masuk : '0' }}
                                            Pegawai</td>
                                        <td>{{ $presensi->jumlah_pegawai_pulang ? $presensi->jumlah_pegawai_pulang : '0' }}
                                            Pegawai</td>
                                        <td>{{ $presensi->jumlah_izin ? $presensi->jumlah_izin : '0' }} Pegawai</td>
                                        <td>{{ $presensi->total ? $presensi->total : '0' }} Pegawai</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Presensi</h5><br>
                        <div class="d-flex justify-content-end">
                            {{-- <div class="card-tools"><a href="/admin/presensi/cetak-laporan/" class="btn btn-primary">Cetak Laporan</a></div> --}}
                        </div>
                        <div class="table-responsive mt-2">
                            <table id="datatable2" class="table v-middle">
                                <thead>
                                    <tr>
                                        <th>Tgl</th>
                                        <th>Jumlah Pegawai</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Jumlah Pulang</th>
                                        <th>Jumlah Izin</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat_presensi as $item)
                                        @if ($item->tgl_presensi != date('d-m-Y', time()))
                                            <tr>
                                                <td>{{date('d-M-Y', strtotime($item->tgl_presensi))}}</td>
                                                <td>{{ $item->jumlah_pegawai }} Pegawai</td>
                                                <td>{{ $item->jumlah_pegawai_masuk ? $item->jumlah_pegawai_masuk : '0' }}
                                                    Pegawai</td>
                                                <td>{{ $item->jumlah_pegawai_pulang ? $item->jumlah_pegawai_pulang : '0' }}
                                                    Pegawai</td>
                                                <td>{{ $item->jumlah_izin ? $item->jumlah_izin : '0' }} Pegawai</td>
                                                <td>{{ $item->total ? $item->total : '0' }} Pegawai</td>
                                                <td class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="/admin/presensi/detail/{{$item->kode_presensi}}" data-toggle="tooltip" data-placement="top"
                                                            class="btn btn-primary"
                                                                title="" data-original-title="Edit">
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-external-link"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none">
                                                                        </path>
                                                                        <path
                                                                            d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6">
                                                                        </path>
                                                                        <path d="M11 13l9 -9"></path>
                                                                        <path d="M15 4h5v5"></path>
                                                                    </svg>
                                                                </div>
                                                                <span><small>Detail</small></span>
                                                            </a>
                                                        </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! session('pesan') !!}
    @endsection
    @push('myscript')
        <script>
            $('#datatable').DataTable({
                "ordering": true,
                "lengthChange": false,
            });
            $('#datatable2').DataTable({
                "ordering": true,
                "lengthMenu": [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
            });
        </script>
    @endpush
