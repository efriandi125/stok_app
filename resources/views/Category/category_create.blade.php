<div class="p1">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="">
    </div>
    <div class="form-group">
        <label>Jenis</label>
        <input type="text" class="form-control" id="jenis" name="jenis">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="store()">Save changes
        </button>
    </div>