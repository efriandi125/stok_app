<div class="p2">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
            value="{{$produk['produk']->nama_produk}}">
    </div>
    <div class="form-group">
        <label>Qty</label>
        <input type="text" class="form-control" id="qty" name="qty" value="{{$produk['produk']->qty}}">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" value="{{$produk['produk']->harga}}">
    </div>
    <div class="form-group">
        <label>Category</label>

        <select class="form-control" name="id_category" id="id_category">

            <option value="{{$produk['cate']->id}}">{{$produk['cate']->nama}}</option>
            @foreach($produk['category'] as $cat)
            <option value="{{$cat->id}}">{{$cat->nama}}</option>
            @endforeach
        </select>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="update({{$produk['produk']->id}})">Save changes
        </button>
    </div>