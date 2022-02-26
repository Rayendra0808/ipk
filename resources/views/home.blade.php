@extends('app')
@section('content')
<section id="intro" class="clearfix">
  <div class="container">

    <div class="intro-img">
      <img src="{{asset('assets/img/layar1.svg')}}" alt="" class="img-fluid">
    </div>

    <div class="intro-info">
      <h2>Indeks<br><span>Pembangunan</span><br>Kebudayaan</h2>
      <div>

        <a href="#hasil_hitung" class="btn-services scrollto">Hasil</a><a href="handbook_ipk.pdf" class="btn-services">Unduh Buku IPK</a>
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
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/ekonomibudaya.png')}}" style="width: 100px !important;">
            <span class="text-center">Ekonomi Budaya</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/pendidikan.png')}}" style="width: 100px !important;">
            <span class="text-center">Pendidikan</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/ketahanannasional.png')}}" style="width: 100px !important;">
            <span class="text-center">Ketahanan Sosial Budaya</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/warisanbudaya.png')}}" style="width: 100px !important;">
            <span class="text-center">Warisan Budaya</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/kebebasanbudaya.png')}}" style="width: 100px !important;">
            <span class="text-center">Ekspresi Budaya</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/literasibudaya.png')}}" style="width: 100px !important;">
            <span class="text-center">Budaya Literasi</span>
          </p>
        </div>
        <div class="item">
          <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
            <img class="img-fluid img-center" src="{{asset('assets/img/gender.png')}}" style="width: 100px !important;">
            <span class="text-center">Gender</span>
          </p>
        </div>
      </div>
      <hr>
    </div>
  </div>
  <div class="container">
    <h3 class="text-center text-primary mt-5">Profil IPK Nasional</h3>
    <div class="chart">
      Chart goes Here
    </div>
  </div>
  <div class="container">
    <h3 class="text-center text-primary mt-5">Profil IPK Provinsi</h3>
    <p class="text-center">
      Klik wilayah pada peta untuk informasi lebih lanjut
    </p>
    <div class="map">
      Map goes Here
    </div>
  </div>
</section>
@endsection