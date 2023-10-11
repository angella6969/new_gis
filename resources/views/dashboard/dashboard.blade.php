@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card bg-warning text-white  h-100">
                <div class="card-body">
                    <h2>Total Pengguna</h2>
                    <h3>{{ $users->count() }}</h3>
                    <div class="table-responsive">
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">Super Admin</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Clien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $users->count() }}</th>
                                    <th>0</th>
                                    <th>0</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="/" class="small text-white stretched-link"> Views Detail </a>
                    <div class="small text-white"><i class="fas fa-angel-right"></i></div>
                </div> --}}
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card bg-info text-white  h-100">
                <div class="card-body">
                    <h2>Total Daerah Irigasi</h2>
                    <h3>{{ $DaerahIrigasi->count() }}</h3>
                    <div class="table-responsive">
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">Daerah Irigasi</th>
                                    <th scope="col">P3-TGAI</th>
                                    {{-- <th scope="col">Clien</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $DaerahIrigasi->unique('DaerahIrigasi')->count() }}</th>
                                    <th>{{ $DaerahIrigasi->unique('names')->count() }}</th>

                                    {{-- <th>{{ $users->where('role_id', '2')->count() }}</th>
                                    <th>{{ $users->where('role_id', '3')->count() }}</th> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-2">
            <div class="card bg-danger text-white  h-100">
                <div class="card-body">
                    <h2>Total Panjang Irigasi</h2>
                    <div class="table-responsive">
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">Terbangun</th>
                                    <th scope="col">Belum Terbangun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $IrigasiDesaTerbangun }} M</th>
                                    <th>{{ $IrigasiDesaBelumTerbangun }} M</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                    <div id="bar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.highcharts.com/10/highcharts.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}

   <script src="{{ asset('js\highcharts.js') }}"></script>
    <script type="text/javascript">
       var dataJSON = {!! $dataJSON !!};
        Highcharts.chart('bar', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Chart P3-TGAI'
            },
        
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -35,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Mendapatkan P3-TGAI'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Mendapatkan P3-TGAI: <b>{point.y:.1f} Kali</b>'
            },
            series: [{
                name: 'Population',
                colors: [
                    '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
                    '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
                    '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
                    '#03c69b', '#00f194'
                ],
                colorByPoint: true,
                groupPadding: 0,
                data: dataJSON,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    </script>

@endsection
