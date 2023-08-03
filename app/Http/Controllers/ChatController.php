<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\TransaksiTelemedicine;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function indexPasien($id){
        $id_transaksi = $id;
        $transaksi = TransaksiTelemedicine::where('id',$id_transaksi)->first();
        return view('pages.chat.pasien.chat',compact('id','transaksi'));
    }

    public function indexDokter($id){
        $id_transaksi = $id;
        $transaksi = TransaksiTelemedicine::where('id',$id_transaksi)->first();
        return view('pages.chat.dokter.chat',compact('id','transaksi'));
    }

    public function getChat(Request $request){
        $id = $request->id_transasction;
       

        $chat = Chat::with(['sender','receiver','transaksitelemedicine'])->where('transaction_telemedicine_id',$id)->orderBy('id','asc')->get();

        return response()->json([
            'data' => $chat,            
        ]);
    }

    public function addChat(Request $request){
        
        $data = Chat::create([
            'message' => $request->message,
            'sender_id' => $request->sender,
            'receiver_id' => $request->receiver,
            'transaction_telemedicine_id' => $request->id_transasction
        ]);

        return response()->json('Data berhasil ditambahkan');
    }



}
