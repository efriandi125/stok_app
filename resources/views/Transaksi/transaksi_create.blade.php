<div class="p1">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label>Nama Produk</label>
        <select class="form-control" name="nama_produk" id="nama_produk">
            <option value="">Select Produk</option>
            @foreach($data['produk'] as $prd)
            <option value="{{$prd->id}}">{{$prd->nama_produk}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Nama Customer</label>
        <select class="form-control" name="nama_customer" id="nama_customer">
            <option value="">Select Customer</option>
            @foreach($data['customer'] as $cs)
            <option value="{{$cs->id}}">{{$cs->nama_customer}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Qty</label>
        <input type="text" class="form-control" id="qty" name="qty" value="">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" value="">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onCLick="store()">Save changes
        </button>
    </div>