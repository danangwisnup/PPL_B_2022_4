@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <div class="col-md-8 col-lg-6 vstack gap-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Mahasiswa PKL per Angkatan</h5>
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
                                        var pkl = <?php echo json_encode($mahasiswaPKL); ?>;
                                        var tahun = [];
                                        var lulus = [];
                                        var sedang = [];
                                        var belum = [];
                                        // grouping data by year
                                        for (var i = 0; i < data.length; i++) {
                                            if (tahun.indexOf(data[i].angkatan) === -1) {
                                                tahun.push(data[i].angkatan);
                                            }
                                        }
                                        // grouping data by status
                                        for (var i = 0; i < tahun.length; i++) {
                                            var lulusCount = 0;
                                            var sedangCount = 0;
                                            var belumCount = 0;

                                            // count data by year select nim from pkl and get status
                                            for (var j = 0; j < data.length; j++) {
                                                if (tahun[i] == data[j].angkatan) {
                                                    for (var k = 0; k < pkl.length; k++) {
                                                        if (data[j].nim == pkl[k].nim) {
                                                            if (pkl[k].status == 'Lulus') {
                                                                lulusCount++;
                                                            } else if (pkl[k].status == 'Sedang Ambil') {
                                                                sedangCount++;
                                                            } else {
                                                                belumCount++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            lulus.push(lulusCount);
                                            sedang.push(sedangCount);
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
                                                text: 'Mahasiswa PKL',
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
                                                name: 'Belum Ambil',
                                                data: belum
                                            }, {
                                                name: 'Sedang Ambil',
                                                data: sedang
                                            }, {
                                                name: 'Lulus',
                                                data: lulus
                                            }]
                                        });
                                    });
                                </script>

                                @include('sweetalert::alert')

                                <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

                                <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
                                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
                                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
                                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

                                <script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
                                <script>
                                    var title = 'PKL';
                                </script>
                                <script src="{{ asset('assets/js/data-table.js') }}"></script>
                                <script>
                                    $(document).ready(function() {
                                        $("#table_1").DataTable().buttons().container().appendTo("#table_wrapper");
                                    });

                                    // change no from 1 if filter
                                    $('#table_1').on('draw.dt', function() {
                                        $('#table_1').DataTable().column(0, {
                                            search: 'applied',
                                            order: 'applied',
                                            page: 'applied'
                                        }).nodes().each(function(cell, i) {
                                            cell.innerHTML = i + 1;
                                        });
                                    });
                                </script>

                                @stop
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rincian Data Mahasiswa PKL</h5>
                            <div class="col-12">
                                <div class="d-flex flex-column align-items-end mb-4">
                                    <div id="table_wrapper"></div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div id="filter_col3" data-column="3">
                                            <label class="form-label text-dark">Pilih Angkatan</label>
                                            <select class="form-select column_filter" id="col3_filter">
                                                <option value="">Semua</option>
                                                @for ($i = 2015; $i <= date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div id="filter_col5" data-column="5">
                                            <label class="form-label text-dark">Pilih Status</label>
                                            <select class="form-select column_filter" id="col5_filter">
                                                <option value="">Semua</option>
                                                <option value="Belum Ambil">Belum Ambil</option>
                                                <option value="Sedang Ambil">Sedang Ambil</option>
                                                <option value="Lulus">Lulus</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table_1">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Angkatan</th>
                                                <th>Nilai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mahasiswaPKL as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nim }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->angkatan }}</td>
                                                <td>{{ $data->nilai }}</td>
                                                <td>
                                                    @if ($data->status == 'Lulus')
                                                    <span class="badge bg-success">{{ $data->status }}</span>
                                                    @elseif ($data->status == 'Sedang Ambil')
                                                    <span class="badge bg-warning">{{ $data->status }}</span>
                                                    @else
                                                    <span class="badge bg-danger">{{ $data->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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