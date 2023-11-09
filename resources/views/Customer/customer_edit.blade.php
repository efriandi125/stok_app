<div class="p2">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">

        <label>Nama</label>
        <input type="text" class="form-control" id="nama_customer" name="nama_customer"
            value="{{$customer->nama_customer}}">
    </div>
    <div class="form-group"> <label>Alamat</label> <input type="text" class="form-control" id="alamat" name="alamat"
            placeholder="Enter Description" value="{{$customer->alamat}}">
    </div>
    <div class="form-group"> <label>No Hp</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$customer->no_hp}}">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onClick="update({{ $customer->id }})">Save changes
        </button>
    </div>