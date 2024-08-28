<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/logo/logo_sekolah.png')}}">
    <title>{{$title}}</title>
</head>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .header img {
        max-width: 100px;
        margin-bottom: 10px;
    }
    .header h3 {
        margin: 0;
    }
    .header p {
        margin: 5px 0;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
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
        border: 1px solid #dee2e6;
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
</style>
<body>
    <div class="header">
        <img src="{{public_path('/dist/img/logo.png')}}" alt="Logo">
        <h3>SK Taman Tun Dr. Ismail (2)</h3>
        <p>
            Jalan Abang Hj. Openg,<br>
            Taman Tun Dr. Ismail,<br>
            Kuala Lumpur, Malaysia.<br>
        </p>
    </div>
    <h2>{{$title}}</h2>
    <table cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Penyumbang</th>
                <th>Tarikh</th>
                <th>Jumlah (RM)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <b>{{$donation->transaction_invoiceno}}</b> - {{$donation->transaction_method}}<br>
                    <p>
                        {{strtoupper($donation->donor_name)}}<br>
                        {{$donation->donor_email}}<br>
                    </p>
                </td>
                <td>{{date('d/m/Y', strtotime($donation->transaction_issued_date))}}</td>
                <td style="text-align: right">{{number_format($donation->transaction_amount ,2)}}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3" style="text-align: right">Jumlah:</th>
                <td style="text-align: right">{{number_format($total, 2)}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
