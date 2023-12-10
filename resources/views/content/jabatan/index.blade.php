@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jabatan Page</h1>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="/admin/jabatan/create" class="btn btn-primary stripes-btn">Tambah Jabatan</a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table v-middle">
                                            <thead>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <th style="width: 100px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($data as $item)
                                                        <td>{{ $item->nama }}</td>
                                                        <td class="text-center">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="javascript:void(0);" class="btn-edit"
                                                                        idJabatan="{{ $item->id }}"
                                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="" data-original-title="Edit"
                                                                        data-id="" data-nama="">
                                                                        <div class="icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-edit"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                                stroke="currentColor" fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none"></path>
                                                                                <path
                                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                                </path>
                                                                                <path
                                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                                </path>
                                                                                <path d="M16 5l3 3"></path>
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                        </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="loadedEditJabatanForm">
                </div>
            </div>
        </div>
        {!! session('pesan') !!}
    @endsection
    @push('myscript')
        <script>
            $('.btn-edit').click(function() {
                var id = $(this).attr('idJabatan');
                $.ajax({
                    type: 'POST',
                    url: '/admin/jabatan/edit',
                    cachce: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(respond) {
                        $('#loadedEditJabatanForm').html(respond);
                    }
                });
                $('#editModal').modal('show');
            });

            var table = $('#datatable').DataTable({
                "ordering": true,
                "lengthMenu": [
                    [-1, 5, 10, 25, 50],
                    ["All", 5, 10, 25, 50]
                ],
            });
            var ordering = table.order();
        </script>
    @endpush
