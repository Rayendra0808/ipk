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
    <dvi class="container-fluid">
      <div id="map" style="width: 100%; height: 400px;"></div>
    </dvi>
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