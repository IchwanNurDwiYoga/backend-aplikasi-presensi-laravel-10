@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jabatan Create</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Jabatan</div>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0);" class="btn btn-primary tambah-baris">Tambah Baris</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/admin/jabatan/" method="post">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input type="text" name="nama[]"
                                                    style="width: 100%; outline: none; border: none;"
                                                    placeholder="Masukkan Nama Jabatan" required></td>
                                            <td></td>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $('.tambah-baris').click(function() {
            var html = `
        <tr>
            <td><input type="text" name="nama[]" style="width: 100%; outline: none; border: none; " placeholder="Masukkan Nama Jabatan" required></td>
            <td>
                <a href="javascript:void(0);" class="badge bg-danger">
                    Hapus
                </a>
            </td>
        </tr>
        `;

            $('tbody').append(html);
        });

        $('tbody').on('click', 'tr td a', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
