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

  .owl-carousel .nav-btn {
    height: 47px;
    position: absolute;
    width: 26px;
    cursor: pointer;
    top: 100px !important;
  }
</style>
<div class="container pt-5 mt-5">
  <center>
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
  </center>
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
          <td>{!!$valueIndicator->indicator_description !!}</td>
          <td>{{$valueIndicator->min}}</td>
          <td>{{$valueIndicator->max}}</td>
          <td>{{$valueIndicator->indicator_source == null ? 'Susenas MSBP' : $valueIndicator->indicator_source}}</td>
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
      @php
      sort($year);
      @endphp
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
<div class="d-flex flex-row-reverse">
  <p style="font-size:12px;margin-right:25px">
    * Disclaimer untuk nilai 2024 (hanya perhitungan berdasarkan series data sebelumnya)
  </p>
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
        const backgroundColor = [];
        const borderColor = [];
        const options = {};

        for (const i in resultData) {
          labelData.push(resultData[i].province_name);
          valueData.push(resultData[i].dimension_value);
          labelTargetData.push(resultData[i].province_name);
          valueTargetData.push(resultData[i].dimension_target);
          backgroundColor.push('#212529');
          borderColor.push('#212529');
        }
        const dimensionBar = document.getElementById('dimension-bar').getContext('2d');;

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
                datalabels: {
                  align: 'top',
                  anchor: 'end',
                  formatter: (val) => (`${val}`),
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
                type: 'bar',
                label: 'Perkembangan Nilai Dimensi Tahun ' + year,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                barPercentage: 0.8,
                padding: 10,
                data: valueData,
                datalabels: {
                  rotation: -90,
                  align: 'top',
                  anchor: 'end',
                  offset: -40,
                  formatter: (val) => (`${val}`),
                  labels: {
                    value: {
                      color: 'white',
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
            tooltips: {
              enabled: true
            },
            hover: {
              animationDuration: 1
            },
            animation: {
              duration: 1000,
            },
            plugins: {
              datalabels: {}
            }
          },
        });
        const indexData = dimensionChart.config._config.data.labels.map(function(o) {
          return o;
        }).indexOf('NASIONAL');
        if (indexData >= 0) {
          dimensionChart.config._config.data.datasets[1].backgroundColor[indexData] = ['red'];
          dimensionChart.config._config.data.datasets[1].borderColor[indexData] = ['red'];
          dimensionChart.config._config.options.scales.x.ticks.maxRotation = 180;
          dimensionChart.config._config.options.scales.x.ticks.minRotation = 90;
          dimensionChart.config._config.options.scales.x.grid.display = false;
          dimensionChart.config._config.options.scales.y.grid.display = false;
          dimensionChart.update();
        }
      },
      error: function(xhr) {}
    });
  }
  $(document).ready(function() {
    $("#btn-" + "{{$year[count($year)-1]}}").click();
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