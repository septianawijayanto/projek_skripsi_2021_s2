@extends('admin.layouts.master')
@section('konten')
    <div class="panel panel-profile">
        <div class="clearfix">
            <!-- LEFT COLUMN -->
            <div class="profile-left">
                <!-- PROFILE HEADER -->
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                        <img src="{{ $data->getGambar() }}" width="100" height="100" alt="Avatar">
                        <h3 class="name">{{ $data->judul_buku }}</h3>

                        <span class="online-status status-available">Available</span>
                    </div>
                </div>
                <!-- END PROFILE HEADER -->
                <!-- PROFILE DETAIL -->
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4 class="heading">{{ $title }}</h4>
                        <ul class="list-unstyled list-justify">
                            <li>Jumlah <span>{{ $data->jumlah }}</span></li>
                            <li>Di Pinjam <span>{{ $data->jml_dipinjam }}</span></li>
                            <li>Hilang <span>{{ $data->hilang }}</span></li>
                            <li>Rusak <span>{{ $data->rusak }}</span></li>
                            <li>Tahun Terbit <span>{{ $data->tahun_terbit }}</span></li>
                            <li>Tahun Pengadaan <span>{{ $data->tahun_pengadaan }}</span></li>
                        </ul>
                    </div>
                    <div class="text-center"><a href="{{ route('buku') }}" class="btn btn-primary">Kembali</a></div>
                </div>
                <!-- END PROFILE DETAIL -->
            </div>
            <!-- END LEFT COLUMN -->
            <!-- RIGHT COLUMN -->
            <div class="profile-right">
                <h4 class="heading">{{ $title }} {{ $data->judul_buku }} </h4>
                <!-- AWARDS -->
                <div class="awards">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="award-item">
                                <div class="hexagon">
                                    <span class="lnr lnr-sun award-icon"></span>
                                </div>
                                <span>Jumlah Tersedia {{ $data->jumlah }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="award-item">
                                <div class="hexagon">
                                    <span class="lnr lnr-clock award-icon"></span>
                                </div>
                                <span>Jumlah Dipinjam {{ $data->jml_dipinjam }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="award-item">
                                <div class="hexagon">
                                    <span class="lnr lnr-magic-wand award-icon"></span>
                                </div>
                                <span>Jumlah Hilang {{ $data->hilang }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="award-item">
                                <div class="hexagon">
                                    <span class="lnr lnr-heart award-icon"></span>
                                </div>
                                <span>Jumlah Rusak {{ $data->rusak }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END AWARDS -->
                <!-- TABBED CONTENT -->

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <ul class="list-unstyled activity-timeline">
                            <li>
                                <i class="fa fa-comment activity-icon"></i>
                                <p>Penulis <a href="#">{{ $data->penulis }}</a></p>
                            </li>
                            <li>
                                <i class="fa fa-cloud-upload activity-icon"></i>
                                <p>Klasifikasi <a href="#">{{ $data->klasifikasi->nama_klasifikasi }}</a> </p>
                            </li>
                            <li>
                                <i class="fa fa-plus activity-icon"></i>
                                <p>Penerbit <a href="#">{{ $data->penerbit->nama_penerbit }}</a> </p>
                            </li>
                            <li>
                                <i class="fa fa-plus activity-icon"></i>
                                <p>Sumber Dana <a href="#">{{ $data->sumber_dana }}</a> </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END TABBED CONTENT -->
            </div>
            <!-- END RIGHT COLUMN -->
        </div>
    </div>


@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

        });
    </script>


@endsection
