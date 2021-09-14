<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){

        $user = Auth::user();
        $profile = DB::table('pembeli')->where('Id_pembeli', (string) $user->id)->get();
        $ticket = DB::table('pemesanan')
        ->select(DB::raw('*, date_format(jam,\'%H:%i\') as waktu'))
        ->join('event', 'event.Id_event', '=', 'pemesanan.id_event')
        ->join('detailevent', 'event.Id_event', '=', 'detailevent.id_event')
        ->join('jenisevent', 'jenisevent.Id_jenis', '=', 'detailevent.id_jenisevent')
        ->where('id_pembeli', '=', (string) $user->id)
        ->get();
        return view('profile', ['profile' => $profile, 'ticket' => $ticket]);

    }
}
