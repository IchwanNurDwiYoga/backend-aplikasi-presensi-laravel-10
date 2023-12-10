<table class="table table-striped" id="datatablePresensi">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Status</th>
            <th>Jam Masuk</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presensi as $item)
            @if ($item->presensi_masuk != null && $item->presensi_masuk != 'izin')
                <tr>
                    <td>
                        @foreach ($item->pegawai as $pegawai)
                            {{ $pegawai->nama }}
                        @endforeach
                        <br>
                        <small>NIP: {{ $item->nip }}</small>
                    </td>
                    <td>
                        @if ($item->status_masuk == 1)
                            <small><span class="badge badge-danger">Terlambat</span></small>
                        @else
                            <small><span class="badge badge-success">Tepat Waktu</span></small>
                        @endif
                    </td>
                    <td>{{ $item->presensi_masuk }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

<script>
    $('#datatablePresensi').DataTable({
        "order": [[2, 'desc']],
    });
</script>
