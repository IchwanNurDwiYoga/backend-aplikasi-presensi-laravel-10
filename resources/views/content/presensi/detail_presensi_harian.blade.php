@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Presensi Page</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3>{{ date('d M Y', strtotime($presensi->tgl_presensi)) }}</h3>
                </div>
                <div class="card-body">
                    @include('content.presensi.tabel_detail_presensi')
                </div>
            </div>
        </div>
    </div>
    <script>
        // $('#tabelDetail').DataTable({
        //     "order": [
        //         [1, 'desc']
        //     ],
        // });
    </script>
@endsection
@push('myscript')
    
@endpush
