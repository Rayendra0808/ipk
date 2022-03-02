@extends('app')
@section('content')
<style>
  .title-page {
    color: #fff;
    font-weight: light;
    margin: 0px 0px 0px 10px;
    font-size: 30px;
  }
</style>
<div class="container pt-5 mt-5">
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
</div>
<div style="background: url({{asset('assets/img/bawah.png')}});
    background-position-y: center;
    padding: 60px;">
  <div class="d-flex">
    <div class="p-2 flex-grow-1">
      <h1 class="title-page">Dimensi {{$data->id}} <br> {{$data->dimension_name}}</h1>
    </div>
    <div class="p-2"> <img src="{{asset('assets/img/')}}/{{$data->dimension_icon}}"></div>
  </div>
</div>
<div class="container">
  <h3 class="section-title"><b>Definisi Operasional</b></h3>
  <p> Definisi Operasional: {{$data->dimension_description}} </p>
</div>
@endsection