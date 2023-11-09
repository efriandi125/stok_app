<div class="p2">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">


        <label>Nama</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group"> <label>Email</label> <input type="text" class="form-control" id="email" name="email"
            placeholder="Enter Description">
    </div>
    <div class="form-group"> <label>Password</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label>Level</label>
        <select class="form-control" name="level" id="level">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onClick="store()">Save changes
        </button>
    </div>