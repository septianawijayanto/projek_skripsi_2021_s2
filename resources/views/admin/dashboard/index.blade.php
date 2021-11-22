@extends('admin.layouts.master')
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
                <div class="col-md-3">
                    <div class="metric">
                        <span style="background-color: pink;" class="icon"><i class="fa fa-users"></i></span>
                        <p>
                            <span class="number">{{ $anggota }}</span>
                            <span class="title">Anggota</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span style="background-color: purple;" class="icon"><i class="fa fa-book"></i></span>
                        <p>
                            <span class="number">{{ $buku }}</span>
                            <span class="title">Buku</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span style="background-color: red;" class="icon"><i class="fa fa-eye"></i></span>
                        <p>
                            <span class="number">274,678</span>
                            <span class="title">Visits</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span style="background-color: blue;" class="icon"><i class="fa fa-bar-chart"></i></span>
                        <p>
                            <span class="number">35%</span>
                            <span class="title">Conversions</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div id="headline-chart" class="ct-chart"><svg
                            xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="300"
                            class="ct-chart-line" style="width: 100%; height: 300;">
                            <g class="ct-grids">
                                <line y1="265" y2="265" x1="50" x2="182.71875" class="ct-grid ct-vertical"></line>
                                <line y1="229.28571428571428" y2="229.28571428571428" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="193.57142857142856" y2="193.57142857142856" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="157.85714285714286" y2="157.85714285714286" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="122.14285714285714" y2="122.14285714285714" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="86.42857142857142" y2="86.42857142857142" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="50.71428571428572" y2="50.71428571428572" x1="50" x2="182.71875"
                                    class="ct-grid ct-vertical"></line>
                                <line y1="15" y2="15" x1="50" x2="182.71875" class="ct-grid ct-vertical"></line>
                            </g>
                            <g>
                                <g class="ct-series ct-series-a">
                                    <path
                                        d="M50,265L50,172.143L72.12,129.286L94.24,165L116.359,50.714L138.479,157.857L160.599,165L182.719,86.429L182.719,265Z"
                                        class="ct-area"></path>
                                </g>
                                <g class="ct-series ct-series-b">
                                    <path
                                        d="M50,265L50,236.429L72.12,157.857L94.24,207.857L116.359,93.571L138.479,129.286L160.599,65L182.719,22.143L182.719,265Z"
                                        class="ct-area"></path>
                                </g>
                            </g>
                            <g class="ct-labels">
                                <foreignObject style="overflow: visible;" x="50" y="270" width="22.119791666666668"
                                    height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Mon</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="72.11979166666667" y="270"
                                    width="22.119791666666668" height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Tue</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="94.23958333333334" y="270"
                                    width="22.119791666666664" height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Wed</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="116.359375" y="270" width="22.11979166666667"
                                    height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Thu</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="138.47916666666669" y="270"
                                    width="22.11979166666667" height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Fri</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="160.59895833333334" y="270"
                                    width="22.119791666666657" height="20"><span class="ct-label ct-horizontal ct-end"
                                        style="width: 22px; height: 20px" xmlns="http://www.w3.org/2000/xmlns/">Sat</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" x="182.71875" y="270" width="30" height="20"><span
                                        class="ct-label ct-horizontal ct-end" style="width: 30px; height: 20px"
                                        xmlns="http://www.w3.org/2000/xmlns/">Sun</span></foreignObject>
                                <foreignObject style="overflow: visible;" y="229.28571428571428" x="10"
                                    height="35.714285714285715" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">10</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="193.57142857142856" x="10"
                                    height="35.714285714285715" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">15</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="157.85714285714283" x="10"
                                    height="35.71428571428571" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">20</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="122.14285714285714" x="10"
                                    height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">25</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="86.42857142857142" x="10"
                                    height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">30</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="50.71428571428572" x="10"
                                    height="35.714285714285694" width="30"><span class="ct-label ct-vertical ct-start"
                                        style="height: 36px; width: 30px" xmlns="http://www.w3.org/2000/xmlns/">35</span>
                                </foreignObject>
                                <foreignObject style="overflow: visible;" y="15" x="10" height="35.71428571428572"
                                    width="30"><span class="ct-label ct-vertical ct-start" style="height: 36px; width: 30px"
                                        xmlns="http://www.w3.org/2000/xmlns/">40</span></foreignObject>
                                <foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span
                                        class="ct-label ct-vertical ct-start" style="height: 30px; width: 30px"
                                        xmlns="http://www.w3.org/2000/xmlns/">45</span></foreignObject>
                            </g>
                        </svg></div>
                </div>
                <div class="col-md-3">
                    <div class="weekly-summary text-right">
                        <span class="number">2,315</span> <span class="percentage"><i
                                class="fa fa-caret-up text-success"></i> 12%</span>
                        <span class="info-label">Total Sales</span>
                    </div>
                    <div class="weekly-summary text-right">
                        <span class="number">$5,758</span> <span class="percentage"><i
                                class="fa fa-caret-up text-success"></i> 23%</span>
                        <span class="info-label">Monthly Income</span>
                    </div>
                    <div class="weekly-summary text-right">
                        <span class="number">$65,938</span> <span class="percentage"><i
                                class="fa fa-caret-down text-danger"></i> 8%</span>
                        <span class="info-label">Total Income</span>
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
