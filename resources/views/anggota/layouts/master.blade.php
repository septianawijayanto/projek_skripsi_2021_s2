<!doctype html>
<html lang="en">

<head>
    @include('anggota.layouts.head')

</head>

<body>


    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">

                <span class="brand-text font-weight-light">Perpus</span>
                <!-- <a href="index.html"><img src="{{asset('klorofil')}}/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a> -->
            </div>

            <div class="container-fluid">

                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <!-- <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                        <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                    </div>
                </form> -->
                <!-- <div class="navbar-btn navbar-btn-right">
                    <a class="btn btn-success update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-anggota-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                </div> -->
                @include('anggota.layouts.navbar')
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    @include('anggota.layouts.sidebar')
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <!-- @include('anggota.layouts.alert') -->
                    @yield('konten')
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
                </p>
                  <strong>Copyright &copy; 2021 <a href="{{ env('DEV_URL') }}">{{ env('DEV_NAME') }}</a>.</strong>
            All rights reserved.
            </div>
        </footer>
    </div>

    @include('anggota.layouts.script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.myTable').DataTable();

            // $('.sync-ulang').click(function(e){
            //   e.preventDefault();
            //   $('#modal-sync').modal();
            // })

        });
    </script>

    @yield('scripts')

</body>

</html>