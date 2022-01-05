<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('images') }}/logo.png" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ url('template') }}/css/style.min.css">
</head>

<body>

    <div class="row mt-3">
        <div class="col-3 text-right align-self-center">
            <img src="{{ url('images/logo.png') }}" alt="Satya Adhi Wicaksana" width="100" height="100">
        </div>
        <div class="col-6 text-center">
            <h5 class="text-dark"><strong>PENGADILAN AGAMA NEGARA</strong></h5>
            <small class="text-dark">
                Jl. Raya Negara-Kandangan Km.3,5 No.56 RT.03 RK.II/6 (0517) 51421 Desa Muning Tengah, Kec.Daha Selatan,
                Kab.Hulu Sungai Selatan, Prov.Kalimantan Selatan KP.71254
            </small>
            <small class="text-dark">Website : pa.negarakalsel.go.id Email :pa-negara@gmail.com</small>
        </div>
        <div class="col-3"></div>
    </div>
    <hr>


    <div class="container">
        @yield('content')
        <br>
        <br>

        <table class="ml-auto text-center text-dark">
            <tr>
                <td>WASALASA</td>
            </tr>
            <tr>
                <td>PANITERA</td>
            </tr>
            <tr>
                <td style="height: 80px"></td>
            </tr>
            <tr>
                <td><strong>H. HUSNAN TAPARROD, S.H.</strong></td>
            </tr>
            <tr>
                <td>NIP.19690528.199203.1.001</td>
            </tr>
        </table>
    </div>




    <script>
        // window.print()
    </script>

</body>

</html>
