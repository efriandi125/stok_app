<!Doctype html>
<html lang="en">

<head>
    <title>Customer Menu</title> <!-- Required meta tags -->
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
                <div class="col-md-8">
                    <form class="form" method="get" action="{{ route('customer.search') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Search name" name="search"
                                    id="search">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-info">
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
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody> @foreach($data as $cs) <tr>
                        <td>{{$cs->nama_customer}}</td>
                        <td>{{$cs->no_hp}}</td>
                        <td>{{$cs->alamat}}</td>
                        <td> <a href="#"><i class="fa fa-pencil" aria-hidden="true" onClick="show({{$cs->id}})"
                                    id="editCS"></i></a> | <a href="#"><i class="fa fa-minus-square " style="color:red"
                                    onClick="show_drop({{$cs->id}})"></i></i></a> </td>
                    </tr> @endforeach </tbody>
            </table>
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
    $.get("customer", {
        code: "c"
    }, function(data, status) {
        $("#exampleModalLabel").html('Create Customer')
        $("#page").html(data);
        $("#exampleModal").modal('show');

    });
}

// untuk proses create data
function store() {
    var name = $("#nama_customer").val();
    var alamat = $("#alamat").val();
    var no_hp = $("#no_hp").val();
    $.ajax({
        type: "POST",
        url: "{{ route('customer.store') }}",
        data: {
            nama_customer: name,
            alamat: alamat,
            no_hp: no_hp
        },
        success: function(data) {
            $(".btn-close").click();
            location.reload();
        }
    });
}

// Untuk modal halaman edit show
function show(id) {
    $.get("customer/get/" + id, {
        code: "e"
    }, function(data, status) {
        $("#exampleModalLabel").html('Edit Customer')
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });
}

$(function() {
    $('.btn-close').on('click', function() {
        $('#exampleModal').modal('hide');
    })
})

// untuk proses update data
function update(id) {
    var name = $("#nama_customer").val();
    var alamat = $("#alamat").val();
    var no_hp = $("#no_hp").val();

    $.ajax({
        type: "PATCH",
        url: "customer/update/" + id,
        data: {
            nama_customer: name,
            alamat: alamat,
            no_hp: no_hp
        },
        success: function(data) {
            $(".btn-close").click();
            location.reload();
        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
}

function show_drop(id) {
    $.get("customer/get/" + id, {
        code: "d"
    }, function(data, status) {
        $("#exampleModalLabel").html('Delete Customer')
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });

}
// untuk delete atau destroy data
function destroy(id) {

    $.ajax({
        type: "DELETE",
        url: "customer/delete/" + id,
        data: {},
        success: function(data) {
            $(".btn-close").click();
            location.reload();
        }
    });
}
</script>