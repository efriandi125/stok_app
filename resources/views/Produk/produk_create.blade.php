<div class="p1">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="">
    </div>
    <div class="form-group">
        <label>Qty</label>
        <input type="text" class="form-control" id="qty" name="qty" value="">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" value="">
    </div>
    <div class="form-group">
        <label>Category</label>

        <select class="form-control" name="id_category" id="id_category">
            <option value="">Select Category</option>
            @foreach($category as $cat)
            <option value="{{$cat->id}}">{{$cat->nama}}</option>
            @endforeach
        </select>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="store()">Save changes
        </button>
    </div>