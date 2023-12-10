<table class="table table-striped" id="tableIzin">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presensi as $izin)
            @if ($izin->izin != null )
                <tr>
                    <td>
                        @foreach ($izin->pegawai as $pegawai)
                            {{ $pegawai->nama }}
                        @endforeach
                        <br>
                        <small>NIP: {{ $izin->nip }}</small>
                    </td>
                    <td>
                        @if ($izin->status_izin == 1)
                            <small><span class="badge badge-warning">Menunggu Persetujuan</span></small>
                        @elseif($izin->status_izin == 2)
                            <small><span class="badge badge-success">Disetujui</span></small>
                        @elseif($izin->status_izin == 3)
                            <small><span class="badge badge-danger">Ditolak</span></small>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($izin->status_izin != 1)
                            <button class="btn btn-primary btn-edit-izin" nip='{{ $izin->nip }}'
                                kode='{{ $izin->kode_presensi }}' data-toggle="modal" data-target="#editIzinModal"
                                disabled>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-external-link" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                        </path>
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6">
                                        </path>
                                        <path d="M11 13l9 -9"></path>
                                        <path d="M15 4h5v5"></path>
                                    </svg>
                                </div>
                                <span><small>Proses Izin</small></span>
                            </button>
                        @else
                            <button class="btn btn-primary btn-edit-izin" nip='{{ $izin->nip }}'
                                kode='{{ $izin->kode_presensi }}' data-toggle="modal" data-target="#editIzinModal">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-external-link" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                        </path>
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6">
                                        </path>
                                        <path d="M11 13l9 -9"></path>
                                        <path d="M15 4h5v5"></path>
                                    </svg>
                                </div>
                                <span><small>Proses Izin</small></span>
                            </button>
                        @endif

                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="editIzinModal" tabindex="-1" aria-labelledby="editModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="loadedPersetujuanIzin">

            </div>
        </div>
    </div>
    <script>
        $('#tableIzin').DataTable({
            "order": [
                [1, 'desc']
            ],
        });
        $('.btn-edit-izin').click(function() {
            var nip = $(this).attr('nip');
            var kode_presensi = $(this).attr('kode')
            $.ajax({
                type: 'POST',
                url: '/admin/persetujuan-izin',
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    nip: nip,
                    kode_presensi: kode_presensi
                },
                success: function(respond) {
                    $('#loadedPersetujuanIzin').html(respond);
                }
            });
            $('#editIzinModal').modal('show');
        });
    </script>
