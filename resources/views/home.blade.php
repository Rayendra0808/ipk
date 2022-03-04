@extends('app')
@section('content')
<style>
  #about:before,
  #nasional:before,
  #provinsi:before {
    display: block;
    content: "";
    height: 60px;
  }

  .leaflet-container {
    width: 100%;
    max-width: 100%;
    max-height: 100%;
  }
</style>
<section id="intro" class="clearfix">
  <div class="container">

    <div class="intro-img">
      <img src="{{asset('assets/img/layar1.svg')}}" alt="" class="img-fluid">
    </div>

    <div class="intro-info">
      <h2>Indeks<br><span>Pembangunan</span><br>Kebudayaan</h2>
      <div>

        <a href="#nasional" class="btn-services scrollto">Hasil</a><a href="handbook_ipk.pdf" class="btn-services">Unduh Buku IPK</a>
      </div>
    </div>

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
      <div class="owl-carousel owl-theme">
        @foreach($dimensi as $dataDimensi)
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <a href="{{route('dimensi.index', [$dataDimensi['dimension_slug']])}}">
              <img class="img-fluid img-center" src="{{asset('assets/img')}}/{{$dataDimensi['dimension_icon']}}" style="width: 100px !important;">
              <span class="text-center">{{$dataDimensi['dimension_name']}}</span>
            </a>
          </p>
        </div>
        @endforeach
      </div>
      <hr>
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
              @foreach($year as $yearData)
              <option value="{{$yearData}}">{{$yearData}}</option>
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
          <a href="{{url('/nasional')}}" class="btn btn-md" style="background: #96c3ec;
            border-radius: 25px;padding: 10px 30px 10px 30px;"> Selengkapnya </a>
        </div>
      </div>
      <div class="col-md-6 offset-md-2">
        <div class="chart">
          <canvas id="profil-ipk-nasional"></canvas>
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
          <button class="nav-link" id="home-jqvmap-tabs-btns-2018" data-bs-toggle="pill" data-bs-target="#home-jqvmap-tabs-2018" type="button" role="tab" aria-controls="home-jqvmap-tabs-2018" aria-selected="false">2018</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="home-jqvmap-tabs-btns-2019" data-bs-toggle="pill" data-bs-target="#home-jqvmap-tabs-2019" type="button" role="tab" aria-controls="home-jqvmap-tabs-2019" aria-selected="false">2019</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-jqvmap-tabs-btns-2020" data-bs-toggle="pill" data-bs-target="#home-jqvmap-tabs-2020" type="button" role="tab" aria-controls="home-jqvmap-tabs-2020" aria-selected="true">2020</button>
        </li>
      </ul>
      <div class="tab-content" id="home-jqvmap-tabs" style="width:100%;height:400px;">
        <div class="tab-pane fade" id="home-jqvmap-tabs-2018" role="tabpanel" style="width:100%;height:400px;"></div>
        <div class="tab-pane fade" id="home-jqvmap-tabs-2019" role="tabpanel" style="width:100%;height:400px;"></div>
        <div class="tab-pane fade show active" id="home-jqvmap-tabs-2020" role="tabpanel" style="width:100%;height:400px;"></div>
      </div>
      <script>
        window.addEventListener('DOMContentLoaded', async function () {
          if (!window.jQuery) {
            throw Error(
              "jQuery is required"
            )
          }

          await jQuery.getScript("{{asset('assets/jqvmap/chroma.min.js')}}");
          await jQuery.getScript("{{asset('assets/jqvmap/jquery.vmap.js')}}");
          await jQuery.getScript("{{asset('assets/jqvmap/jquery.vmap.indonesia.js')}}");

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

          // Kode Dagri
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
            '2020'
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
                "11": 53.67281978,
                "12": 52.12078051,
                "13": 54.98608127,
                "14": 59.65236238,
                "15": 54.60943402,
                "16": 53.2355276,
                "17": 61.13016835,
                "18": 56.56758305,
                "19": 56.62320422,
                "21": 60.90222256,
                "31": 57.80682758,
                "32": 53.27624988,
                "33": 60.94271786,
                "34": 73.98112375,
                "35": 58.75786928,
                "36": 51.43448776,
                "51": 69.09299258,
                "52": 62.55685407,
                "53": 50.47917609,
                "61": 50.5763072,
                "62": 55.76058967,
                "63": 55.99058369,
                "64": 55.47174574,
                "65": 52.94401527,
                "71": 57.62453319,
                "72": 49.48906197,
                "73": 51.62104123,
                "74": 49.0974694,
                "75": 50.57081537,
                "76": 48.41361301,
                "81": 52.10212959,
                "82": 50.94228432,
                "91": 50.03348039,
                "94": 47.49241199,
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
            }
          };

          const chromaGradientsHigh = chroma.scale(GRADIENTS_HIGH);
          const chromaGradientsHighColor = function(percent) {
            percent = parseInt(percent);
            if (percent > 100) { percent = 100;}
            if (percent < 0) { percent = 0;}

            return chromaGradientsHigh( percent/100 ).hex();
          };
          const chromaGradientsLow = chroma.scale(GRADIENTS_LOW);
          const chromaGradientsLowColor = function(percent) {
            percent = parseInt(percent);
            if (percent > 100) { percent = 100;}
            if (percent < 0) { percent = 0;}

            return chromaGradientsLow( percent/100 ).hex();
          };

          const onLoad = function(event, map, tahun) {
            // 
          };

          const onRegionClick = function(element, code, region, tahun) {
            // Go to prov page
            // window.location.href = ...;
          };

          const onLabelShow = function(event, label, code, tahun) {
            // 
            if (IPK_DATA.hasOwnProperty(tahun)) {
              const data = IPK_DATA[tahun];
              const bps = Dagri_BPS[code];

              label.html('<div>' + Provinsi[code] + ': ' + data.provinsi[bps] + '</div><div>Nasional: ' + data.nasional + '</div>');
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
                if (!min) { min = data.provinsi[bps]};
                if (!max) { max = data.provinsi[bps]};
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

              onLoad: function(event, map) {onLoad(event, map, tahun);},
              onRegionClick: function(element, code, region) {onRegionClick(element, code, region, tahun);},

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
      </script>
    </div>
    <div class="container-fluid">
      <h2 class="text-center">Pokok Pikiran Provinsi</h2>
      <div class="row d-flex justify-content-between">
        @foreach($province as $provinceData)
        <div class="col-md-3 p-3 border border-dark text-center m-3" style="max-width: 200px !important;">
          <span id="province-list" class="order-{{$provinceData->id}}" data-province-id="{{$provinceData->id}}">{{$provinceData->province_name}}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  </div>
</section>
<!-- @push('script')

@endpush -->
@endsection