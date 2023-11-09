<div class="p1">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{$category->nama}}">
    </div>
    <div class="form-group">
        <label>Jenis</label>
        <input type="text" class="form-control" id="jenis" name="jenis" value="{{$category->jenis}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="update({{$category->id}})">Save changes
        </button>
    </div>