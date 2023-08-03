<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css">
        .tabel {
            border-collapse: collapse;
        }

        .tabel td,
        th,
        tr {
            border: 1px solid black;
        }

        @media print {
            .tabpage {
                page-break-after: always
            }
        }
    </style>
</head>

<body style="font-family: sans-serif;">
    <table width="100%" style="margin-top: 0px; border-collapse:collapse;">
        <tr>
            <td colspan="6" style=" border-bottom: 1px solid black;text-align: center">RESEP OBAT</td>

        </tr>     
        <tr>
            <td colspan="6" style="border-bottom: 1px solid black;">
                <table border="0" width="100%">   
                    <tr>
                        <td style="font-size: 70%;width:10%">Nama Dokter</td>                
                        <td style="font-size: 70%;width:90%;text-align: right">{{now()->format('d F Y')}}</td>    
                    </tr>                 
                    <tr>
                        <td style="font-size: 90%; width:50%">{{strtoupper($rekammedis->dokter->nama) }}</td>                                       
                    </tr>                                                     
                </table>
            </td>
        </tr>
        {{-- <hr style="margin-bottom: 0px; margin-top: 0px; border-width: 1px 0px 0px;"> --}}
        <tr>
            <td colspan="6" style="border-bottom: 1px solid black;">
                <table border="0" width="100%">   
                    <tr>
                        <td style="font-size: 70%;width:10%">Nama Pasien</td>                
                    </tr>                  
                    <tr>
                        <td style="font-size: 90%; width:50%">{{strtoupper($rekammedis->pasien->nama) }}</td>                                       
                    </tr>
                    <tr>
                        <td style="font-size: 70%;width:10%">
                            @if ($rekammedis->pasien->jenis_kelamin == 'L')
                                <span>Laki-Laki</span>
                            @else
                                <span>Perempuan</span>
                            @endif
                             , {{\Carbon\Carbon::parse($rekammedis->pasien->tanggal_lahir)->format('d F Y')}}</td>                
                    </tr>                                      
                </table>
            </td>
        </tr>
        {{-- <hr style="margin-bottom: 0px; margin-top: 0px; border-width: 1px 0px 0px;"> --}}
        <tr>
            <td colspan="6" style="border-bottom: 1px solid black;">
                <table border="0"  width="100%">   
                    <tr>                                                    
                        <td style="font-size: 70%;text-align: center">Jika kamu mengalami gejala berat atau tidak kunjung membaik <br>kunjungi fasilitas kesehatan terdekat</td>                
                    </tr>                  
                    @php
                        $no=1
                    @endphp
                    @foreach ($rekammedis->resepobatbaru->resepobatdetails as $item)
                        <tr>                        
                            <td style="font-size: 89%; width:98%">{{$no++}}. {{strtoupper($item->obat->nama) }} {{strtoupper($item->jumlah_obat)}} {{strtoupper($item->obat->satuan) }}</td>                                
                        </tr>
                        <tr>
                            <td style="font-size: 70%;width:10%">&nbsp; &nbsp; &nbsp;{{ucfirst($item->obat->keterangan)}}</td>                                    
                        </tr> 
                    @endforeach                                                                                                                                   
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="6" style="border-bottom: 1px solid black;margin-right:10px">        
                <table border="0"  width="100%">
                    <tr>                       
                        <td style="font-size: 80%;text-align: right"> Penanggung Jawab </td>
                    </tr>
                    <tr>
                       
                        <td style="font-size: 80%; vertical-align: top; text-align: right;">
                            <br /><br /><br>( . . . . . . . . . . . . . . . . )
                        </td>
                    </tr>
                </table>                         
            </td>
        </tr>
       

    </table>

</body>

</html>
