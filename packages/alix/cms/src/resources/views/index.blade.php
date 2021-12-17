@extends('cms::layouts.cms')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="mr-md-3 mr-xl-5">
                    <h2>欢迎，{{ auth()->user()->name }}。</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body dashboard-tabs p-0">
                <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">总览</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="inviter-tab" data-toggle="tab" href="#inviter" role="tab"
                            aria-controls="inviter" aria-selected="false">来源数据</a>
                    </li> --}}
                </ul>
                <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                            <div
                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account icon-lg mr-3 text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">今日新PV</small>
                                    <h5 class="mr-2 mb-0">{{$data['website'][0]}}</h5>
                                </div>
                            </div>
                            <div
                                class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account icon-lg mr-3 text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">今日新UV</small>
                                    <h5 class="mr-2 mb-0">{{$data['website'][3]}}</h5>
                                </div>
                            </div>
                            <div
                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account mr-3 icon-lg text-primary"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">总PV</small>
                                    <h5 class="mr-2 mb-0">{{$data['website'][1]}}</h5>
                                </div>
                            </div>
                            <div
                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <i class="mdi mdi-account mr-3 icon-lg text-success"></i>
                                <div class="d-flex flex-column justify-content-around">
                                    <small class="mb-1 text-muted">总UV</small>
                                    <h5 class="mr-2 mb-0">{{$data['website'][2]}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">最近30日访问数</p>
                <p class="mb-4"></p>
                <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                <canvas id="cash-deposits-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $().ready(function(){
        $(".input-urls").click(function(){
            $(this).select();
            document.execCommand('copy');
        });
        if ($('#cash-deposits-chart').length) {
            var cashDepositsCanvas = $("#cash-deposits-chart").get(0).getContext("2d");
            var data = {
                labels: @json($counts['label']),
                datasets: [
                    {
                        label: '网站PV',
                        data: @json($counts['PV']),
                        borderColor: [
                            '#ff4747'
                        ],
                        borderWidth: 2,
                        fill: false,
                        pointBackgroundColor: "#fff"
                    },
                    {
                        label: '网站UV',
                        data: @json($counts['UV']),
                        borderColor: [
                            '#4d83ff'
                        ],
                        borderWidth: 2,
                        fill: false,
                        pointBackgroundColor: "#fff"
                    },
                ]
            };
            var options = {
                scales: {
                yAxes: [{
                    display: true,
                    gridLines: {
                    drawBorder: false,
                    lineWidth: 1,
                    color: "#e9e9e9",
                    zeroLineColor: "#e9e9e9",
                    },
                    ticks: {
                    min: 0,
                    //max: Math.ceil(Math.max(...Object.values(counts))/10)*10,
                    //stepSize: Math.ceil(Math.max(...Object.values(counts))/10),
                    max: {{ $counts['max'] }},
                    stepSize: {{ $counts['stepSize'] }},
                    fontColor: "#6c7383",
                    fontSize: 16,
                    fontStyle: 300,
                    padding: 15
                    }
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                    drawBorder: false,
                    lineWidth: 1,
                    color: "#e9e9e9",
                    },
                    ticks : {
                    fontColor: "#6c7383",
                    fontSize: 16,
                    fontStyle: 300,
                    padding: 15
                    }
                }]
                },
                legend: {
                display: false
                },
                legendCallback: function(chart) {
                var text = [];
                text.push('<ul class="dashboard-chart-legend">');
                for(var i=0; i < chart.data.datasets.length; i++) {
                    text.push('<li><span style="background-color: ' + chart.data.datasets[i].borderColor[0] + ' "></span>');
                    if (chart.data.datasets[i].label) {
                    text.push(chart.data.datasets[i].label);
                    }
                }
                text.push('</ul>');
                return text.join("");
                },
                elements: {
                point: {
                    radius: 3
                },
                line :{
                    tension: 0
                }
                },
                stepsize: 1,
                layout : {
                padding : {
                    top: 0,
                    bottom : -10,
                    left : -10,
                    right: 0
                }
                }
            };
            var cashDeposits = new Chart(cashDepositsCanvas, {
                type: 'line',
                data: data,
                options: options
            });
            document.getElementById('cash-deposits-chart-legend').innerHTML = cashDeposits.generateLegend();
        }
    });
</script>
@endsection
