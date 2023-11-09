<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav navbar-center">
                <a href="{{url('Homes')}}" class="nav-item nav-link active">Home</a>
                <a href="{{route('produk')}}" class="nav-item nav-link">Produk</a>
                <a href="{{route('customer')}}" class="nav-item nav-link">Supplier</a>
                <a href="{{route('transaksi')}}" class="nav-item nav-link">Transaksi</a>
                @if(auth()->user()->level=='admin')
                <a href="{{route('user')}}" class="nav-item nav-link">User</a>
                <a href="{{route('category')}}" class="nav-item nav-link">Category</a>
                @endif
            </div>

        </div>
        <div class="navbar-nav navbar-right">
            <a href="{{route('logout')}}" class="nav-item nav-link">Logout</a>
        </div>
    </div>
</nav>