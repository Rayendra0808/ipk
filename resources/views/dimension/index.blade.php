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
    background-position-y: center; padding:60px;">
  <div class="d-flex">
    <div class="p-2 flex-grow-1">
      <h1 class="title-page">Dimensi {{$data->id}} <br> {{$data->dimension_name}}</h1>
    </div>
    <div class="p-2"> <img src="{{asset('assets/img/')}}/{{$data->dimension_icon}}" style="max-width: 100px;"></div>
  </div>
</div>
<div class="row" id="block-content">
</div>
<div class="container">
  <h3 class="section-title mt-5"><b>Definisi Operasional</b></h3>
  <p> Definisi Operasional: {{$data->dimension_description}} </p>
</div>
<div class="container">
  <h3 class="section-title mt-1"><b>Rincian Indikator dan Sumber Data</b></h3>
  <div class="table-responsive">
    <table class="table table-sm table-bordered">
      <thead>
        <tr>
          <th class="mx-auto my-auto">Kode</th>
          <th class="mx-auto my-auto">Indikator</th>
          <th class="mx-auto my-auto">Nilai Minimum</th>
          <th class="mx-auto my-auto">Nilai Maksimum</th>
          <th class="mx-auto my-auto">Sumber Data</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data->dimensionIndicators as $valueIndicator)
        <tr>
          <td>{{$valueIndicator->indicator_code}}</td>
          <td>{{$valueIndicator->indicator_description}}</td>
          <td>{{$valueIndicator->min}}</td>
          <td>{{$valueIndicator->max}}</td>
          <td>{{$valueIndicator->indicator_source}}</td>
        </tr>
        @endforeach
    </table>
  </div>
</div>
<div class="container mb-5">
  <h3 class="section-title mt-1"><b>Cara Menghitung Nilai Dimensi</b></h3>
  Nilai Pada Dimensi {{$data->dimension_name}} ({{$data->dimension_code}}) dapat diperoleh dengan rumus perhitungan sebagai berikut
  <div class="mt-3">
    @foreach($data->dimensionQualities as $valueQualities)
    <center>
      <img class="img img-fluid" src="{{asset('assets/img/')}}/{{$valueQualities->formula}}">
    </center>
    @endforeach
  </div>
</div>
<div class="container mb-5 mt-5">
  <h3 class="text-center text-primary mt-5">Perkembangan Nilai Dimensi</h3>
  <h4 class="text-center">Pilih salah satu tahun data:</h3>
    <div class="d-flex justify-content-center">
      @foreach($year as $yearData)
      <button id="btn-{{$yearData}}" class="btn btn-default btn-year btn-sm fs-4 text-primary border m-3" data-year="{{$yearData}}">
        {{$yearData}}
      </button>
      @endforeach
    </div>
    <div class="col-md-12">
      <div id="canvas-dimension">
        <canvas id="dimension-bar"></canvas>
      </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
  const labelDataTarget = [];
  const valueLabelTarget = [];
  const urlDimensionProvinceTotal = "{{url('/chart/dimension-province')}}";

  const getDimensionProvinceTotal = (year) => {
    $.ajax({
      url: urlDimensionProvinceTotal,
      type: "get",
      data: {
        year,
        dimension_id: "{{$data->id}}"
      },
      success: function(response) {
        $('#dimension-bar').remove();
        $('#canvas-dimension').append('<canvas id="dimension-bar"><canvas>');
        const resultData = response;
        const labelData = [];
        const valueData = [];
        const labelTargetData = [];
        const valueTargetData = [];
        const options = {
          options: {
            responsive: true,
            title: {
              display: true,
              text: "Chart.js Bar Chart - Multi Axis"
            },
            tooltips: {
              mode: 'index',
              intersect: true
            },
            scales: {
              xAxes: [{
                stacked: true
              }],
            }
          }
        };

        for (const i in resultData) {
          labelData.push(resultData[i].province_name);
          valueData.push(resultData[i].dimension_value);
          labelTargetData.push(resultData[i].province_name);
          valueTargetData.push(resultData[i].dimension_target);
        }
        const dimensionBar = document.getElementById('dimension-bar');

        // create bar
        const dimensionChart = new Chart(dimensionBar, {
          type: 'bar',
          data: {
            labels: labelData,
            datasets: [{
                label: 'Proyeksi 2024',
                yAxisID: "y-axis-2",
                data: valueTargetData,
                type: 'line',
                backgroundColor: 'rgb(236 127 118)',
                borderColor: 'rgb(236 127 118)',
                fill: false
              },
              {
                label: 'Perkembangan Nilai Dimensi Tahun ' + year,
                backgroundColor: 'rgb(65 70 75)',
                borderColor: 'rgb(65 70 75);',
                data: valueData,
              },

            ]
          },
          options: options
        });
      },
      error: function(xhr) {}
    });
  }
  $(document).ready(function() {
    $("#btn-" + "{{$year[0]}}").click();
  });
  $('.btn-year').on('click', function() {
    // change button
    $('.btn-year').addClass("text-primary");
    $('.btn-year').removeClass("btn-primary");
    $(this).removeClass("text-primary");
    $(this).addClass('btn-primary');
    // get data
    const year = $(this).data('year');
    getDimensionProvinceTotal(year);
  });
</script>
@endpush