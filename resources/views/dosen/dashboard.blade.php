@include('layouts.sidebar')

<div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Mahaiswa</h5>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="container overflow-hidden">
                                <div class="row gx-5">
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <p>0</p>
                                            <p>Aktif</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <p>0</p>
                                            <p>Lulus</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <p>0</p>
                                            <p>Cuti</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <p>0</p>
                                            <p>PKL</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 border bg-light">
                                            <p>0</p>
                                            <p>Skripsi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title">Mahasiswa Per Angkatan</h5>
                    <div class="card">
                        <div id="grafik"></div>
                        @section('grafik')
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script>
                            // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar
                            // Create the chart
                            // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

                            // Create the chart
                            Highcharts.chart('grafik', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    align: 'left',
                                    text: 'Jumlah Mahasiswa Per Angkatan'
                                },
                                accessibility: {
                                    announceNewData: {
                                        enabled: true
                                    }
                                },
                                xAxis: {
                                    type: 'category'
                                },
                                yAxis: {
                                    title: {
                                        text: 'Juumlah Mahasiswa'
                                    }

                                },
                                legend: {
                                    enabled: false
                                },
                                plotOptions: {
                                    series: {
                                        borderWidth: 0,
                                        dataLabels: {
                                            enabled: true,
                                            format: '{point.y:f}'
                                        }
                                    }
                                },

                                tooltip: {
                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                                },

                                series: [{
                                    name: "Angkatan",
                                    colorByPoint: true,
                                    data: [{
                                            name: "2016",
                                            y: 60
                                        },
                                        {
                                            name: "2017",
                                            y: 34
                                        },
                                        {
                                            name: "2018",
                                            y: 45
                                        },
                                        {
                                            name: "2019",
                                            y: 50
                                        },
                                        {
                                            name: "2020",
                                            y: 20
                                        },
                                        {
                                            name: "2021",
                                            y: 90
                                        },
                                        {
                                            name: "2022",
                                            y: 39
                                        }
                                    ]
                                }],
                            });
                        </script>
                        @stop
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>