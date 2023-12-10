<form action="/admin/persetujuan-izin/{{$data->nip}}/update" method="post" id="editForm">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Persetujuan Izin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95%;">
        <div class="modal-body" style="overflow: hidden; width: auto; height: 95%;">
            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <input class="form-control" name="kode_presensi" value="{{ $data->kode_presensi }}" type="hidden" required>
                <input class="form-control" name="nip" value="{{ $data->nip }}" type="hidden" required>
            </div>
            <!-- Field wrapper end -->
            <table>
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            @foreach ($data->pegawai as $item)
                            {{$item->nama}}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td>:</td>
                        <td>{{$data->alasan}}</td>
                    </tr>
                </tbody>
            </table>
            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <select class="form-select" id="status_izin" name="status_izin" title="Select Product Category"
                    data-live-search="true" required>
                    <option value="1" {{$data->status_izin == 1 ? 'selected' : ''}}>Menunggu Persetujuan</option>
                    <option value="2" >Izinkan</option>
                    <option value="3" >Tolak</option>
                </select>
                <div class="field-placeholder">Is Active <span class="text-danger">*</span></div>
            </div>

        </div>
        <div class="slimScrollBar"
            style="background: rgb(214, 219, 230); width: 5px; position: absolute; top: 0px; opacity: 0.8; display: block; border-radius: 0px; z-index: 99; right: 1px; height: 55.798px;">
        </div>
        <div class="slimScrollRail"
            style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(214, 219, 230); opacity: 0.2; z-index: 90; right: 1px;">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
