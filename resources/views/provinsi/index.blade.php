@extends('app')
@section('content')
    <style>
        .title-page {
            color: #fff;
            font-weight: light;
            margin: 0px 0px 0px 10px;
            font-size: 30px;
        }

        th {
            white-space: nowrap !important;
        }

        /* -------------------------------------
                                                                                                                                             * Set to false if you are not using Chrome
                                                                                                                                             * ------------------------------------- */
        /* -------------------------------------
                                                                                                                                             * Styles
                                                                                                                                             * ------------------------------------- */
        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);

        h2,
        #note {
            margin: 0;
        }

        #timeline {
            margin-top: 100px;
            padding: 0;
            border-top: 8px solid #eee9dc;
            list-style: none;
            display: flex;
        }

        #timeline li {
            padding-top: 30px;
            position: relative;
            flex: 1;
            transition: all 0.4s ease-in-out;
        }

        label {
            max-width: 200px;
            margin: 0 auto;
            padding: 5px 10px;
            border-width: 2px;
            border-style: solid;
            border-color: #eee9dc;
            border-radius: 5px;
            position: absolute;
            left: 0;
            right: 0;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
        }

        label:before,
        label:after {
            content: "";
            width: 0;
            height: 0;
            border: solid transparent;
            position: absolute;
            bottom: 100%;
            pointer-events: none;
        }

        label:before {
            border-bottom-color: #eee9dc;
            border-width: 15px;
            left: 52%;
            margin-left: -15px;
        }

        label:after {
            border-bottom-color: #3f9cca;
            border-width: 12px;
            left: 52%;
            margin-left: -12px;
        }

        label span {
            text-align: center;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: block;
        }

        .top-label {
            width: 100%;
            padding-bottom: 30px;
            text-align: center;
            position: absolute;
            top: -60px;
            display: block;
        }

        .top-label-min {
            width: 100%;
            padding-bottom: 30px;
            text-align: left;
            position: absolute;
            top: -60px;
            display: block;
            left: -8px;
        }


        .top-label-max {
            width: 100%;
            padding-bottom: 30px;
            text-align: center;
            position: absolute;
            top: -60px;
            display: block;
            right: -8px;
        }

        .bottom-label {
            width: 100%;
            padding-bottom: 30px;
            text-align: center;
            position: absolute;
            bottom: -30px;
            display: block;
        }

        .bottom-label-min {
            width: 100%;
            padding-bottom: 30px;
            text-align: center;
            position: absolute;
            bottom: -30px;
            display: block;
            left: -50%;
        }

        .bottom-label-max {
            width: 100%;
            padding-bottom: 30px;
            text-align: center;
            position: absolute;
            bottom: -30px;
            display: block;
            left: 50%;
        }

        #indicator-nasional {
            color: #0dcaf0;
        }

        #indicator-provinsi {
            color: #0d6efd;
        }

        #indicator-proyeksi {
            color: #f73e4f;
        }

        .circle-black-min {
            width: 10px;
            height: 10px;
            margin-left: -5px;
            background: #3f9cca;
            border: 5px solid black;
            border-radius: 50%;
            position: absolute;
            top: -10px;
            left: 0%;
        }

        .circle-black-max {
            width: 10px;
            height: 10px;
            margin-left: -5px;
            background: #3f9cca;
            border: 5px solid black;
            border-radius: 50%;
            position: absolute;
            top: -10px;
            left: 100%;
        }

        .circle-blue {
            width: 10px;
            height: 10px;
            margin-left: -5px;
            background: #3f9cca;
            border: 5px solid #0dcaf0;
            color: #0dcaf0;
            border-radius: 50%;
            position: absolute;
            top: -10px;
            left: 50%;
        }

        .circle-red {
            width: 10px;
            height: 10px;
            margin-left: -5px;
            background: #3f9cca;
            border: 5px solid #f73e4f;
            border-radius: 50%;
            color: #f73e4f;
            position: absolute;
            top: -10px;
            left: 50%;
        }

        .circle-info {
            width: 10px;
            height: 10px;
            margin-left: -5px;
            background: #3f9cca;
            border: 5px solid #0d6efd;
            border-radius: 50%;
            color: #0d6efd;
            position: absolute;
            top: -10px;
            left: 50%;
        }

        .content {
            width: 800px;
            height: 240px;
            margin: 0 auto;
            border: 2px solid #eee9dc;
            border-radius: 8px;
            position: fixed;
            top: 200px;
            left: 0;
            right: 0;
            z-index: 100;
            background: #3f9cca;
            transform: perspective(1000px) rotateY(20deg);
            animation: switching_back 0.8s;
        }

        .content h3,
        .content p {
            margin: 0 20px 10px;
            text-align: justify;
            opacity: 0;
        }

        .content h3 {
            margin-top: 20px;
        }

        .radio {
            display: none;
        }

        .radio:checked+label {
            opacity: 1;
            transform: translateY(10px);
            transition: opacity 0.4s ease-in-out 0.25s, transform 0.3s ease-in-out 0.25s;
        }

        .radio:checked~.circle {
            background: #f98262;
        }

        .radio:checked~.content {
            z-index: 999;
            transform: perspective(1000px) rotateY(15deg) translate(40px, 25px);
            animation: switching 1s ease;
        }

        .radio:checked~.content h3,
        .radio:checked~.content p {
            opacity: 1;
            transition: opacity 0.4s ease-in-out 0.4s;
        }
    </style>
    <div class="container pt-5 mt-5">
    </div>
    <div style="background: url({{ asset('assets/img/bawah.png') }});
    background-position-y: center; padding:60px;">
        <div class="d-flex">
            <div class="p-2 flex-grow-1">
                <h1 class="title-page">IPK Provinsi <br> <span class="sub-title"
                        style="text-transform:capitalize;">{{ strtolower($provinsi->province_name) }}</span></h1>
            </div>
            <div class="p-2"> <img src="{{ asset('assets/img/propinsi') }}/{{ $provinsi->id }}.png"
                    style="max-width: 100px;"></div>
        </div>
    </div>
    <div class="row" id="block-content">
    </div>
    <div class="container mb-5 mt-5">
        <h4 class="text-center">Pilih provinsi lainnya</h4>
        <div class="d-flex flex-row-reverse">
            <button class="btn btn-primary" style="background: #6f42c1;margin-left:20px;border-color: #6f42c1;" data-bs-toggle="modal" data-bs-target="#unduhProvinceFile">
                <i class="fa fa-download"></i> Download
            </button>
            <div class="modal fade" id="unduhProvinceFile" tabindex="-1" aria-labelledby="unduhProvinceFileLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="unduhProvinceFileLabel">Unduh File Provinsi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php $tahun = ['2018-2020', '2021', '2022', '2023', '2024']; @endphp
                            @foreach ($tahun as $t)
                                @if(in_array($provinsi->id, config('app.dob')))
                                    @if($t == '2024')
                                        <div class="file-item">
                                            <span class="btn label-pdf">Data Hasil Perhitungan IPK Provinsi {{ $provinsi->province_name }} {{ $t }}</span>
                                            <a href="{{ URL::to('assets/provinsi-file/pdf') }}/{{ $provinsi->id }} - {{ $provinsi->province_name }} {{ $t }}.pdf" class="btn btn-download" target="_blank">@include('icons/pdf-icon')</a>
                                            <a href="{{ URL::to('assets/provinsi-file/excel') }}/{{ $provinsi->id }} - {{ $provinsi->province_name }} {{ $t }}.xlsx" class="btn btn-downloadexc" target="_blank">@include('icons/excel-icon')</a>    
                                        </div>
                                    @endif
                                @else
                                    <div class="file-item">
                                        <span class="btn label-pdf">Data Hasil Perhitungan IPK Provinsi {{ $provinsi->province_name }} {{ $t }}</span>
                                        <a href="{{ URL::to('assets/provinsi-file/pdf') }}/{{ $provinsi->id }} - {{ $provinsi->province_name }} {{ $t }}.pdf" class="btn btn-download" target="_blank">@include('icons/pdf-icon')</a>
                                        <a href="{{ URL::to('assets/provinsi-file/excel') }}/{{ $provinsi->id }} - {{ $provinsi->province_name }} {{ $t }}.xlsx" class="btn btn-downloadexc" target="_blank">@include('icons/excel-icon')</a>    
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" style="background: #6f42c1;
    border-color: #6f42c1;" type="button"
                onclick="print();"><i class="fa fa-print"> </i> Cetak Halaman</button>
        </div>
        <center>
            <div class="mb-3 row justify-content-center">
                <div for="staticEmail" class="col-md-2 col-form-label">Provinsi: </div>
                <div class="col-md-2 p-1">
                    <select name="provinsi" id="change-provinsi-dimensi" class="form-control form-control-sm">
                        <option disabled>Pilih Provinsi</option>
                        @foreach ($provinsiData as $provinsiValue)
                            @php
                                $selected = '';
                                if ($provinsiValue->province_name == $provinsi->province_name) {
                                    $selected = 'selected';
                                }
                            @endphp
                            <option value="{{ $provinsiValue->id }}" {{ $selected }}>
                                {{ $provinsiValue->province_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </center>
        <div class="row">
            <h3 class="text-primary mt-5 text-center">Grafik Nilai IPK</h3>
            <div class="col-md-6">
                <h5 class="text-center text-primary">Silahkan klik tahun</h5>
                <div class="chart-nasional">
                    @if(in_array($provinsi->id, config('app.dob')))
                        <canvas id="ipk-nasional-dob"></canvas>
                    @else
                        <canvas id="ipk-nasional"></canvas>
                    @endif
                </div>
            </div>
            <div class="col-md-4 offset-md-2 align-self-center">
                <div class="table-responsive" style="overflow: hidden;">
                    <table class="table border">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Nasional</th>
                                <th>{{ $provinsi->province_name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalData as $keyData => $dataValue)
                            @if((float) isset($totalData[$keyData][1][$provinsi->province_name]) ? $totalData[$keyData][1][$provinsi->province_name] : 0 != 0)
                                <tr>
                                    <td>{{ $keyData }}</td>
                                    <td>{{ number_format($totalData[$keyData][0]['NASIONAL'], 2, '.', '') }}</td>
                                    <td>{{ number_format((float) isset($totalData[$keyData][1][$provinsi->province_name]) ? $totalData[$keyData][1][$provinsi->province_name] : 0, 2, '.', '') }}
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if(in_array($provinsi->id, config('app.dob')))
                    <div class="row">
                        <p>{{ $provinsi->province_name }} merupakan provinsi baru dan mulai dihitung sejak tahun 2024</p>
                    </div>  
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="text-primary text-center"> Perbandingan Nilai per Dimensi </h3>
        <center>
            <div class="mb-3 row justify-content-center">
                <div for="staticEmail" class="col-md-2 col-form-label">Tahun: </div>
                <div class="col-md-2 p-1">
                    <select name="year" id="change-year-dimensi" class="form-control form-control-sm">
                        <option disabled>Pilih Tahun</option>
                        @foreach ($year as $yearData)
                            <option value="{{ $yearData }}">{{ $yearData }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </center>
        <div class="col-md-12">
            <div id="canvas-dimension">
                <canvas id="dimension-bar"></canvas>
            </div>
        </div>
    </div>
    <div class="container mt-5 pt-5">
        <h3 class="text-primary text-center"> Rincian Nilai per Indikator </h3>
        <center>
            <div class="mb-3 row justify-content-center">
                <div for="staticEmail" class="col-md-2 col-form-label">Tahun: </div>
                <div class="col-md-2 p-1">
                    <select name="year" id="change-year-indicator" class="form-control form-control-sm">
                        <option disabled>Pilih Tahun</option>
                        @foreach ($year as $yearData)
                            <option value="{{ $yearData }}">{{ $yearData }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </center>
        <h5 class="text-center"> Klik pada masing masing logo untuk melihat nilai per indikator </h5>
        <center>
            <div class="owl-carousel owl-theme">
                @foreach ($dimensi as $dataDimensi)
                    <div class="item">
                        <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
                            <span class="dimension-action" style="cursor:pointer;"
                                data-slug="{{ $dataDimensi['dimension_slug'] }}" data-id="{{ $dataDimensi['id'] }}"
                                data-name="{{ $dataDimensi['dimension_name'] }}">
                                <img class="img-fluid img-center"
                                    src="{{ asset('assets/img') }}/{{ $dataDimensi['dimension_icon'] }}"
                                    style="width: 100px !important;">
                                <span class="text-center">{{ $dataDimensi['dimension_name'] }}</span>
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        </center>
    </div>
    <div id="line-chart">
        <div class="container border mb-5 mt-5">
            <h3 id="title-line" class="mt-3"></h3>
            <div class="d-flex justify-content-end" id="sticky-custom">
                <p class="p-2" style="color:#204498;">{{ $provinsi->province_name }}</p>
                <p class="p-2">Nasional</p>
                <p class="p-2 text-danger">Proyeksi 2024</p>
            </div>
            <div class="row p-1" id="line-chart-new">
            </div>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center dimension-province-desc desc-container">
                <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2 fw-bold">Deskripsi</h3>
                            <span id="dimension-province-desc"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row-reverse">
        <p style="font-size:12px;margin-right:25px">
            * Disclaimer : nilai proyeksi 2024 merupakan hasil perhitungan berdasarkan serias data sebelumnya.
        </p>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            let labelYear = '2018';
            let initYear = '2018';
            let provinceNasional = '1001';
            let provinceSelected = "{{ $provinsi->id }}";
            let year = "{{ $year[0] }}";
            let yearBar = "{{ $year[0] }}";
            let dob = JSON.parse("{{ json_encode(config('app.dob')) }}");

            function drawTextAtIndex(scale, index, icon, text, value) {
                const offset = -5;
                const r = scale.drawingArea + offset;
                const angle = scale.getIndexAngle(index) - Math.PI / 2;
                const x = scale.xCenter + Math.cos(angle) * r;
                const y = scale.yCenter + Math.sin(angle) * r;
                const ctx = scale.ctx;
                ctx.save();
                ctx.translate(x, y);
                //ctx.rotate(angle + Math.PI / 2);
                ctx.textAlign = 'center';
                const image = new Image();
                image.src = icon;
                ctx.fillStyle = 'blue';
                ctx.font = '20px material-icons'
                ctx.drawImage(image, -10, -15, 30, 30);

                ctx.font = "12px 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif";
                ctx.fillStyle = 'gray';
                // ctx.fillText(text, 0, -5);
                ctx.restore();
            }
            // logic to get new data
            const getDataAreaProvince = (year, provinceId) => {
                const urlAreaNasional = "{{ url('/chart/area-nasional') }}";
                $.ajax({
                    url: urlAreaNasional + '/' + year + '/province-id' + '/' + provinceId,
                    success: function(data) {
                        if(dob.includes(parseInt(provinceId))){ 
                            $('#ipk-nasional-dob').remove();
                            $('.chart-nasional').append('<canvas id="ipk-nasional-dob"><canvas>');
                            const ctx_live = document.getElementById("ipk-nasional-dob");
                            const myChartDob = new Chart(ctx_live, {
                                type: 'radar',
                                data: {
                                    labels: [],
                                    images: [],
                                    datasets: [
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: '#0a9395',
                                            backgroundColor: '#0a9395',
                                            label: 2024,
                                            fill: false,
                                        }
                                    ]
                                },
                                options: {
                                    scale: {
                                        beginAtZero: true,
                                        max: 100,
                                        min: 0,
                                        stepSize: 10
                                    },
                                    responsive: true,
                                    interaction: {
                                        mode: 'index'
                                    },
                                    elements: {
                                        line: {
                                            borderWidth: 3
                                        }
                                    },
                                    legend: {
                                        display: true,
                                        position: "bottom",
                                        labels: {
                                            fontColor: "#333",
                                            fontSize: 24
                                        }
                                    }
                                },
                                plugins: [{
                                    id: 'custom_labels',
                                    afterDraw: (chart, args) => {
                                        const getLabel = chart.config._config.data
                                            .labels;
                                        getLabel.forEach((value, i) => {
                                            const scale = chart.scales.r;
                                            drawTextAtIndex(scale, i, chart
                                                .config._config.data
                                                .images[i], value, chart
                                                .config._config.data
                                                .datasets[0].data[i]);
                                        });
                                    },
                                }]
                            })
                            myChartDob.data.images = [];
                            myChartDob.data.labels = [];

                            myChartDob.update();
                            $.ajax({
                                url: urlAreaNasional + '/' + '2024' +'/province-id' +'/' + provinceId,
                                success: function(data2024) {
                                    myChartDob.data.images = [];
                                    myChartDob.data.labels = [];
                                    for (let i = 0; i < data2024.length; i++) {
                                        myChartDob.data.images.push(data[i].dimension_icon);
                                        myChartDob.data.labels.push(data[i].dimension_name);
                                        myChartDob.data.datasets[0].data.push(data2024[i].dimension_value);
                                    };
                                    myChartDob.update();
                                }
                            });
                        }else{
                            console.log('bukan dob');
                            $('#ipk-nasional').remove();
                            $('.chart-nasional').append('<canvas id="ipk-nasional"><canvas>');
                            const ctx_live = document.getElementById("ipk-nasional");
                            const myChart = new Chart(ctx_live, {
                                type: 'radar',
                                data: {
                                    labels: [],
                                    images: [],
                                    datasets: [{
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'green',
                                            backgroundColor: 'green',
                                            label: labelYear,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'yellow',
                                            backgroundColor: 'yellow',
                                            label: 2019,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'red',
                                            backgroundColor: 'red',
                                            label: 2020,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'blue',
                                            backgroundColor: 'blue',
                                            label: 2021,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'purple',
                                            backgroundColor: 'purple',
                                            label: 2022,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: 'orange',
                                            backgroundColor: 'orange',
                                            label: 2023,
                                            fill: false,
                                        },
                                        {
                                            data: [],
                                            borderWidth: 1,
                                            borderColor: '#0a9395',
                                            backgroundColor: '#0a9395',
                                            label: 2024,
                                            fill: false,
                                        }
                                    ]
                                },
                                options: {
                                    scale: {
                                        beginAtZero: true,
                                        max: 100,
                                        min: 0,
                                        stepSize: 10
                                    },
                                    responsive: true,
                                    interaction: {
                                        mode: 'index'
                                    },
                                    elements: {
                                        line: {
                                            borderWidth: 3
                                        }
                                    },
                                    legend: {
                                        display: true,
                                        position: "bottom",
                                        labels: {
                                            fontColor: "#333",
                                            fontSize: 24
                                        }
                                    }
                                },
                                plugins: [{
                                    id: 'custom_labels',
                                    afterDraw: (chart, args) => {
                                        const getLabel = chart.config._config.data
                                            .labels;
                                        getLabel.forEach((value, i) => {
                                            const scale = chart.scales.r;
                                            drawTextAtIndex(scale, i, chart
                                                .config._config.data
                                                .images[i], value, chart
                                                .config._config.data
                                                .datasets[0].data[i]);
                                        });
                                    },
                                }]
                            })
                            myChart.data.images = [];
                            myChart.data.labels = [];
                            for (let i = 0; i < data.length; i++) {
                                myChart.data.images.push(data[i].dimension_icon);
                                myChart.data.labels.push(data[i].dimension_name);
                                myChart.data.datasets[0].data.push(data[i].dimension_value);
                            };

                            myChart.update();
                            $.ajax({
                                url: urlAreaNasional + '/' + '2019' + '/province-id' + '/' +
                                    provinceId,
                                success: function(data2019) {
                                    myChart.data.images = [];
                                    myChart.data.labels = [];
                                    for (let i = 0; i < data2019.length; i++) {
                                        myChart.data.images.push(data[i].dimension_icon);
                                        myChart.data.labels.push(data[i].dimension_name);
                                        myChart.data.datasets[1].data.push(data2019[i]
                                            .dimension_value);
                                    };
                                    myChart.update();
                                    $.ajax({
                                        url: urlAreaNasional + '/' + '2020' +
                                            '/province-id' + '/' + provinceId,
                                        success: function(data2020) {
                                            myChart.data.images = [];
                                            myChart.data.labels = [];
                                            for (let i = 0; i < data2020
                                                .length; i++) {
                                                myChart.data.images.push(data[i]
                                                    .dimension_icon);
                                                myChart.data.labels.push(data[i]
                                                    .dimension_name);
                                                myChart.data.datasets[2].data
                                                    .push(data2020[i]
                                                        .dimension_value);
                                            };

                                            myChart.update();
                                            $.ajax({
                                                url: urlAreaNasional +
                                                    '/' + '2021' +
                                                    '/province-id' +
                                                    '/' + provinceId,
                                                success: function(
                                                    data2021) {
                                                    myChart.data
                                                        .images = [];
                                                    myChart.data
                                                        .labels = [];
                                                    for (let i = 0; i < data2021.length; i++
                                                    ) {
                                                        myChart.data
                                                            .images
                                                            .push(
                                                                data[i].dimension_icon
                                                            );
                                                        myChart.data
                                                            .labels
                                                            .push(
                                                                data[
                                                                    i
                                                                ]
                                                                .dimension_name
                                                            );
                                                        myChart.data
                                                            .datasets[
                                                                3]
                                                            .data
                                                            .push(
                                                                data2021[
                                                                    i
                                                                ]
                                                                .dimension_value
                                                            );
                                                    };

                                                    myChart.update();
                                                    $.ajax({
                                                        url: urlAreaNasional +
                                                            '/' + '2022' +
                                                            '/province-id' +
                                                            '/' + provinceId,
                                                        success: function(
                                                            data2022) {
                                                            myChart.data
                                                                .images = [];
                                                            myChart.data
                                                                .labels = [];
                                                            for (let i =
                                                                    0; i <
                                                                data2022
                                                                .length; i++
                                                            ) {
                                                                myChart.data
                                                                    .images
                                                                    .push(
                                                                        data[
                                                                            i
                                                                        ]
                                                                        .dimension_icon
                                                                    );
                                                                myChart.data
                                                                    .labels
                                                                    .push(
                                                                        data[
                                                                            i
                                                                        ]
                                                                        .dimension_name
                                                                    );
                                                                myChart.data
                                                                    .datasets[
                                                                        4]
                                                                    .data
                                                                    .push(
                                                                        data2022[
                                                                            i
                                                                        ]
                                                                        .dimension_value
                                                                    );
                                                            };

                                                            myChart.update();
                                                            $.ajax({
                                                                url: urlAreaNasional +
                                                                    '/' + '2023' +
                                                                    '/province-id' +
                                                                    '/' + provinceId,
                                                                success: function(data2023) {
                                                                    myChart.data.images = [];
                                                                    myChart.data.labels = [];
                                                                    for (let i = 0; i < data2023 .length; i++) {
                                                                        myChart.data.images.push(data[i].dimension_icon);
                                                                        myChart.data.labels.push(data[i].dimension_name);
                                                                        myChart.data.datasets[5].data.push(data2023[i].dimension_value);
                                                                    };
                                                                    myChart.update();
                                                                    $.ajax({
                                                                        url: urlAreaNasional + '/' + '2024' +'/province-id' +'/' + provinceId,
                                                                        success: function(data2024) {
                                                                            myChart.data.images = [];
                                                                            myChart.data.labels = [];
                                                                            for (let i = 0; i < data2024.length; i++) {
                                                                                myChart.data.images.push(data[i].dimension_icon);
                                                                                myChart.data.labels.push(data[i].dimension_name);
                                                                                myChart.data.datasets[6].data.push(data2024[i].dimension_value);
                                                                            };
                                                                            myChart.update();
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            };
            // const getTotalAreaNasional = (provinceId) => {
            //   const urlTotalAreaNasional = "{{ url('/chart/area-nasional') }}";
            //   $.ajax({
            //     url: urlTotalAreaNasional + '/2018' + '/province-id' + '/' + provinceId + '/total',
            //     success: function(data) {
            //       if (data) {
            //         $("#total-ipk-nasional-2018").text(data.total);
            //       }
            //     }
            //   });
            //   $.ajax({
            //     url: urlTotalAreaNasional + '/2019' + '/province-id' + '/' + provinceId + '/total',
            //     success: function(data) {
            //       if (data) {
            //         $("#total-ipk-nasional-2019").text(data.total);
            //       }
            //     }
            //   });
            //   $.ajax({
            //     url: urlTotalAreaNasional + '/2020' + '/province-id' + '/' + provinceId + '/total',
            //     success: function(data) {
            //       if (data) {
            //         $("#total-ipk-nasional-2020").text(data.total);
            //       }
            //     }
            //   });
            // }
            const getTotalAreaProvince = (provinceId) => {
                const urlTotalAreaProvince = "{{ url('/chart/area-nasional') }}";
                $.ajax({
                    url: urlTotalAreaProvince + '/2018' + '/province-id' + '/' + provinceId + '/total',
                    success: function(data) {
                        if (data) {
                            $("#total-ipk-provinsi-2018").text(data.total);
                        }
                    }
                });
                $.ajax({
                    url: urlTotalAreaProvince + '/2019' + '/province-id' + '/' + provinceId + '/total',
                    success: function(data) {
                        if (data) {
                            $("#total-ipk-provinsi-2019").text(data.total);
                        }
                    }
                });
                $.ajax({
                    url: urlTotalAreaProvince + '/2020' + '/province-id' + '/' + provinceId + '/total',
                    success: function(data) {
                        if (data) {
                            $("#total-ipk-provinsi-2020").text(data.total);
                        }
                    }
                });
            }
            $('#line-chart').hide();

            const getDimensionProvince = (year, provinceId, dimensionId) => {
                const urlDimensionProvince = "{{ url('/chart/dimension-province') }}";
                $.ajax({
                    url: urlDimensionProvince,
                    type: 'get',
                    data: {
                        year,
                        province_id: provinceId,
                        dimension_id: dimensionId,
                    },
                    success: function(data) {
                        const dataDimensionProvince = data[0];
                        if (dataDimensionProvince.desc) {
                            $('.row.dimension-province-desc').css('display', 'flex');
                            $('#dimension-province-desc').text(dataDimensionProvince.desc)
                        } else {
                            $('.row.dimension-province-desc').css('display', 'none');
                        }
                    }
                })
            }

            const getDimensionIndicator = (year, provinceId, dimensionId) => {
                const urlIndicatorProvince = "{{ url('/chart/indicator-province') }}";
                $.ajax({
                    url: urlIndicatorProvince,
                    type: "get",
                    data: {
                        year,
                        province_id: provinceId,
                        dimension_id: dimensionId,
                    },
                    success: function(dataProvince) {
                        $.ajax({
                            url: urlIndicatorProvince,
                            type: "get",
                            data: {
                                year,
                                province_id: '1001',
                                dimension_id: dimensionId,
                            },
                            success: function(dataNasional) {
                                dataNasional.forEach((n, j) => {
                                    const indexData = dataProvince.map(function(
                                        o) {
                                        return o.indicator_code;
                                    }).indexOf(n.indicator_code);
                                    if (indexData >= 0) {
                                        dataProvince[indexData]
                                            .indicator_nasional = n
                                            .indicator_value;
                                    }
                                });
                                let description = '';
                                $('#line-chart').show();

                                function generateDescription(item, index) {
                                    description +=
                                        `<div class="col-md-6 pt-5"><div style="padding-bottom:15px;"><h6 class="fw-bold"> Indikator ${item.indicator_code.split(".")[0]}.${index+1} </h6></div><p>${item.indicator_description}</p></div>
           <div class="col-md-6 pt-5"><canvas height="200" class="chart-line-new" id="chart-indicator-${index}"></canvas></div>`;
                                }

                                function generateChart(item, index) {
                                    const nMin = item.min;
                                    const nMax = item.max;

                                    const indicatorCtx = $("body").find('#chart-indicator-' + index);
                                    const indicatorLine = new Chart(indicatorCtx, {
                                        type: 'line',
                                        plugins: [ChartDataLabels],
                                        data: {
                                            labels: [''],
                                            images: [],
                                            datasets: [
                                                {
                                                    label: 'Min',
                                                    data: [item.min],
                                                    backgroundColor: 'black',
                                                    borderColor: 'black',
                                                    datalabels: {
                                                        clip: true,
                                                        offset: -70,
                                                        align: 'top',
                                                        anchor: 'end',
                                                        formatter: (val) =>(`Min\n${nMin}`),
                                                        labels: {
                                                            value: {
                                                                color: 'black',
                                                                font: {
                                                                    size: 12,
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    label: "{{ $provinsi->province_name }}",
                                                    backgroundColor: '#204498',
                                                    pointRadius: 5,
                                                    pointHoverRadius: 5,
                                                    borderColor: '#204498',
                                                    data: [item
                                                        .indicator_value
                                                    ],
                                                    datalabels: {
                                                        offset: 8,
                                                        align: 'top',
                                                        anchor: 'end',
                                                        formatter: (val) =>(`${val}`),
                                                        labels: {
                                                            value: {
                                                                color: '#204498',
                                                                font: {
                                                                    size: 12,
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    label: 'Nasional',
                                                    backgroundColor: '#444444',
                                                    pointRadius: 6,
                                                    pointHoverRadius: 6,
                                                    borderColor: '#444444',
                                                    data: [item
                                                        .indicator_nasional
                                                    ],
                                                    datalabels: {
                                                        offset: -35,
                                                        align: 'top',
                                                        anchor: 'end',
                                                        formatter: (val) =>(`${val}`),
                                                        labels: {
                                                            value: {
                                                                color: '#444444',
                                                                font: {
                                                                    size: 12,
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    label: 'Proyeksi 2024',
                                                    pointRadius: 5,
                                                    pointHoverRadius: 5,
                                                    backgroundColor: 'rgb(236 127 118)',
                                                    borderColor: 'rgb(236 127 118)',
                                                    data: [item.indicator_target_value > 0 ? item.indicator_target_value : null],
                                                    datalabels: {
                                                        offset: 25,
                                                        align: 'top',
                                                        anchor: 'end',
                                                        formatter: (val) =>(val > 0 ? `${val}` : ''),
                                                        labels: {
                                                            value: {
                                                                color: 'rgb(236 127 118)',
                                                                font: {
                                                                    size: 12,
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    // type: 'line',
                                                    label: 'Max',
                                                    backgroundColor: 'black',
                                                    // pointRadius: 5,
                                                    // pointHoverRadius: 5,
                                                    borderColor: 'black',
                                                    data: [item.max],
                                                    datalabels: {
                                                        offset: -70,
                                                        align: 'top',
                                                        anchor: 'end',
                                                        formatter: (val) =>(`\nMax\n ${nMax}`),
                                                        labels: {
                                                            value: {
                                                                color: 'black',
                                                                font: {
                                                                    size: 12,
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                            ]
                                        },
                                        options: {
                                            layout: {
                                                padding: {
                                                    top: 45,
                                                    right: 40,
                                                    left: 0,
                                                    bottom: 40,
                                                }
                                            },
                                            maintainAspectRatio: false,
                                            plugins: {
                                                tooltip: {
                                                    enabled: true,
                                                },
                                                legend: {
                                                    display: false,
                                                },
                                                datalabels: {}
                                            },
                                            interaction: {
                                                mode: 'index'
                                            },
                                            indexAxis: 'y',
                                            scales: {
                                                x: {
                                                    position: 'right',
                                                    beginAtZero: false,
                                                    offset: false,
                                                    display: true,
                                                    grid: {
                                                        display: false,
                                                    },
                                                    position: 'top',
                                                    ticks: {
                                                        stepSize: 1,
                                                        display: false,
                                                    },
                                                },
                                                y: {
                                                    display: false,
                                                    grid: {
                                                        display: false,
                                                    },
                                                }
                                            },
                                        },
                                    })

                                }
                                dataProvince.forEach(generateDescription);
                                document.getElementById("line-chart-new").innerHTML = description;
                                dataProvince.forEach(generateChart);
                            }
                        });
                    }
                });

            }
            getDataAreaProvince('2018', provinceSelected);
            // getTotalAreaNasional(provinceNasional);
            getTotalAreaProvince(provinceSelected);
            $('#change-year-indicator').on('change', () => {
                year = $('#change-year-indicator').find(":selected").val();
                $('#line-chart').hide();
                $('.dimension-action').removeClass('text-success');
            });

            $('.dimension-action').on('click', function() {
                // change button
                let dimensionId = $(this).data('id');
                let dimensionName = 'Dimensi ' + $(this).data('name');
                $('#title-line').text(dimensionName + ' ' + year);
                $('.dimension-action').removeClass('text-success');
                $(this).addClass('text-success');
                getDimensionIndicator(year, provinceSelected, dimensionId);
                getDimensionProvince(year, provinceSelected, dimensionId);
            });

            const getBarData = (yearBar, provinceId) => {
                const urlIndicatorProvince = "{{ url('/chart/dimension-province') }}";
                $.ajax({
                    url: urlIndicatorProvince,
                    type: "get",
                    data: {
                        year: yearBar,
                        province_id: provinceId,
                    },
                    success: function(dataBar) {
                        $('#dimension-bar').remove();
                        $('#canvas-dimension').append('<canvas id="dimension-bar"><canvas>');
                        const resultData = dataBar;
                        const labelData = [];
                        const labelRank = [];
                        const valueData = [];
                        const valueDataNasional = [];
                        const labelTargetData = [];
                        const valueTargetData = [];
                        const options = {
                            plugins: {
                                legend: {},
                                datalabels: {}
                            },
                            responsive: true,
                            title: {
                                display: true,
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: true
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: [],
                                    },
                                },
                                y: {
                                    ticks: {
                                        label: [],
                                        value: [],
                                    },
                                }
                            }
                        };
                        $.ajax({
                            url: urlIndicatorProvince,
                            type: "get",
                            data: {
                                year: yearBar,
                                province_id: provinceNasional,
                            },
                            success: function(dataBarNasional) {
                                for (const i in resultData) {
                                    const newLabel = [resultData[i].dimension_name,
                                        resultData[i].rank
                                    ];
                                    labelData.push(newLabel);
                                    labelRank.push(resultData[i].rank);
                                    valueData.push(resultData[i].dimension_value);
                                    const indexData = dataBarNasional.map(function(o) {
                                        return o.dimension_name;
                                    }).indexOf(resultData[i].dimension_name);
                                    if (indexData >= 0) {
                                        let color = 'gray';
                                        if (dataBarNasional[indexData].dimension_value >
                                            resultData[i].dimension_value) {
                                            color = 'red';
                                        }
                                        if (resultData[i].rank == '1/34') {
                                            color = 'green';
                                        }
                                        options.scales.x.ticks.color.push(color);
                                        valueDataNasional.push(dataBarNasional[
                                            indexData].dimension_value);
                                    }
                                    labelTargetData.push(resultData[i].dimension_name);
                                    valueTargetData.push(resultData[i]
                                        .dimension_target);
                                }
                                const dimensionBar = document.getElementById(
                                    'dimension-bar').getContext('2d');
                                // create bar
                                const dimensionChart = new Chart(dimensionBar, {
                                    type: 'bar',
                                    plugins: [ChartDataLabels],
                                    data: {
                                        labels: labelData,
                                        datasets: [{
                                                label: 'Proyeksi 2024',
                                                data: valueTargetData,
                                                type: 'line',
                                                backgroundColor: 'rgb(236 127 118)',
                                                borderColor: 'rgb(236 127 118)',
                                                fill: false,
                                                pointRadius: 5,
                                                pointHoverRadius: 5,
                                                showLine: false,
                                            },
                                            {
                                                label: 'Nilai Dimensi Nasional Tahun ' +
                                                    yearBar,
                                                backgroundColor: '#ffffff',
                                                borderColor: '#6ea8e2',
                                                borderWidth: 2,
                                                data: valueDataNasional,
                                            },
                                            {
                                                label: 'Nilai Dimensi Provinsi {{ $provinsi->province_name }} Tahun ' +
                                                    yearBar,
                                                backgroundColor: '#4a66ac',
                                                borderColor: '#4a66ac;',
                                                data: valueData,
                                            },

                                        ]
                                    },
                                    options: options,
                                });
                                dimensionChart.options.scales.y.grid.borderColor =
                                    'black';
                                dimensionChart.options.scales.x.grid.borderColor =
                                    'black';
                                dimensionChart.options.scales.x.grid.display = false;
                                dimensionChart.options.scales.y.grid.display = false;
                                dimensionChart.options.scales.y.suggestedMax = 120;
                                dimensionChart.options.plugins.datalabels.align = 'end';
                                dimensionChart.options.plugins.datalabels.anchor =
                                    'end';
                                dimensionChart.options.plugins.datalabels.formatter = (
                                    val) => (`${val}`);
                                dimensionChart.update();
                            },
                        })
                    }
                });
            };

            getBarData(yearBar, provinceSelected);
            $('#change-year-dimensi').on('change', () => {
                let yearBarSelected = $('#change-year-dimensi').find(":selected").val();
                getBarData(yearBarSelected, provinceSelected);
            });
            $('#change-provinsi-dimensi').on('change', () => {
                let newProvince = $('#change-provinsi-dimensi').find(":selected").val();
                window.location = "{{ url('/provinsi') }}" + '/' + newProvince;
            });
        });
    </script>
@endpush
