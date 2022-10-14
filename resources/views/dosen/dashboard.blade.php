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
                            <h5 class="mb-0">3</h5>
                            <span class="badge btn-success-soft small">Lulus</span>
                        </div>
                        <div>
                            <h5 class="mb-0">3</h5>
                            <span class="badge btn-primary-soft small">Aktif</span>
                        </div>
                        <div>
                            <h5 class="mb-0">3</h5>
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
                    <div class="card">
                        <div id="grafik"></div>
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                        <script src="https://code.highcharts.com/modules/export-data.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
                        <script>
                            Highcharts.chart('grafik', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: '',
                                    align: 'left'
                                },
                                xAxis: {
                                    categories: ['2016', '2017', '2018', '2019', '2020', '2021', '2022'],
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
                                            enabled: true
                                        }
                                    }
                                },
                                series: [{
                                    name: 'Lulus',
                                    color: '#00c292',
                                    data: [0, 2, 6, 3]
                                }, {
                                    name: 'Aktif',
                                    color: '#00a8ff',
                                    data: [3, 5, 1, 13]
                                }, {
                                    name: 'Cuti',
                                    color: '#ff9f43',
                                    data: [14, 8, 8, 12]
                                }, ]
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>