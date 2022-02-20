@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" style="background-color: pink" class="btn btn-xs btn-refresh"><i
                    class="fa fa-refresh"></i></button>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color: pink;" class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ $anggota }}</span>
                            <span class="title">Anggota Siswa</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color:yellow;" class="icon"><i
                                class="fa fa-user-circle"></i></span>
                        <p>
                            <span class="number">{{ $guru }}</span>
                            <span class="title">Anggota Guru</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span style="background-color: yellowgreen;" class="icon"><i
                                class="fa fa-user-circle-o"></i></span>
                        <p>
                            <span class="number">{{ $anggota }}</span>
                            <span class="title">Anggota Staf</span>
                        </p>
                    </div>
                </div>
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
