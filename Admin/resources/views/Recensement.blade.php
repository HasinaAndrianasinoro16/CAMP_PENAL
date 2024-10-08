<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ministère de la justice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .header button:hover {
            background-color: #0056b3;
        }
        .header .user-info {
            font-size: 16px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #fd7348;
            color: #fff;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        table td, table th {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="user-info"><h1>D.R.A.P {{ \Illuminate\Support\Facades\DB::table('region')->where('id',\Illuminate\Support\Facades\Auth::user()->region)->value('nom') }}</h1></div>
        <button id="export">PDF</button>
    </div>
    <table>
        <thead>
        <tr>
            <th>N d'ordre</th>
            <th>Camp pénal</th>
            <th>Localité</th>
            <th>Distance D.R.A.P</th>
            <th>Surface Total</th>
            <th>Surface Cultivable</th>
            <th>Surface non cultivable</th>
            <th>Situation juridique</th>
            <th>Exploité fonctionnel</th>
            <th>Litige</th>
        </tr>
        </thead>
        <tbody>
        @foreach($abouts as $about)
            <tr>
                <td>{{ $about->id_camp }}</td>
                <td>{{ $about->camp }}</td>
                <td>{{ $about->localite }}</td>
                <td>{{ $about->distance }}</td>
                <td>{{ $about->total }}</td>
                <td>{{ $about->cultivable }}</td>
                <td>{{ $about->ncultivable }}</td>
                <td>{{ $about->situation }}</td>
                <td>{{ $about->exploite_fonctionnel }}</td>
                <td>{{ $about->litige }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
</body>
</html>
