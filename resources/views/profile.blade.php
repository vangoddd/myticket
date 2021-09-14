<!DOCTYPE html>
<html>
    <head>
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <title>Profile</title>
    </head>
    <body>
    <div class="topnav">
    <div class="logo">MyTicket</div>
            <a href="/home">Home</a>
            @auth
                <a class="active" href="/profile">Profile</a>
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
        
        @foreach($profile as $p)
             <h1>Profile</h1>
             <p>Nama : {{ $p->nama_pb }}</p>
             <p>Email : {{ $p->email_pb }}</p>
             <br>

             <h1>Tiket yang dimiliki</h1>
             @if($ticket->isEmpty())
            <p>Anda tidak memiliki tiket
            @else
            @foreach($ticket as $t)
             <h2><a href="/tiket/{{ $t->Id_pemesanan }}">{{ $t->nama_event }}</a></h2>
             <p>{{ $t->tanggal }}</p>
             <p>Pukul {{ $t->waktu }}</p>
             <hr>
            @endforeach
            @endif
        @endforeach
        
         </div>
    </body>
</html>
