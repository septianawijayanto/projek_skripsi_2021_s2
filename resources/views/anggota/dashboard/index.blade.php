@extends('anggota.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color: purple;" class="icon"><i class="fa fa-book"></i></span>
                        <p>
                            <span class="number">{{ $buku }}</span>
                            <span class="title">Buku</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color: red;" class="icon"><i class="fa fa-pencil"></i></span>
                        <p>
                            <span class="number">{{ $pinjam }}</span>
                            <span class="title">Pinjam</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color: blue;" class="icon"><i class="fa fa-check"></i></span>
                        <p>
                            <span class="number">{{ $selesai }}</span>
                            <span class="title">Selesai</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $("#Dashboard").addClass("active");
        $(document).ready(function() {
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })
        });

        // btn refresh
    </script>
@endsection
