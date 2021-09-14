<!DOCTYPE html>
<html>
    <head>
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <title>Home</title>
    </head>
    <body>
        <div class="topnav">
            <div class="logo">MyTicket</div>
            <a class="active" href="/home">Home</a>
            @auth
                <a href="/profile">Profile</a>
            @endauth
            <form action="/cari" method="get">
                <input type="text" name="keyword" placeholder="Search..">
            </form>
            @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="logout">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">Logout</a>
                            </div>
                        </form>  
                    @else
                        <div class="logout">
                        <a href="{{ route('login') }}">Login</a>
                        </div>
                    @endauth
            @endif
        </div> 
       

        <div class="content">
            @foreach($event as $e)
                <div style="height:auto; overflow:hidden; margin-bottom: 30px;">
                    <h1><a href="/detailevent/{{ $e->Id_event }}"> {{ $e->nama_event }} </a></h1>
                    <div  style="width:20%; float: left; height:auto; margin-right: 20px;">
                        <img src="/img/{{ $e->gambar }}" style="width:100%">
                    </div>
                    <div style="width: 75%; padding: 10px">
                        <p> {{ $e->deskripsi }} </p>
                    </div>
                </div>
                <div style="margin-top : 5px;">
                    <hr>
                </div>
            @endforeach
        </div>
    </body>
</html>
