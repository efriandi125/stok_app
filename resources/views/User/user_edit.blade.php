<div class="p2">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">


        <label>Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user->nama}}">
    </div>
    <div class="form-group"> <label>Email</label> <input type="text" class="form-control" id="email" name="email"
            placeholder="Enter Description" value="{{$user->email}}">
    </div>
    <div class="form-group"> <label>Password</label>
        <input type="text" class="form-control" id="password" name="password" value="{{$user->password}}">
    </div>
    <div class="form-group"> <label>Level</label>
        <select class="form-control" name="level" id="level">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onClick="update({{ $user->id }})">Save changes
        </button>
    </div>