<table class="table table-striped" id="tableIzin">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Presensi Masuk</th>
            <th>Presensi Pulang</th>
            <th>Izin</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detailPresensi as $item)
            <tr>
                <td>
                    @foreach ($item->pegawai as $pegawai)
                        {{ $pegawai->nama }}
                    @endforeach
                </td>
                <td>{{ $item->presensi_masuk != null ? $item->presensi_masuk : 'tanpa keterangan' }}
                </td>
                <td>{{ $item->presensi_pulang != null ? $item->presensi_pulang : 'tanpa keterangan' }}
                </td>
                <td>{{ $item->izin == null ? '-' : $item->alasan }}</td>
            </tr>
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
                [0, 'asc']
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
