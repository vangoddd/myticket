<!DOCTYPE html>
<html>
    <head>
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <title>Tiket</title>
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
            @foreach($ticket as $t)
             <h1><a href="/detailevent/{{ $t->id_event }}"> {{ $t->nama_event }} </a></h1>
             <br>
             <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&margin=10&bgcolor=248-224-193&color=503030&data=Myticket+{{ $t->id_event }}+{{ $t->nama_event }}" style="width:20%; margin-left:auto; margin-right:auto; border: 5px solid #555;">
             <br>
             <div style="width=75%">
             <h3>Deskripsi event</h3>
             <p>Jenis Event : {{ $t->nama_jenisevent }}</p>
             <p>{{ $t->deskripsi }} </p>
             <br>
             <b>
             <p>Tanggal : {{ $t->tanggal }}</p>
             <p>Waktu : {{ $t->waktu }}</p>
             <p>Tempat : {{ $t->tempat }}</p>
             <p>Jumlah tiket : {{ $t->jumlah }}</p>
            </b>
             </div>
             <br><br>
            @endforeach
         </div>
    </body>
</html>
