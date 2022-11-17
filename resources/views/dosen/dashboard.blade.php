@include('layouts.sidebar')

<div class="vstack gap-4 col-md-9">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Mahasiswa</h5>
                    <br />
                    <div class="table-responsive">
                        <table class="center-aligned-table" align="center">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 70px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Aktif')->count() }}</h5>
                                        <span class="badge btn-success-soft small">Aktif</span>
                                    </th>
                                    <th style="text-align: center; width: 70px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Cuti')->count() }}</h5>
                                        <span class="badge btn-primary-soft small">Cuti</span>
                                    </th>
                                    <th style="text-align: center; width: 70px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Mangkir')->count() }}</h5>
                                        <span class="badge btn-warning-soft small">Mangkir</span>
                                    </th>
                                    <th style="text-align: center; width: 70px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'DO')->count() }}</h5>
                                        <span class="badge btn-danger-soft small">DO</span>
                                    </th>
                                    <th style="text-align: center; width: 70px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Undur Diri')->count() }}</h5>
                                        <span class="badge btn-secondary-soft small">Undur Diri</span>
                                    </th>
                                    <th style="text-align: center; width: 160px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Meninggal Dunia')->count() }}</h5>
                                        <span class="badge bg-dark bg-opacity-25 small">Meninggal Dunia</span>
                                    </th>
                                    <th style="text-align: center; width: 40px;">
                                        <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Lulus')->count() }}</h5>
                                        <span class="badge btn-info small">Lulus</span>
                                    </th>
                                </tr>
                            </thead>

                        </table>
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
                                var aktif = [];
                                var cuti = [];
                                var mangkir = [];
                                var dropout = [];
                                var undurdiri = [];
                                var meninggal = [];
                                var lulus = [];

                                // grouping data by year
                                for (var i = 0; i < data.length; i++) {
                                    if (tahun.indexOf(data[i].angkatan) === -1) {
                                        tahun.push(data[i].angkatan);
                                    }
                                }
                                // grouping data by status
                                for (var i = 0; i < tahun.length; i++) {
                                    var aktifCount = 0;
                                    var cutiCount = 0;
                                    var mangkirCount = 0;
                                    var dropoutCount = 0;
                                    var undurdiriCount = 0;
                                    var meninggalCount = 0;
                                    var lulusCount = 0;
                                    for (var j = 0; j < data.length; j++) {
                                        if (tahun[i] == data[j].angkatan) {
                                            if (data[j].status == 'Aktif') {
                                                aktifCount++;
                                            } else if (data[j].status == 'Cuti') {
                                                cutiCount++;
                                            } else if (data[j].status == 'Mangkir') {
                                                mangkirCount++;
                                            } else if (data[j].status == 'DO') {
                                                dropoutCount++;
                                            } else if (data[j].status == 'Undur Diri') {
                                                undurdiriCount++;
                                            } else if (data[j].status == 'Meninggal Dunia') {
                                                meninggalCount++;
                                            } else if (data[j].status == 'Lulus') {
                                                lulusCount++;
                                            }
                                        }
                                    }
                                    aktif.push(aktifCount);
                                    cuti.push(cutiCount);
                                    mangkir.push(mangkirCount);
                                    dropout.push(dropoutCount);
                                    undurdiri.push(undurdiriCount);
                                    meninggal.push(meninggalCount);
                                    lulus.push(lulusCount);
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
                                    colors: ['#80dcc0', '#81b3f5', '#fad879', '#e4707f', '#8f9294', '#c4c5c7', '#3b8aef'],
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
                                        name: 'Cuti',
                                        data: cuti
                                    }, {
                                        name: 'Mangkir',
                                        data: mangkir
                                    }, {
                                        name: 'DO',
                                        data: dropout
                                    }, {
                                        name: 'Undur Diri',
                                        data: undurdiri
                                    }, {
                                        name: 'Meninggal Dunia',
                                        data: meninggal
                                    }, {
                                        name: 'Lulus',
                                        data: lulus
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