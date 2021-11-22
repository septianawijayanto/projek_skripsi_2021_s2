<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    @include('auth.head')
</head>

<body>

    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="{{ asset('gambar') }}/Logo.png"
                                        alt="Klorofil Logo"></div>
                                <h4 class="lead">Selamat Datang</h4>
                            </div>

                            @include('auth.alert')
                            @yield('konten')
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">Sistem Informasi Perpustakaan</h1>
                            <p>SMP Negeri 9 Tebo</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('anggota.layouts.script') --}}

    @yield('scripts')
    <!-- END WRAPPER -->
</body>

</html>
