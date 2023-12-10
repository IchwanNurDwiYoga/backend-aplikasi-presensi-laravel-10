<form action="/admin/jabatan/{{$jabatan->id}}/update" method="post" id="editForm">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95%;">
        <div class="modal-body" style="overflow: hidden; width: auto; height: 95%;">
            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <input class="form-control" type="hidden" name="id" value="{{$jabatan->id}}" required>
                <input class="form-control" type="text" name="nama" value="{{$jabatan->nama}}" required>
                <div class="field-placeholder">Name Jabatan <span class="text-danger">*</span></div>
            </div>
            <!-- Field wrapper end -->
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
