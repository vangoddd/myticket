<!DOCTYPE html>
<html>
    <head>
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <title>Event</title>
    </head>
    <body>
        <div class="topnav">
        <div class="logo">MyTicket</div>
            <a href="/home">Home</a>
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
             <h1><a href="#"> {{ $e->nama_event }} </a></h1>
             <hr width="50%">
             <img src="/img/{{ $e->gambar }}" style="width:40%; margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px">
             <hr width="50%">
             <div style="width:75%">
             <h3>Deskripsi event</h3>
             <p>{{ $e->deskripsi }}</p>
             </div>
             <p><b>Harga tiket : {{ $e->harga }} per orang </b></p>
             <p><b>Tiket tersedia : {{ $e->tersedia }} Tiket</b></p>

            @auth
                <form action="/detailevent/beli" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $e->Id_event }}">
                    <input type="hidden" name="id_pembeli" value="{{ Auth::user()->id }}">
                    <a href="#" onclick="event.preventDefault();
                        this.closest('form').submit();"><h2> Beli tiket <h2></a>
                </form>
            @else
                <h3>Silahkan Login untuk beli tiket</h3> 
            @endauth
            @endforeach
         </div>
    </body>
</html>
