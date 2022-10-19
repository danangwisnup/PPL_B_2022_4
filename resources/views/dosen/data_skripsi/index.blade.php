@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>
        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-4 mb-3">
                                <select class="form-select shadow" id="angkatan" name="angkatan">
                                    <option selected>Semua Angkatan</option>
                                    @for ($i = 2015; $i <= date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Mahasiswa Skripsi per Angkatan</h5>
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
                                                var skripsi = <?php echo json_encode($mahasiswaSkripsi); ?>;
                                                var tahun = [];
                                                var sudah = [];
                                                var belum = [];
                                                // grouping data by year
                                                for (var i = 0; i < data.length; i++) {
                                                    if (tahun.indexOf(data[i].angkatan) === -1) {
                                                        tahun.push(data[i].angkatan);
                                                    }
                                                }
                                                // grouping data by status
                                                for (var i = 0; i < tahun.length; i++) {
                                                    var sudahCount = 0;
                                                    var belumCount = 0;

                                                    // count data by year select nim from skripsi and get status
                                                    for (var j = 0; j < data.length; j++) {
                                                        if (tahun[i] == data[j].angkatan) {
                                                            for (var k = 0; k < skripsi.length; k++) {
                                                                if (data[j].nim == skripsi[k].nim) {
                                                                    if (skripsi[k].status == 'Lulus') {
                                                                        sudahCount++;
                                                                    } else {
                                                                        belumCount++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    sudah.push(sudahCount);
                                                    belum.push(belumCount);
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
                                                        text: 'Grafik Mahasiswa Skripsi',
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
                                                    legend: {
                                                        align: 'left',
                                                        x: 70,
                                                        verticalAlign: 'top',
                                                        y: 70,
                                                        floating: true,
                                                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                                                        borderColor: '#CCC',
                                                        borderWidth: 1,
                                                        shadow: false
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
                                                        name: 'Sudah',
                                                        data: sudah
                                                    }, {
                                                        name: 'Belum',
                                                        data: belum
                                                    }]
                                                });
                                            });
                                        </script>

                                        @include('sweetalert::alert')

                                        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                                        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                                        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                                        <script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
                                        <script src="{{ asset('assets/js/data-table.js') }}"></script>

                                        @stop
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 pt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Rincian Data Mahasiswa Skripsi</h5>
                                    <div class="col-12">
                                        <div class="d-flex flex-column align-items-end mb-4">
                                            <button class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Cetak</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="table_1">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Angkatan</th>
                                                        <th>Nilai</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Siapa</td>
                                                        <td>12345</td>
                                                        <td>2020</td>
                                                        <td class="bg-light bg-opacity-75">Kosong</td>
                                                        <td><span class="badge btn-danger-soft small">Belum</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kars</td>
                                                        <td>123464</td>
                                                        <td>2018</td>
                                                        <td>A</td>
                                                        <td><span class="badge btn-success-soft small">Lulus</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>123475</td>
                                                        <td>2019</td>
                                                        <td class="bg-light bg-opacity-75">Kosong</td>
                                                        <td><span class="badge btn-primary-soft small">Sedang</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection