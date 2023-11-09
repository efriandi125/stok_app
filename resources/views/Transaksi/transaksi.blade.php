<!Doctype html>
<html lang="en">

<head>
    <title>Transaksi Menu</title> <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--
    Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @include('Components.navigation')
        <div class="my-3">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-success" id="btn-add" onClick="create()"> Add </button>
                </div>
                <div class="col-md-7">
                    <form class="form" method="get" action="{{route('transaksi.filter')}}">
                        <div class="row">
                            <div class="col-md-4">
                                <label>From:</label>
                                <input type="date" id="date_from" name="date_from" />
                            </div>
                            <div class="col-md-4">
                                <label>To:</label>
                                <input type="date" id="date_to" name="date_to" />
                            </div>
                            <div class="col-md-1">
                                <input type="submit" class="btn btn-info" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="read" class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
                        <th>Produk</th>
                        <th>Transaksi Date</th>
                        <th>Customer</th>
                        <th>QTY Pesanan</th>
                        <th>Harga / QTY</th>
                        @if (auth()->user()->level=='admin')
                        <th>Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody> @foreach($data as $tr) <tr>
                        <td>{{$tr->produk_nama}}</td>
                        <td>{{$tr->transaksi_date}}</td>
                        <td>{{$tr->customer_nama}}</td>
                        <td>{{$tr->qty}}</td>
                        <td>{{$tr->harga}}</td>
                        @if (auth()->user()->level=='admin' and $tr->is_void==false )
                        <td> <a href="#" class="btn btn-danger" onClick="show({{$tr->id}})" id="VoidTR">Batal </a>
                        </td>
                        @else
                        @if (auth()->user()->level=='admin')
                        <td> <a href="#" class="btn btn-info" onClick="showFalse({{$tr->id}})" id="VoidTR"> Update
                                Batal </a></td>
                        @endif
                        @endif
                    </tr> @endforeach </tbody>
            </table>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
    @include('Components.modals')

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$.ajaxSetup({
    data: {
        _token: $('meta[name="csrf-token"]').attr('content')
    }
});

// Untuk modal halaman create
function create() {
    $.get("transaksi", {
        code: "c"
    }, function(data, status) {
        $("#exampleModalLabel").html('Create Transaksi')
        $("#page").html(data);
        $("#exampleModal").modal('show');

    });
}

// untuk proses create data
function store() {
    var produk = $("#nama_produk").val();
    var customer = $("#nama_customer").val();
    var qty = $("#qty").val();
    var harga = $("#harga").val();
    $.ajax({
        type: "POST",
        url: "{{ route('transaksi.store') }}",
        data: {
            id_produk: produk,
            id_customer: customer,
            qty: qty,
            harga: harga,
        },
        success: function(data) {
            $(".btn-close").click();
            location.reload();
        }

    });
}


function show(id) {
    $.get("transaksi/get/" + id, {
        is_void: true
    }, function(data, status) {
        location.reload();
    });
}

function showFalse(id) {
    $.get("transaksi/get/" + id, {
        is_void: false
    }, function(data, status) {
        location.reload();
    });
}
</script>