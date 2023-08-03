<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomor Antrian</title>
</head>
<body>
    <center>
        <h3>Nomor Antrian</h1>
        <h3>{{$nomor_antrian}}</h1>
        <h4>Dokter : {{$dokter}}</h4>
        <h4>Jam : {{$waktu_mulai}} - {{$waktu_selesai}}</h4>
        <div>
           <img src="{{ public_path() . '/qrcodes/qrcode.png' }}" alt="">
        </div>
        <p>Mohon Tetap Memakai Masker</p>
    </center>
</body>
</html>