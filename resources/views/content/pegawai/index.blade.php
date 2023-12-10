@extends('template.main_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pegawai Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Admin</a></li> --}}
                        <li class="breadcrumb-item active">Admin Pegawai</li>
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
                                    <a href="/admin/pegawai/create" class="btn btn-primary stripes-btn">Tambah Data</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive mt-3">
                                        <table id="table-excel-pdf" class="table v-middle">
                                            <thead>
                                                <tr>
                                                    <th>Pegawai</th>
                                                    <th>Jabatan</th>
                                                    {{-- <th>Status</th> --}}
                                                    <th>Email</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pegawai as $p)
                                                    <tr>
                                                        <td>
                                                            <div class="media-box">
                                                                @if ($p->foto != null)
                                                                    <img src="{{ url('') }}/assets/img/pegawai/{{ $p->foto }}"
                                                                        class="media-avatar" alt="Customer">
                                                                @else
                                                                    <img src="{{ asset('assets/img/pegawai/default.jpg') }}"
                                                                        class="media-avatar" alt="Customer">
                                                                @endif

                                                                <div class="media-box-body">
                                                                    <a href="#">{{ $p->nama }}</a>
                                                                    <p>NIP: #{{ $p->nip }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @foreach ($p->jabatan as $item)
                                                            <td>{{ $item->nama}}</td>
                                                        @endforeach
                                                        {{-- <td>
                                                            @if ($p->is_active === '1')
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Deactive</span>
                                                            @endif
                                                        </td> --}}
                                                        <td>{{ $p->email }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="javascript:void(0);" class="btn-edit" nip="{{$p->nip}}"
                                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="" data-original-title="Edit"
                                                                    data-id="{{ $p->nip }}">
                                                                    <div class="icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-edit"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round" stroke-linejoin="round">
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
                                                                <form action="/admin/pegawai/{{ $p->nip }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn-hapus"
                                                                        style="border: none; outline: none; background: none; font-size: 16px; line-height: 16px;">
                                                                        <div class="icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-square-rounded-x"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                                stroke="#F70000" fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none"></path>
                                                                                <path d="M10 10l4 4m0 -4l-4 4"></path>
                                                                                <path
                                                                                    d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z">
                                                                                </path>
                                                                            </svg>
                                                                        </div>
                                                                    </button>
                                                                </form>
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
    {{-- modal edit --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="loadedEditPegawaiForm">
                </div>
            </div>
        </div>
        {!! session('pesan') !!}
    @endsection
    @push('myscript')
        <script>
            $('.btn-edit').click(function() {
                var nip = $(this).attr('nip');
                $.ajax({
                    type: 'POST',
                    url: '/admin/pegawai/edit',
                    cachce: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        nip: nip
                    },
                    success: function(respond) {
                        $('#loadedEditPegawaiForm').html(respond);
                    }
                });
                $('#editModal').modal('show');
            });
            $('#table-excel-pdf').DataTable({
                "ordering": true,
                // "lengthChange": false,
                "lengthMenu": [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                dom: 'lBfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        </script>
    @endpush
