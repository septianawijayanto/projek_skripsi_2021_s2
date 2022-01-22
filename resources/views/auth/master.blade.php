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
                            <p>{{ env('STORE_NAME') }}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">Shared by <i class="fa fa-love"></i><a
                        href="https://bootstrapthemes.co">BootstrapThemes</a>
                </p>
                <strong>Copyright &copy; 2021 <a href="{{ env('DEV_URL') }}">{{ env('DEV_NAME') }}</a>.</strong>
                All rights reserved.
            </div>
        </footer>
    </div>
    {{-- @include('anggota.layouts.script') --}}

    @yield('scripts')
    <!-- END WRAPPER -->
</body>

</html>
