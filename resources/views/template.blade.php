<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Boostrap V5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    @yield('css')

    <title>Fakultas Teknik</title>
</head>

<body class="p-3 mb-2 bg-primary text-white">
    <main class="container">
        <div class="text-left">
            <div class="row">
                <div class="col-md-4"><img src="img/UNHASY.png" class="rounded" alt="UNHASY" width="32px" height="32px" /> <span class="navbar-brand mb-0 h1">Fakultas Teknik</span></div>
                <div class="col-md-4 ms-auto d-flex justify-content-end align-items-center"><span class="navbar-brand h1">Layanan Satu Pintu</span></div>
            </div>
        </div>
        <div class="mt-3">
            <div class="card">
                <div class="card-body text-black">
                    @yield('main')
                </div>
            </div>
        </div>
        <footer class="mt-3">
            <div class="d-flex justify-content-end">
                <p><strong>OSS FT</strong> &#169; 2023 Fakultas Teknik Universitas Hasyim Asy'ari Tebuireng Jombang</p>
            </div>
        </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
    @yield('js')
</body>

</html>
