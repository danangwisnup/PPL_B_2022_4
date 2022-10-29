@include('layouts.sidebar')

<div class="vstack gap-4 col-md-9">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Mahasiswa</h5>
                    <br />
                    <div class="hstack gap-2 gap-xl-5 justify-content-center text-center">
                        <div>
                            <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Lulus')->count() }}</h5>
                            <span class="badge btn-success-soft small">Lulus</span>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Aktif')->count() }}</h5>
                            <span class="badge btn-primary-soft small">Aktif</span>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Cuti')->count() }}</h5>
                            <span class="badge btn-warning-soft small">Cuti</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mahasiswa per Angkatan</h5>
                    <br />
                    <div class="chart-container">
                        <div id="grafik"></div>

                        @section('script')

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                        <script src="https://code.highcharts.com/modules/export-data.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                var data = <?php echo json_encode($mahasiswaAll); ?>;
                                var tahun = [];
                                var lulus = [];
                                var aktif = [];
                                var cuti = [];
                                // grouping data by year
                                for (var i = 0; i < data.length; i++) {
                                    if (tahun.indexOf(data[i].angkatan) === -1) {
                                        tahun.push(data[i].angkatan);
                                    }
                                }
                                // grouping data by status
                                for (var i = 0; i < tahun.length; i++) {
                                    var lulusCount = 0;
                                    var aktifCount = 0;
                                    var cutiCount = 0;
                                    for (var j = 0; j < data.length; j++) {
                                        if (tahun[i] == data[j].angkatan) {
                                            if (data[j].status == 'Lulus') {
                                                lulusCount++;
                                            } else if (data[j].status == 'Aktif') {
                                                aktifCount++;
                                            } else if (data[j].status == 'Cuti') {
                                                cutiCount++;
                                            }
                                        }
                                    }
                                    lulus.push(lulusCount);
                                    aktif.push(aktifCount);
                                    cuti.push(cutiCount);
                                }
                                Highcharts.setOptions({
                                    exporting: {
                                        buttons: {
                                            contextButton: {
                                                text: 'Menu Chart',
                                                theme: {
                                                    'stroke-width': 1,
                                                    stroke: 'silver',
                                                    r: 5,
                                                    states: {
                                                        hover: {
                                                            fill: '#0d6efd',
                                                            style: {
                                                                color: 'white'
                                                            }
                                                        },
                                                        select: {
                                                            stroke: 'white',
                                                            fill: '#0d6efd'
                                                        }
                                                    }
                                                },
                                            }
                                        }
                                    }
                                });
                                Highcharts.chart('grafik', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Grafik Mahasiswa',
                                    },
                                    colors: ['#D6BBFB', '#9E77ED', '#6941C6'],
                                    xAxis: {
                                        categories: tahun,
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Jumlah Mahasiswa'
                                        },
                                        stackLabels: {
                                            enabled: true,
                                            style: {
                                                fontWeight: 'bold',
                                                color: ( // theme
                                                    Highcharts.defaultOptions.title.style &&
                                                    Highcharts.defaultOptions.title.style.color
                                                ) || 'gray',
                                                textOutline: 'none'
                                            }
                                        }
                                    },
                                    tooltip: {
                                        headerFormat: '<b>{point.x}</b><br/>',
                                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                                    },
                                    plotOptions: {
                                        column: {
                                            stacking: 'normal',
                                            dataLabels: {
                                                enabled: false
                                            },
                                            shadow: false,
                                            center: ['50%', '50%'],
                                            borderWidth: 0
                                        }
                                    },
                                    series: [{
                                        name: 'Aktif',
                                        data: aktif
                                    }, {
                                        name: 'Lulus',
                                        data: lulus
                                    }, {
                                        name: 'Cuti',
                                        data: cuti
                                    }]
                                });
                            });
                        </script>
                        @stop
                    </div>
                </div>
            </div>
        </div>
    </div>