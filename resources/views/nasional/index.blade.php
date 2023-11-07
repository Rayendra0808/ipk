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
            right: -18px;
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
            color: #267dfd;
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
        <!-- <div class="owl-carousel owl-theme">
                                                                            @foreach ($dimensi as $dataDimensi)
    <div class="item">
                                                                              <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
                                                                                <a href="{{ route('dimensi.index', [$dataDimensi['dimension_slug']]) }}">
                                                                                  <img class="img-fluid img-center" src="{{ asset('assets/img') }}/{{ $dataDimensi['dimension_icon'] }}" style="width: 100px !important;">
                                                                                  <span class="text-center">{{ $dataDimensi['dimension_name'] }}</span>
                                                                                </a>
                                                                              </p>
                                                                            </div>
    @endforeach
                                                                          </div> -->
    </div>
    <div style="background: url({{ asset('assets/img/bawah.png') }});
    background-position-y: center; padding:60px;">
        <div class="d-flex">
            <div class="p-2 flex-grow-1">
                <h1 class="title-page">IPK Nasional <br> <span class="sub-title"></span></h1>
            </div>
            <div class="p-2"> <img src="{{ asset('assets/img/ipk-logo.png') }}"
                    style="max-width: 120px;"></div>
        </div>
    </div>
    <div class="row" id="block-content">
    </div>
    <div class="container mb-5 mt-5">
        <h4 class="text-center">Pilih salah satu tahun data:</h3>
            <!-- <div class="d-flex justify-content-center">
                                                                              @foreach ($year as $yearData)
    <button id="btn-{{ $yearData }}" class="btn btn-default btn-year btn-sm fs-4 text-primary border m-3" data-year="{{ $yearData }}">
                                                                                {{ $yearData }}
                                                                              </button>
    @endforeach
                                                                            </div> -->
            <div class="row">
                <h3 class="text-primary mt-5 text-center">Grafik Nilai IPK</h3>
                <div class="d-flex flex-row-reverse">
                    <a href="{{ asset('assets/pdf/00 - Nasional 2018-2022.pdf') }}" target="_blank" class="btn btn-primary" style="background: #6f42c1;margin-left:20px;
            border-color: #6f42c1;">
                        <i class="fa fa-download"></i> Download
                    </a>
                </div>
                <div class="col-md-6">
                    <h5 class="text-center text-primary">Silahkan klik tahun</h5>
                    <div class="chart-nasional">
                        <canvas id="ipk-nasional"></canvas>
                    </div>
                </div>
                <div class="col-md-4 offset-md-2 align-self-center">
                    <h4 class="text-primary">Nilai IPK Nasional</h4>
                    <h6> Tahun 2018 : <span class="text-primary" id="total-ipk-nasional-2018"></span></h6>
                    <h6> Tahun 2019 : <span class="text-primary" id="total-ipk-nasional-2019"></span></h6>
                    <h6> Tahun 2020 : <span class="text-primary" id="total-ipk-nasional-2020"></span></h6>
                    <h6> Tahun 2021 : <span class="text-primary" id="total-ipk-nasional-2021"></span></h6>
                    <h6> Tahun 2022 : <span class="text-primary" id="total-ipk-nasional-2022"></span></h6>
                </div>
            </div>
    </div>
    <div class="container">
        <h3 class="text-primary text-center"> Rincian Nilai per Indikator </h3>
        <h5 class="text-center"> Klik pada masing masing logo untuk melihat nilai per indikator</h5>
        <center>
            <div class="mb-3 row justify-content-center">
                <div for="staticEmail" class="col-md-2 col-form-label">Tahun: </div>
                <div class="col-md-2 p-1">
                    <select name="year" id="change-year-nasional" class="form-control form-control-sm">
                        <option disabled>Pilih Tahun</option>
                        @foreach ($year as $yearData)
                            <option value="{{ $yearData }}">{{ $yearData }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
        <div id="line-chart">
            <div class="container border mb-5 mt-5">
                <h3 id="title-line" class="mt-3"></h3>
                <div class="d-flex justify-content-end" id="sticky-custom">
                    <p class="p-2">Nasional</p>
                    <p class="p-2 text-danger">Proyeksi 2024</p>
                </div>
                <div class="row p-1" id="line-chart-new">

                </div>
                <!-- <div class="row">
                                                                                <div class="col-md-6">
                                                                                  <h3 id="title-line" class="mt-3"></h3>
                                                                                  <div id="description">

                                                                                  </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                  <div class="d-flex justify-content-center">
                                                                                    <p class="p-2 text-primary">Nasional</p>
                                                                                    <p class="p-2 text-danger">Proyeksi 2024</p>
                                                                                  </div>
                                                                                  <div id="chart-line-custom" style="margin-top:-50px;"></div>
                                                                                </div>
                                                                              </div> -->
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            <p style="font-size:12px;margin-right:25px">
                * Disclaimer untuk nilai 2024 (hanya perhitungan berdasarkan series data sebelumnya)
            </p>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        const years = ['2018', '2019', '2020', '2021', '2022'];
        $(document).ready(function() {
            let labelYear = '2018';
            let initYear = '2018';
            let initProvince = '1001';
            let year = "{{ $year[0] }}";

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
            const getDataAreaNasional = (year, provinceId) => {
                const urlAreaNasional = "{{ url('/chart/area-nasional') }}";
                $.ajax({
                    url: urlAreaNasional + '/' + year + '/province-id' + '/' + provinceId,
                    success: function(data) {
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
                                                for (let i =
                                                        0; i <
                                                    data2021
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
                                                            3]
                                                        .data
                                                        .push(
                                                            data2021[
                                                                i
                                                            ]
                                                            .dimension_value
                                                        );
                                                };

                                                myChart
                                                    .update();
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

                                                myChart
                                                    .update();
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
            };
            const getTotalAreaNasional = (provinceId) => {
                const urlTotalAreaNasional = "{{ url('/chart/area-nasional') }}";
                for (const year of years) {
                    $.ajax({
                        url: urlTotalAreaNasional + '/' + year + '/province-id' + '/' + provinceId +
                            '/total',
                        success: function(data) {
                            if (data) $("#total-ipk-nasional-" + year).text(data.total);
                        }
                    });
                }
            }
            $('#line-chart').hide();
            const getDimensionIndicator = (year, provinceId, dimensionId) => {
                const urlIndicatorProvince = "{{ url('/chart/indicator-province') }}";
                $.ajax({
                    url: urlIndicatorProvince,
                    type: "get",
                    data: {
                        year,
                        province_id: provinceId,
                        dimension_id: dimensionId
                    },
                    success: function(data) {

                        $('#line-chart').show();
                        let description = '';
                        data.forEach(generateDescription);
                        document.getElementById("line-chart-new").innerHTML = description;

                        function generateDescription(item, index) {
                            description +=
                                `<div class="col-md-6 pt-5"><div style="padding-bottom:15px;"><h6 class="fw-bold"> Indikator ${item.indicator_code} </h6></div><p>${item.indicator_description}</p></div>
           <div class="col-md-6 pt-5"><canvas height="200" class="chart-line-new" id="chart-indicator-${index}"></canvas></div>`;
                        }

                        function generateChart(item, index) {
                            const nMin = item.min;
                            const nMax = item.max;

                            const indicatorCtx = $("body").find('#chart-indicator-' + index);
                            // const indicatorCtx = document.getElementById('chart-indicator-0');
                            const indicatorLine = new Chart(indicatorCtx, {
                                type: 'line',
                                plugins: [ChartDataLabels],
                                data: {
                                    labels: [''],
                                    images: [],
                                    datasets: [
                                        // {
                                        //   label: item.min,
                                        //   data: [item.min, item.indicator_target_value, item.indicator_value, item.max],
                                        // },
                                        {
                                            // type: 'line',
                                            label: 'Min',
                                            data: [item.min],
                                            backgroundColor: 'black',
                                            borderColor: 'black',
                                            datalabels: {
                                                clip: true,
                                                offset: -70,
                                                align: 'top',
                                                anchor: 'end',
                                                formatter: (val) => (
                                                    `       Min\n         ${nMin}`),
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
                                            // type: 'line',
                                            label: 'Proyeksi 2024',
                                            pointRadius: 5,
                                            pointHoverRadius: 5,
                                            backgroundColor: 'rgb(236 127 118)',
                                            borderColor: 'rgb(236 127 118)',
                                            data: [item.indicator_target_value],
                                            datalabels: {
                                                offset: 10,
                                                align: 'top',
                                                anchor: 'end',
                                                formatter: (val) => (`${val}`),
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
                                            label: 'Nasional',
                                            backgroundColor: '#444444',
                                            pointRadius: 6,
                                            pointHoverRadius: 6,
                                            borderColor: '#444444',
                                            data: [item.indicator_value],
                                            datalabels: {
                                                offset: -35,
                                                align: 'top',
                                                anchor: 'end',
                                                formatter: (val) => (`${val}`),
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
                                                formatter: (val) => ('\nMax\n ' + nMax),
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
                                            top: 40,
                                            right: 40,
                                            left: 40,
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
                                            display: true,
                                            grid: {
                                                display: false,
                                            },
                                            position: 'top',
                                            ticks: {
                                                stepSize: 1,
                                                display: false
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

                        data.forEach(generateChart);
                    }
                })
            }
            // const getDimensionIndicator = (year, provinceId, dimensionId) => {
            //   const urlIndicatorProvince = "{{ url('/chart/indicator-province') }}";
            //   $.ajax({
            //     url: urlIndicatorProvince,
            //     type: "get",
            //     data: {
            //       year,
            //       province_id: provinceId,
            //       dimension_id: dimensionId,
            //     },
            //     success: function(data) {
            //       if (data.length > 0) {
            //         let text = '';
            //         let chartLine = '';
            //         data.forEach(generateDescription);
            //         data.forEach(generateChart);
            //         document.getElementById("description").innerHTML = text;
            //         document.getElementById("chart-line-custom").innerHTML = chartLine;
            //         $('#line-chart').show();

            //         function generateDescription(item) {
            //           text += `<div style="padding-bottom:15px;"><h6 class="fw-bold"> Indikator ${item.indicator_code} </h6>`;
            //           if (item.indicator_description.length < 65) {
            //             text += `<p style="padding-bottom:15px;">${item.indicator_description}</p></div>`;
            //           } else {
            //             text += `<p>${item.indicator_description}</p></div>`;
            //           }
            //         }

            //         function generateChart(item, index) {
            //           chartLine += `<ul id='timeline'><li class='entry'>
        //           <input checked='checked' class='radio' id='trigger1${index}+' name='trigger' type='radio'>
        //             <span class='top-label-min'>Nilai Minimum</span>
        //             <span class='bottom-label-min' id="indicator-min">${item.min}</span>
        //             <span class='circle-black-min'></span>
        //           </li>`;
            //           if (item.indicator_value <= item.indicator_target_value) {
            //             chartLine += `<li class='entry'>
        //             <input checked='checked' class='radio' id='trigger2${index}+' name='trigger' type='radio'>
        //             <span class='top-label' id="indicator-nasional">${item.indicator_value}</span>
        //             <span class='circle-blue'></span>
        //             </li>`;
            //             chartLine += `<li class='entry'>
        //             <input checked='checked' class='radio' id='trigger3${index}+' name='trigger' type='radio'>
        //             <span class='top-label' id="indicator-proyeksi">${item.indicator_target_value}</span>
        //             <span class='circle-red'></span>
        //             </li>`;
            //           }
            //           if (item.indicator_value > item.indicator_target_value) {
            //             chartLine += `<li class='entry'>
        //             <input checked='checked' class='radio' id='trigger3${index}+' name='trigger' type='radio'>
        //             <span class='top-label' id="indicator-proyeksi">${item.indicator_target_value}</span>
        //             <span class='circle-red'></span>
        //             </li>`;
            //             chartLine += `<li class='entry'>
        //             <input checked='checked' class='radio' id='trigger2${index}+' name='trigger' type='radio'>
        //             <span class='top-label' id="indicator-nasional">${item.indicator_value}</span>
        //             <span class='circle-blue'></span>
        //             </li>`;
            //           }
            //           chartLine += `<li class='entry'>
        //           <input checked='checked' class='radio' id='trigger1${index}+' name='trigger' type='radio'>
        //             <span class='top-label-max'>Nilai Maksimum</span>
        //             <span class='bottom-label-max' id="indicator-max">${item.max}</span>
        //             <span class='circle-black-max'></span>
        //           </li></ul>`;
            //         }
            //       }
            //     }
            //   });

            // }
            getDataAreaNasional('2018', initProvince);
            getTotalAreaNasional(initProvince);
            $('#change-year-nasional').on('change', () => {
                year = $(this).find(":selected").val();
                $('#line-chart').hide();
                $('.dimension-action').removeClass('text-success');
            });

            $('.dimension-action').on('click', function() {
                // change button
                let dimensionId = $(this).data('id');
                let dimensionName = 'Dimensi ' + $(this).data('name');
                $('#title-line').text(dimensionName + year);
                $('.dimension-action').removeClass('text-success');
                $(this).addClass('text-success');
                getDimensionIndicator(year, initProvince, dimensionId);
            });
        });
    </script>
@endpush
