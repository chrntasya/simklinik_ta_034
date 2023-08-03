<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimNomorAntrianEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $nomor_antrian;
    protected $jadwal;
    protected $nama;
    protected $qrcode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomor_antrian, $jadwal, $qrcode, $nama)
    {
        $this->nomor_antrian = $nomor_antrian;
        $this->jadwal = $jadwal;
        $this->qrcode = $qrcode;
        $this->nama = $nama;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.antrian')
        ->subject('Pendaftaran Periksa')
        ->with(['nomor_antrian' => $this->nomor_antrian, 'jadwal' => $this->jadwal, 'qrcode' => $this->qrcode, 'nama' => $this->nama]);
    }
}
