<!Doctype html>
<html lang="en">

<head>
    <title>User Menu</title> <!-- Required meta tags -->
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
                    <form class="form" method="get" action="{{ route('user.search') }}">
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
                        <th>Email</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody> @foreach($data as $us) <tr>
                        <td>{{$us->nama}}</td>
                        <td>{{$us->email}}</td>
                        <td>{{$us->password}}</td>
                        <td>{{$us->level}}</td>
                        <td> <a href="#"><i class="fa fa-pencil" aria-hidden="true" onClick="show({{$us->id}})"
                                    id="editUS"></i></a> | <a href="#"><i class="fa fa-minus-square " style="color:red"
                                    onClick="show_drop({{$us->id}})"></i></i></a> </td>
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
    $.get("user", {
        code: "c"
    }, function(data, status) {
        $("#exampleModalLabel").html('Create User')
        $("#page").html(data);
        $("#exampleModal").modal('show');

    });
}

// untuk proses create data
function store() {
    var level = $("#level").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    $.ajax({
        type: "POST",
        url: "{{ route('user.store') }}",
        data: {
            name: name,
            email: email,
            password: password,
            level: level,
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

// Untuk modal halaman edit show
function show(id) {
    $.get("user/get/" + id, {
        code: "e"
    }, function(data, status) {
        $("#exampleModalLabel").html('Edit User')
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
    var name = $("#name").val();
    var email = $("#email").val();
    var pass = $("#password").val();
    var level = $("#level").val();
    $.ajax({
        type: "PATCH",
        url: "user/update/" + id,
        data: {
            name: name,
            email: email,
            password: pass,
            level: level,
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
    $.get("user/get/" + id, {
        code: "d"
    }, function(data, status) {
        $("#exampleModalLabel").html('Delete User')
        $("#page").html(data);
        $("#exampleModal").modal('show');
    });

}
// untuk delete atau destroy data
function destroy(id) {

    $.ajax({
        type: "DELETE",
        url: "user/delete/" + id,
        data: {},
        success: function(data) {
            $(".btn-close").click();
            location.reload();
        }
    });
}
</script>