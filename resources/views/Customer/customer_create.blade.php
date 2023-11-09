<div class="p1">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Description" value="">
    </div>
    <div class="form-group">
        <label>No Hp</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="store()">Save changes
        </button>
    </div>