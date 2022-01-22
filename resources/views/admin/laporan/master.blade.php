<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #333;
            text-align: left;
            font-size: 16px;
            margin: 0;
        }

        .container {
            margin: 0 auto;
            margin-top: 35px;
            padding: 0px;
            width: 100%;
            height: auto;
            background-color: #fff;
        }

        .col-lg-3 {
            margin: 0px;
            width: 30%;
        }

        .col-lg-6 {
            margin: 0px;
            width: 60%;
        }


        caption {
            font-size: 28px;
            margin-bottom: 15px;
        }

        table {
            border: 0px solid #333;
            border-collapse: collapse;
            margin: 0 auto;
            width: auto;
            width: 100%;
        }

        th {
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
            padding: 2px;
        }

        tr {
            border: 1px solid black;
        }

        img {
            width: 90px;
            height: 90px;
            border-radius: 100%;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .main-footer {
            width: 100%;
            height: 50px;
            padding: 2px;
            line-height: 50px;
            background: white;
            color: #333;
            position: absolute;
            bottom: 0px;
        }

        .main-header {
            width: 100%;
            height: 50px;
            padding: 2px;
            line-height: 50px;
            background: white;
            color: #333;
            position: absolute;
            bottom: 0px;
        }

        hr {
            border: 2px solid black double;
        }

    </style>
    <link rel="stylesheet" href="">
    <title>@yield('judul')</title>
</head>

<body>
    <table class="center">
        <tr>
            <td rowspan="3" class="center" style="border: 0px;">
                <img src="gambar/logo.jpeg" class="center" class="img img-responsive">
            </td>
            <td style="border: 0px;">
                <b>{{ env('STORE_PEMERINTAH')}}</b>
            </td>
            <td rowspan="3" class="center" style="border: 0px;">
                <img src="gambar/logotutwuri.png" class="center" class="img img-responsive">
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b> {{ env('STORE_DINAS')}}</b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">
                <b style="font-size: 30px;">{{ env('STORE_NAME')}}</b>
            </td>
        </tr>
        <tr>
            <td style="border: 0px;">NPSN : {{ env('STORE_NPSN')}}</td>
            <td style="border: 0px;">
                <font style="font-size: 20px;">{{ env('STORE_ADDRESS')}}, Kec.{{ env('STORE_KEC')}}, Kab. {{ env('STORE_KAB')}}, Prov. {{ env('STORE_PROV')}}, Kode Pos.{{ env('STORE_POS')}}</font>
            </td>
            <td style="border: 0px;">NSS : {{ env('STORE_NSS')}}</td>
        </tr>
    </table>
    <hr>
    @yield('konten')
    <p class="right">{{ env('STORE_KAB')}}, {{ $tgl }}</p>

    <br>
    <p class="right">{{Session::get('nama')}}</p>
</body>

</html>
