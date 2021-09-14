<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $event = DB::table('event')->get();

        return view('home', ['event' => $event]);
    }

    public function show($id){
        $event = DB::table('event')->where('Id_event', $id)->get();
        return view('detailevent', ['event' => $event]);
    }

    public function beli(Request $request){

        $q = DB::table('pemesanan')
        ->where('id_pembeli', (string) Auth::user()->id)
        ->where('id_event', $request->id)
        ->get();

        if($q->isEmpty()){
            DB::table('pemesanan')->insert([
                'id_pembeli' => $request->id_pembeli,
                'id_event' => $request->id,
                'jumlah' => 1
            ]);
        }else{
            DB::table('pemesanan')
            ->where('id_pembeli', (string) Auth::user()->id)
            ->where('id_event', $request->id)
            ->increment('jumlah');
        }

        DB::table('event')
        ->where('Id_event', $request->id)
        ->decrement('tersedia');

        return redirect('/profile');
    }

    public function lihatTiket($id){

        $user = Auth::user();
        $ticket = DB::table('pemesanan')
        ->select(DB::raw('*, date_format(jam,\'%H:%i\') as waktu'))
        ->join('event', 'event.Id_event', '=', 'pemesanan.id_event')
        ->join('detailevent', 'event.Id_event', '=', 'detailevent.id_event')
        ->join('jenisevent', 'jenisevent.Id_jenis', '=', 'detailevent.id_jenisevent')
        ->where('id_pembeli', '=', (string) $user->id)
        ->where('id_pemesanan', '=', $id)
        ->get();

        return view('tiketdimiliki', ['ticket' => $ticket]);

    }

    public function cari(Request $request){

        $keyword = $request->keyword;
        $event = DB::table('event')
        ->where('nama_event', 'like', "%".$keyword."%")
        ->get();

        return view('carievent', ['event' => $event, 'request' => $request]);

    }
}
