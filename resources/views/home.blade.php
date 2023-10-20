@extends('app')
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/image-pop-up.css') }}">
@endpush

@section('content')
    <style>
        #about:before,
        #nasional:before,
        #provinsi:before {
            display: block;
            content: "";
            height: 60px;
        }

        #nasional .btn-selengkapnya {
            background: #96c3ec;
            border-radius: 25px;
            padding: 10px 30px 10px 30px;
        }

        .leaflet-container {
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }

        a#province-list {
            text-decoration: none !important;
        }
    </style>
    <section id="intro" class="clearfix">
        <div class="container">
            <div class="row my-md-3 my-5">
                <div class="col-md-6 col-12 order-md-1 order-2 align-self-center">
                    <div class="intro-info mt-4 mt-md-0">
                        <h2>Indeks<br><span>Pembangunan</span><br>Kebudayaan</h2>
                        <div class="intro-info-action d-flex flex-md-row flex-column">
                            <a href="#nasional" class="btn-services scrollto">Hasil</a>
                            {{-- <a target="_blank" href="{{ asset('assets/img') }}/handbook_ipk.pdf" class="btn-services">Unduh
                                Buku IPK</a> --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn-services" data-bs-toggle="modal"
                                data-bs-target="#unduhBukuIPKModal">Unduh Buku IPK
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="unduhBukuIPKModal" tabindex="-1"
                                aria-labelledby="unduhBukuIPKModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="unduhBukuIPKModalLabel">Unduh Buku IPK</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a target="_blank" href="{{ asset('assets/img') }}/handbook_ipk.pdf"
                                                class="btn btn-download">@include('icons/pdf-icon') Handbook IPK 2020</a>
                                            <a target="_blank" href="{{ asset('assets/pdf') }}/Book IPK 2023 Update 18 Okt 2023.pdf"
                                                class="btn btn-download">@include('icons/pdf-icon') Handbook IPK 2023</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 order-md-2 order-1 mb-md-0 mb-5">
                    <div id="intro-carousel" class="intro-carousel carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            @foreach ($homeSlider as $id => $slider)
                                <button type="button" data-bs-target="#intro-carousel"
                                    data-bs-slide-to="{{ $id }}" class="{{ $slider['isActive'] ? 'active' : '' }}"
                                    aria-current="true" aria-label="Slide {{ $id }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($homeSlider as $slider)
                                <div class="carousel-item {{ $slider['isActive'] ? 'active' : '' }}">
                                    <div class="d-block w-100 text-center">
                                        @if ($slider['type'] == 'youtube')
                                            <iframe width="100%" height="315" src="{{ $slider['src'] }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        @elseif($slider['type'] == 'image')
                                            <img class="image-pop-up" src="{{ $slider['src'] }}"
                                                data-load="{{ $slider['dataLoad'] }}" alt="{{ $slider['alt'] }}">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#intro-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#intro-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Galery Modal -->
                    <div id="gallery_modal" class="modal image-pop-up-modal">
                        <span class="close">&times;</span>
                        <img class="modal-image">
                        <div class="modal-caption"></div>
                    </div>
                </div>
            </div>
            <!-- end .row -->
        </div>
    </section>

    <section id="about">
        <div class="container">
            <p class="text-intro">
                <b>Indeks Pembangunan Kebudayaan (IPK)</b>
                disusun sebagai salah satu instrumen untuk memberikan gambaran kemajuan pembangunan kebudayaan
                yang dapat digunakan sebagai basis formulasi kebijakan bidang kebudayaan,
                serta menjadi acuan dalam koordinasi lintas sektor dalam pelaksanaan pemajuan kebudayaan.
                Penyusunan indeks tersebut melibatkan berbagai pemangku kebijakan dan data yang berkaitan
                dengan pembangunan kebudayaan nasional.
            </p>
            <h3 class="text-center text-primary mt-5">Konsep Dimensi IPK</h3>
            <p class="text-center">
                Klik pada masing-masing Logo Dimensi untuk penjelasan lebih lanjut
            </p>
            <div class="container pt-3">
                <center>
                    <div class="owl-carousel owl-theme">
                        @foreach ($dimensi as $dataDimensi)
                            <div class="item">
                                <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
                                    <a href="{{ route('dimensi.index', [$dataDimensi['dimension_slug']]) }}">
                                        <img class="img-fluid img-center"
                                            src="{{ asset('assets/img') }}/{{ $dataDimensi['dimension_icon'] }}"
                                            style="width: 100px !important;">
                                        <span class="text-center">{{ $dataDimensi['dimension_name'] }}</span>
                                    </a>
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                </center>
            </div>
        </div>
    </section>
    <section id="nasional">
        <div class="container">
            <h3 class="text-center text-primary mt-5">Profil IPK Nasional</h3>
            <div class="row">
                <div class="col-md-4 p-3 mx-auto my-auto">
                    <div class="mb-3 row border">
                        <label for="staticEmail" class="col-md-8 col-form-label">Tahun Data Terakhir: </label>
                        <div class="col-md-4 p-1">
                            <select name="year" id="change-year-nasional" class="form-control form-control-sm">
                                <option disabled>Pilih Tahun</option>
                                @foreach ($year as $yearData)
                                    <option value="{{ $yearData }}">{{ $yearData }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row border">
                        <label for="staticEmail" class="col-md-8 col-form-label">IPK Nasional: </label>
                        <div class="col-md-4 mx-auto my-auto">
                            <span class="fs-2" id="total-value-nasional"></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/nasional') }}" class="btn btn-md btn-selengkapnya">Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 offset-md-2">
                    <div class="chart">
                        <canvas id="profil-ipk-nasional"></canvas>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center profil-ipk-nasional-desc desc-container">
                <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2 fw-bold">Deskripsi</h3>
                            <span id="profil-ipk-nasional-desc"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="provinsi">
        <div class="container">
            <h3 class="text-center text-primary mt-5">Profil IPK Provinsi</h3>
            <p class="text-center">
                Klik wilayah pada peta untuk informasi lebih lanjut
            </p>
            <div>
                <!-- ToDo: ambil list dari db (sementara hardcode) -->
                <ul class="nav nav-pills mb-3 justify-content-center" id="home-jqvmap-tabs-btns" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-jqvmap-tabs-btns-2018" data-bs-toggle="pill"
                            data-bs-target="#home-jqvmap-tabs-2018" type="button" role="tab"
                            aria-controls="home-jqvmap-tabs-2018" aria-selected="false">2018</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-jqvmap-tabs-btns-2019" data-bs-toggle="pill"
                            data-bs-target="#home-jqvmap-tabs-2019" type="button" role="tab"
                            aria-controls="home-jqvmap-tabs-2019" aria-selected="false">2019</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-jqvmap-tabs-btns-2020" data-bs-toggle="pill"
                            data-bs-target="#home-jqvmap-tabs-2020" type="button" role="tab"
                            aria-controls="home-jqvmap-tabs-2020" aria-selected="true">2020</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-jqvmap-tabs-btns-2021" data-bs-toggle="pill"
                            data-bs-target="#home-jqvmap-tabs-2021" type="button" role="tab"
                            aria-controls="home-jqvmap-tabs-2021" aria-selected="true">2021</button>
                    </li>
                </ul>
                <div class="tab-content" id="home-jqvmap-tabs" style="width:100%;height:400px;">
                    <div class="tab-pane fade" id="home-jqvmap-tabs-2018" role="tabpanel"
                        style="width:100%;height:400px;"></div>
                    <div class="tab-pane fade" id="home-jqvmap-tabs-2019" role="tabpanel"
                        style="width:100%;height:400px;"></div>
                    <div class="tab-pane fade" id="home-jqvmap-tabs-2020" role="tabpanel"
                        style="width:100%;height:400px;"></div>
                    <div class="tab-pane fade show active" id="home-jqvmap-tabs-2021" role="tabpanel"
                        style="width:100%;height:400px;"></div>
                </div>
                <div class="home-jqvmap-legend text-center fw-bolder mb-5"
                    style="height: 28px;background: linear-gradient(to right, red 0%, white 50%, green 100%);">
                    <span class="float-start text-white ms-2">Di Bawah Nasional</span>
                    <span>Nasional</span>
                    <span class="float-end text-white me-2">Di Atas Nasional</span>
                </div>
            </div>
            <div class="container-fluid">
                <h2 class="text-center">Pilih Provinsi</h2>
                <center>
                    <form class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <label for="inputPassword2" class="visually-hidden"></label>
                            <select name="provinsi" id="change-province" class="form-control form-control-sm">
                                <option disabled>Pilih Provinsi</option>
                                @foreach ($province as $provinsiValue)
                                    <option value="{{ $provinsiValue->id }}">{{ $provinsiValue->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm mb-3" onclick="changeProvince()">Pilih
                                Provinsi</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
        </div>
    </section>
    @push('custom-scripts')
        <script>
            window.addEventListener('DOMContentLoaded', async function() {
                if (!window.jQuery) {
                    throw Error(
                        "jQuery is required"
                    )
                }
                await jQuery.getScript("{{ asset('assets/jqvmap/chroma.min.js') }}");
                await jQuery.getScript("{{ asset('assets/jqvmap/jquery.vmap.js') }}");
                await jQuery.getScript("{{ asset('assets/jqvmap/jquery.vmap.indonesia.js') }}");

                const GRADIENTS_HIGH = ['white', 'green'];
                const GRADIENTS_LOW = ['red', 'white'];

                // Hasil generate vector buat jqvmap pakainya kode Dagri tapi si IPK pakai kode BPS
                const Dagri_BPS = {
                    "11": "11",
                    "12": "12",
                    "13": "13",
                    "14": "14",
                    "15": "15",
                    "16": "16",
                    "17": "17",
                    "18": "18",
                    "19": "19",
                    "21": "21",
                    "31": "31",
                    "32": "32",
                    "33": "33",
                    "34": "34",
                    "35": "35",
                    "36": "36",
                    "51": "51",
                    "52": "52",
                    "53": "53",
                    "61": "61",
                    "62": "62",
                    "63": "63",
                    "64": "64",
                    "65": "65",
                    "71": "71",
                    "72": "72",
                    "73": "73",
                    "74": "74",
                    "75": "75",
                    "76": "76",
                    "81": "81",
                    "82": "82",
                    "91": "94",
                    "92": "91",
                };

                //Kode Dagri
                const Provinsi = {
                    "11": "Aceh",
                    "12": "Sumatera Utara",
                    "13": "Sumatera Barat",
                    "14": "Riau",
                    "15": "Jambi",
                    "16": "Sumatera Selatan",
                    "17": "Bengkulu",
                    "18": "Lampung",
                    "19": "Kep. Bangka Belitung",
                    "21": "Kep. Riau",
                    "31": "DKI Jakarta",
                    "32": "Jawa Barat",
                    "33": "Jawa Tengah",
                    "34": "Yogyakarta",
                    "35": "Jawa Timur",
                    "36": "Banten",
                    "51": "Bali",
                    "52": "Nusa Tenggara Barat",
                    "53": "Nusa Tenggara Timur",
                    "61": "Kalimantan Barat",
                    "62": "Kalimantan Tengah",
                    "63": "Kalimantan Selatan",
                    "64": "Kalimantan Timur",
                    "65": "Kalimantan Utara",
                    "71": "Sulawesi Utara",
                    "72": "Sulawesi Tengah",
                    "73": "Sulawesi Selatan",
                    "74": "Sulawesi Tenggara",
                    "75": "Gorontalo",
                    "76": "Sulawesi Barat",
                    "81": "Maluku",
                    "82": "Maluku Utara",
                    "91": "Papua",
                    "92": "Papua Barat"
                };

                // ToDo: ambil dari db
                const IPKs = [
                    '2018',
                    '2019',
                    '2020',
                    '2021'
                ];

                // sebelum ada api buat ambil data ya disini dulu
                const IPK_DATA = {
                    "2018": {
                        tahun: '2018',
                        nasional: 53.74,
                        provinsi: {
                            "11": 51.02,
                            "12": 50.73,
                            "13": 53.23,
                            "14": 57.47,
                            "15": 53.18,
                            "16": 50.86,
                            "17": 59.95,
                            "18": 54.33,
                            "19": 54.37,
                            "21": 58.83,
                            "31": 54.67,
                            "32": 51.21,
                            "33": 60.05,
                            "34": 73.79,
                            "35": 56.66,
                            "36": 49.69,
                            "51": 65.39,
                            "52": 59.92,
                            "53": 49.13,
                            "61": 47.86,
                            "62": 53.28,
                            "63": 53.79,
                            "64": 52.78,
                            "65": 50.00,
                            "71": 56.02,
                            "72": 48.11,
                            "73": 49.82,
                            "74": 47.62,
                            "75": 49.86,
                            "76": 46.90,
                            "81": 49.91,
                            "82": 47.02,
                            "91": 47.61,
                            "94": 46.25,
                        }
                    },
                    "2019": {
                        tahun: '2019',
                        nasional: 55.91,
                        provinsi: {
                            "11": 53.67,
                            "12": 52.12,
                            "13": 54.98,
                            "14": 59.65,
                            "15": 54.60,
                            "16": 53.23,
                            "17": 61.13,
                            "18": 56.56,
                            "19": 56.62,
                            "21": 60.90,
                            "31": 57.80,
                            "32": 53.27,
                            "33": 60.94,
                            "34": 73.98,
                            "35": 58.75,
                            "36": 51.43,
                            "51": 69.09,
                            "52": 62.55,
                            "53": 50.47,
                            "61": 50.57,
                            "62": 55.76,
                            "63": 55.99,
                            "64": 55.47,
                            "65": 52.94,
                            "71": 57.62,
                            "72": 49.48,
                            "73": 51.62,
                            "74": 49.09,
                            "75": 50.57,
                            "76": 48.41,
                            "81": 52.10,
                            "82": 50.94,
                            "91": 50.03,
                            "94": 47.49,
                        }
                    },
                    "2020": {
                        tahun: '2020',
                        nasional: 54.65,
                        provinsi: {
                            "11": 52.61,
                            "12": 50.33,
                            "13": 54.60,
                            "14": 59.50,
                            "15": 52.86,
                            "16": 51.68,
                            "17": 56.59,
                            "18": 55.38,
                            "19": 54.70,
                            "21": 59.24,
                            "31": 57.13,
                            "32": 52.04,
                            "33": 59.12,
                            "34": 71.74,
                            "35": 57.88,
                            "36": 48.95,
                            "51": 66.40,
                            "52": 61.26,
                            "53": 48.93,
                            "61": 49.72,
                            "62": 53.88,
                            "63": 54.41,
                            "64": 53.25,
                            "65": 50.46,
                            "71": 55.09,
                            "72": 47.42,
                            "73": 51.10,
                            "74": 48.91,
                            "75": 51.49,
                            "76": 47.14,
                            "81": 50.23,
                            "82": 50.74,
                            "91": 48.07,
                            "94": 46.26,
                        }
                    },
                    "2021": {
                        tahun: '2021',
                        nasional: 51.90,
                        provinsi: {
                            "11": 49.89,
                            "12": 48.74,
                            "13": 52.76,
                            "14": 54.20,
                            "15": 52.39,
                            "16": 50.89,
                            "17": 54.56,
                            "18": 53.19,
                            "19": 50.85,
                            "21": 52.12,
                            "31": 52.67,
                            "32": 50.78,
                            "33": 55.24,
                            "34": 64.22,
                            "35": 53.19,
                            "36": 47.47,
                            "51": 61.69,
                            "52": 54.73,
                            "53": 48.18,
                            "61": 48.53,
                            "62": 55.21,
                            "63": 52.45,
                            "64": 52.49,
                            "65": 50.08,
                            "71": 49.84,
                            "72": 48.02,
                            "73": 51.21,
                            "74": 48.62,
                            "75": 47.32,
                            "76": 45.86,
                            "81": 54.23,
                            "82": 49.91,
                            "91": 46.79,
                            "94": 41.87,
                        }
                    }
                };
                const chromaGradientsHigh = chroma.scale(GRADIENTS_HIGH);
                const chromaGradientsHighColor = function(percent) {
                    percent = parseInt(percent);
                    if (percent > 100) {
                        percent = 100;
                    }
                    if (percent < 0) {
                        percent = 0;
                    }

                    return chromaGradientsHigh(percent / 100).hex();
                };
                const chromaGradientsLow = chroma.scale(GRADIENTS_LOW);
                const chromaGradientsLowColor = function(percent) {
                    percent = parseInt(percent);
                    if (percent > 100) {
                        percent = 100;
                    }
                    if (percent < 0) {
                        percent = 0;
                    }

                    return chromaGradientsLow(percent / 100).hex();
                };
                const onLoad = function(event, map, tahun) {};

                const onRegionClick = function(element, code, region, tahun) {
                    // Go to prov page
                    if (code == 91) code = 94;
                    if (code == 92) code = 91;
                    window.location = "{{ url('/provinsi') }}" + '/' + code;
                };

                const onLabelShow = function(event, label, code, tahun) {
                    // 
                    if (IPK_DATA.hasOwnProperty(tahun)) {
                        const data = IPK_DATA[tahun];
                        const bps = Dagri_BPS[code];

                        label.html('<div>' + Provinsi[code] + ': ' + data.provinsi[bps] +
                            '</div><div>Nasional: ' + data.nasional + '</div>');
                    }
                };

                IPKs.forEach(async function(tahun) {
                    const colors = {};

                    // Get IPK for 'tahun'
                    if (IPK_DATA.hasOwnProperty(tahun)) {
                        const data = IPK_DATA[tahun];
                        var min = null;
                        var max = null;
                        Object.keys(Provinsi).forEach(function(code) {
                            const bps = Dagri_BPS[code];
                            if (!min) {
                                min = data.provinsi[bps]
                            };
                            if (!max) {
                                max = data.provinsi[bps]
                            };
                            min = Math.min(min, data.provinsi[bps]);
                            max = Math.max(max, data.provinsi[bps]);
                        });
                        Object.keys(Provinsi).forEach(function(code) {
                            const bps = Dagri_BPS[code];
                            const ipk = data.provinsi[bps];
                            if (data.nasional < ipk) {
                                colors[code] = chromaGradientsHighColor(
                                    ((ipk - data.nasional) / (max - data.nasional)) * 100
                                );
                            } else {
                                colors[code] = chromaGradientsLowColor(
                                    ((ipk - min) / (data.nasional - min)) * 100
                                );
                            }
                        });
                    }

                    // Create jqvmap
                    jQuery('#home-jqvmap-tabs-' + tahun).vectorMap({
                        map: 'indonesia.id',
                        enableZoom: false,
                        showTooltip: true,

                        selectedColor: null,

                        backgroundColor: '#fff',

                        borderColor: '#33169b',
                        borderOpacity: 0.5,
                        borderWidth: 2,

                        color: '#fff',
                        colors: colors,

                        hoverColor: '#33169b',

                        onLoad: function(event, map) {
                            onLoad(event, map, tahun);
                        },
                        onRegionClick: function(element, code, region) {
                            onRegionClick(element, code, region, tahun);
                        },

                        onLabelShow: function(event, label, code) {
                            return onLabelShow(event, label, code, tahun);
                        },
                    });
                });

                // patch svg size
                $('#home-jqvmap-tabs-btns button[data-bs-toggle="pill"]').on('shown.bs.tab', function(event) {
                    window.dispatchEvent(new Event('resize'));
                })
            });

            function changeProvince() {
                const provinceChoose = $('#change-province').val();
                window.location = "{{ url('/provinsi') }}" + '/' + provinceChoose;
            }

            // ipk-nasional-chart
            let labelYear = '2021';

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
            $(document).ready(function() {
                let initYear = '2021';
                let initProvince = '1001';
                const getDataAreaNasional = (year, provinceId) => {
                    const urlAreaNasional = "{{ url('/chart/area-nasional') }}";
                    $.ajax({
                        url: urlAreaNasional + '/' + year + '/province-id' + '/' + provinceId,
                        success: function(data) {
                            const ctx_live = document.getElementById("profil-ipk-nasional");
                            const myChart = new Chart(ctx_live, {
                                type: 'radar',
                                data: {
                                    labels: [],
                                    images: [],
                                    datasets: [{
                                        data: [],
                                        borderWidth: 1,
                                        borderColor: '#00c0ef',
                                        label: labelYear,
                                    }]
                                },
                                options: {
                                    scale: {
                                        beginAtZero: true,
                                        max: 100,
                                        min: 0,
                                        stepSize: 10
                                    },
                                    responsive: true,
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
                        }
                    });
                };
                const getTotalAreaNasional = (year, provinceId) => {
                    const urlTotalAreaNasional = "{{ url('/chart/area-nasional') }}";
                    $('.row.profil-ipk-nasional-desc').css('display', 'none');
                    $.ajax({
                        url: urlTotalAreaNasional + '/' + year + '/province-id' + '/' + provinceId +
                            '/total',
                        success: function(data) {
                            if (data) {
                                if (data.desc) {
                                    $('.row.profil-ipk-nasional-desc').css('display', 'flex');
                                    $("#profil-ipk-nasional-desc").text(data.desc);
                                } else {
                                    $('.row.profil-ipk-nasional-desc').css('display', 'none');
                                }
                                $("#total-value-nasional").text(data.total);
                            }
                        }
                    });
                }
                getDataAreaNasional(initYear, initProvince);
                getTotalAreaNasional(initYear, initProvince);

                $('#change-year-nasional').on('change', () => {

                    $("#profil-ipk-nasional").remove();
                    $(".chart").append('<canvas id="profil-ipk-nasional" class="animated fadeIn"></canvas>');
                    const yearSelected = $(this).find(":selected").val();
                    labelYear = yearSelected;
                    getDataAreaNasional(yearSelected, initProvince);
                    getTotalAreaNasional(yearSelected, initProvince);
                });
            });
        </script>
        <script src="{{ asset('assets/js/image-pop-up.js') }}" type="text/javascript"></script>
    @endpush
@endsection
