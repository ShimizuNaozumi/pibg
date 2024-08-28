<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/logo/logo_sekolah.png')}}">
    <title>{{$donation_invoiceno}}</title>
</head>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }
    .header {
        border-bottom: 1px solid black;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .header img {
        width: 80px;
    }
    .header h1 {
        margin: 0;
        font-size: 28px;
        color: #343a40;
    }
    .header p {
        margin-top:15px;
        font-size: 14px;
        color: #6c757d;
    }
    .title th, .title td{
        background-color: lightgrey;
        border: 0;
    }
    .summary th, .summary td {
        border: 1px solid #dee2e6;
    }
    table {
        margin-bottom: 30px;
        width: 100%;
    }
    thead{
        background-color: lightgrey;
        font-style: bold;
    }
    th, td {
        padding: 12px;
        text-align: left;
    }
    th {
        font-size: 16px;
        color: #343a40;
    }
    td {
        font-size: 14px;
        color: #495057;
    }
    .footer {
        margin-top: 20px;
        text-align: center;
        color: #6c757d;
    }
</style>
<body>
    <div class="header">
        <img src="{{public_path('/dist/img/logo.png')}}" alt="">
        <h3>SK Taman Tun Dr. Ismail (2)</h3>
        Jalan Abang Hj. Openg, <br>
        Taman Tun Dr. Ismail, <br>
        Kuala Lumpur, Malaysia.
        <p>
            Telefon (Pejabat): 03 - 77288441 <br>
            Emel:wba0057@moe.edu.my
        </p>
    </div>
    <table cellspacing="0" class="title">
        <tr>
            <th>Resit # {{$donation_invoiceno}}</th>
            <th style="text-align: right">{{$donation_date}}</th>
        </tr>
    </table>
    <table cellspacing="0" class="summary">
        <thead>
            <tr>
                <td colspan="2">Butiran Penyumbang</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="150">Nama</td>
                <td style="text-align: right;">{{$donor_name}}</td>
            </tr>
            <tr>
                <td>E-mel</td>
                <td style="text-align: right;">{{$donor_email}}</td>
            </tr>
            <tr>
                <td>No. Telefon</td>
                <td style="text-align: right;">{{$donor_notel}}</td>
            </tr>
        </tbody>
    </table>
    <table cellspacing="0" class="summary">
        <thead>
            <tr>
                <td colspan="2">Butiran Sumbangan</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="150">Nama Sumbangan</td>
                <td style="text-align: right;">{{$donation_name}}</td>
            </tr>
            <tr>
                <td>Tarikh Sumbangan</td>
                <td style="text-align: right;">{{$donation_date}}</td>
            </tr>
            <tr>
                <td>Jumlah Sumbangan</td>
                <td style="text-align: right;"><b>RM {{$donation_amount}}</b></td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        <p>Terima kasih atas sumbangan anda!</p>
    </div>
</body>
</html>
