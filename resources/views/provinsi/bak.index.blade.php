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

  .bottom-label {
    width: 100%;
    padding-bottom: 30px;
    text-align: center;
    position: absolute;
    bottom: -30px;
    display: block;
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

  .circle-black {
    width: 10px;
    height: 10px;
    margin-left: -5px;
    background: #3f9cca;
    border: 5px solid black;
    border-radius: 50%;
    position: absolute;
    top: -14px;
    left: 50%;
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
    top: -14px;
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
    top: -14px;
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
    top: -14px;
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
<div style="background: url({{asset('assets/img/bawah.png')}});
    background-position-y: center; padding:60px;">
  <div class="d-flex">
    <div class="p-2 flex-grow-1">
      <h1 class="title-page">IPK Provinsi <br> <span class="sub-title" style="text-transform:capitalize;">{{strtolower($provinsi->province_name)}}</span></h1>
    </div>
  </div>
</div>
<div class="row" id="block-content">
</div>
<div class="container mb-5 mt-5">
  <h4 class="text-center">Pilih provinsi lainnya</h3>
    <center>
      <div class="mb-3 row justify-content-center">
        <div for="staticEmail" class="col-md-2 col-form-label">Provinsi: </div>
        <div class="col-md-2 p-1">
          <select name="provinsi" id="change-provinsi-dimensi" class="form-control form-control-sm">
            <option disabled>Pilih Provinsi</option>
            @foreach($provinsiData as $provinsiValue)
            @php
            $selected = '';
            if($provinsiValue->province_name == $provinsi->province_name) $selected = 'selected';
            @endphp
            <option value="{{$provinsiValue->id}}" {{$selected}}>{{$provinsiValue->province_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </center>
    <div class="row">
      <h3 class="text-primary mt-5 text-center">Grafik Nilai IPK</h3>
      <div class="col-md-6">
        <div class="chart-nasional">
          <canvas id="ipk-nasional"></canvas>
        </div>
      </div>
      <div class="col-md-4 offset-md-2 align-self-center">
        <h4 class="text-primary">Nilai IPK Provinsi</h4>
        <h6> Tahun 2018 : <span class="text-primary" id="total-ipk-provinsi-2018"></span></h6>
        <h6> Tahun 2019 : <span class="text-primary" id="total-ipk-provinsi-2019"></span></h6>
        <h6> Tahun 2020 : <span class="text-primary" id="total-ipk-provinsi-2020"></span></h6>
        <h4 class="text-primary">Nilai IPK Nasional</h4>
        <h6> Tahun 2018 : <span class="text-primary" id="total-ipk-nasional-2018"></span></h6>
        <h6> Tahun 2019 : <span class="text-primary" id="total-ipk-nasional-2019"></span></h6>
        <h6> Tahun 2020 : <span class="text-primary" id="total-ipk-nasional-2020"></span></h6>
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
          @foreach($year as $yearData)
          <option value="{{$yearData}}">{{$yearData}}</option>
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
          @foreach($year as $yearData)
          <option value="{{$yearData}}">{{$yearData}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </center>
  <h5 class="text-center"> Klik pada masing masing logo untuk melihat nilai per indikator </h5>
  <div class="owl-carousel owl-theme">
    @foreach($dimensi as $dataDimensi)
    <div class="item">
      <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
        <span class="dimension-action" style="cursor:pointer;" data-slug="{{$dataDimensi['dimension_slug']}}" data-id="{{$dataDimensi['id']}}" data-name="{{$dataDimensi['dimension_name']}}">
          <img class="img-fluid img-center" src="{{asset('assets/img')}}/{{$dataDimensi['dimension_icon']}}" style="width: 100px !important;">
          <span class="text-center">{{$dataDimensi['dimension_name']}}</span>
        </span>
      </p>
    </div>
    @endforeach
  </div>
</div>
<div id="line-chart">
  <div class="container border mb-5 mt-5">
    <div class="row">
      <div class="col-md-6">
        <h3 id="title-line" class="mt-3"></h3>
        <div id="description">

        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-center">
          <p class="p-2" style="color:#0d6efd;">{{$provinsi->province_name}}</p>
          <p class="p-2" style="color:#0dcaf0;">Nasional</p>
          <p class="p-2 text-danger">Proyeksi 2024</p>
        </div>
        <div id="chart-line-custom" style="margin-top:-50px;"></div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@push('custom-scripts')
<script>
  $(document).ready(function() {
    let labelYear = '2018';
    let initYear = '2018';
    let provinceNasional = '1001';
    let provinceSelected = "{{$provinsi->id}}";
    let year = "{{$year[0]}}";
    let yearBar = "{{$year[0]}}";

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
      console.log(year);
      const urlAreaNasional = "{{url('/chart/area-nasional')}}";
      $.ajax({
        url: urlAreaNasional + '/' + year + '/province-id' + '/' + provinceId,
        success: function(data) {
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
                }
              ]
            },
            options: {
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
                const getLabel = chart.config._config.data.labels;
                getLabel.forEach((value, i) => {
                  const scale = chart.scales.r;
                  drawTextAtIndex(scale, i, chart.config._config.data.images[i], value, chart.config._config.data.datasets[0].data[i]);
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

          // myChart.update();
          $.ajax({
            url: urlAreaNasional + '/' + '2019' + '/province-id' + '/' + provinceId,
            success: function(data2019) {
              myChart.data.images = [];
              myChart.data.labels = [];
              for (let i = 0; i < data2019.length; i++) {
                myChart.data.images.push(data[i].dimension_icon);
                myChart.data.labels.push(data[i].dimension_name);
                myChart.data.datasets[1].data.push(data2019[i].dimension_value);
              };
              myChart.update();
              $.ajax({
                url: urlAreaNasional + '/' + '2020' + '/province-id' + '/' + provinceId,
                success: function(data2020) {
                  myChart.data.images = [];
                  myChart.data.labels = [];
                  for (let i = 0; i < data2020.length; i++) {
                    myChart.data.images.push(data[i].dimension_icon);
                    myChart.data.labels.push(data[i].dimension_name);
                    myChart.data.datasets[2].data.push(data2020[i].dimension_value);
                  };

                  myChart.update();
                }
              });
            }
          });
        }
      });
    };
    const getTotalAreaNasional = (provinceId) => {
      const urlTotalAreaNasional = "{{url('/chart/area-nasional')}}";
      $.ajax({
        url: urlTotalAreaNasional + '/2018' + '/province-id' + '/' + provinceId + '/total',
        success: function(data) {
          if (data) {
            $("#total-ipk-nasional-2018").text(data.total);
          }
        }
      });
      $.ajax({
        url: urlTotalAreaNasional + '/2019' + '/province-id' + '/' + provinceId + '/total',
        success: function(data) {
          if (data) {
            $("#total-ipk-nasional-2019").text(data.total);
          }
        }
      });
      $.ajax({
        url: urlTotalAreaNasional + '/2020' + '/province-id' + '/' + provinceId + '/total',
        success: function(data) {
          if (data) {
            $("#total-ipk-nasional-2020").text(data.total);
          }
        }
      });
    }
    const getTotalAreaProvince = (provinceId) => {
      const urlTotalAreaProvince = "{{url('/chart/area-nasional')}}";
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
    const getDimensionIndicator = (year, provinceId, dimensionId) => {
      const urlIndicatorProvince = "{{url('/chart/indicator-province')}}";
      $.ajax({
        url: urlIndicatorProvince,
        type: "get",
        data: {
          year,
          province_id: provinceId,
          dimension_id: dimensionId,
        },
        success: function(dataProvince) {
          if (dataProvince.length > 0) {
            let text = '';
            let chartLine = '';

            function generateDescription(item) {
              text += `<div style="padding-bottom:15px;"><h6 class="fw-bold"> Indikator ${item.indicator_code} </h6>`;
              if (item.indicator_description.length < 65) {
                text += `<p style="padding-bottom:15px;">${item.indicator_description}</p></div>`;
              } else {
                text += `<p>${item.indicator_description}</p></div>`;
              }
            }

            function generateChart(item, index) {
              chartLine += `<ul id='timeline'><li class='entry'>
              <input checked='checked' class='radio' id='trigger1${index}+' name='trigger' type='radio'>
              <span class='top-label'>Nilai Minimum</span>
              <span class='bottom-label' id="indicator-min">${item.min}</span>
              <span class='circle-black'></span>
              </li>`;
              chartLine += `<li class='entry'>
              <input checked='checked' class='radio' id='trigger2${index}+' name='trigger' type='radio'>
              <span class='top-label' id="indicator-provinsi">${item.indicator_value}</span>
              <span class='circle-info'></span>
              </li>`;
              chartLine += `<li class='entry'>
              <input checked='checked' class='radio' id='trigger2${index}+' name='trigger' type='radio'>
              <span class='top-label' id="indicator-nasional">${item.indicator_nasional}</span>
              <span class='circle-blue'></span>
              </li>`;
              chartLine += `<li class='entry'>
              <input checked='checked' class='radio' id='trigger3${index}+' name='trigger' type='radio'>
              <span class='top-label' id="indicator-proyeksi">${item.indicator_target_value}</span>
              <span class='circle-red'></span>
              </li>`;
              chartLine += `<li class='entry'>
              <input checked='checked' class='radio' id='trigger1${index}+' name='trigger' type='radio'>
              <span class='top-label'>Nilai Maksimum</span>
              <span class='bottom-label' id="indicator-max">${item.max}</span>
              <span class='circle-black'></span>
              </li></ul>`;
            }
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
                  const indexData = dataProvince.map(function(o) {
                    return o.indicator_code;
                  }).indexOf(n.indicator_code);
                  if (indexData >= 0) {
                    dataProvince[indexData].indicator_nasional = n.indicator_value;
                  }
                });
                dataProvince.forEach(generateDescription);
                dataProvince.forEach(generateChart);
                document.getElementById("description").innerHTML = text;
                document.getElementById("chart-line-custom").innerHTML = chartLine;
                $('#line-chart').show();
              }
            });
          }
        }
      });

    }
    getDataAreaProvince('2018', provinceSelected);
    getTotalAreaNasional(provinceNasional);
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
    });

    const getBarData = (yearBar, provinceId) => {
      const urlIndicatorProvince = "{{url('/chart/dimension-province')}}";
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
          const valueData = [];
          const valueDataNasional = [];
          const labelTargetData = [];
          const valueTargetData = [];
          const options = {
            options: {
              responsive: true,
              title: {
                display: true,
              },
              tooltips: {
                mode: 'index',
                intersect: true
              },
              scales: {}
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

                labelData.push(resultData[i].dimension_name);
                valueData.push(resultData[i].dimension_value);
                const indexData = dataBarNasional.map(function(o) {
                  return o.dimension_name;
                }).indexOf(resultData[i].dimension_name);
                if (indexData >= 0) {
                  valueDataNasional.push(dataBarNasional[indexData].dimension_value);
                }
                valueDataNasional.push(resultData[i].dimension_value);
                labelTargetData.push(resultData[i].dimension_name);
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
                      data: valueTargetData,
                      type: 'line',
                      backgroundColor: 'rgb(236 127 118)',
                      borderColor: 'rgb(236 127 118)',
                      fill: false,
                    },
                    {
                      label: 'Nilai Dimensi Nasional Tahun ' + yearBar,
                      backgroundColor: '#0dcaf0',
                      borderColor: '#0dcaf0;',
                      data: valueDataNasional,
                    },
                    {
                      label: 'Nilai Dimensi Provinsi {{$provinsi->province_name}} Tahun ' + yearBar,
                      backgroundColor: '#0d6efd',
                      borderColor: '#0d6efd;',
                      data: valueData,
                    },

                  ]
                },
                options: options
              });
              dimensionChart.config._config.options.scales.x.grid.display = false;
              dimensionChart.config._config.options.scales.y.grid.display = false;
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
      window.location = "{{url('/provinsi')}}" + '/' + newProvince;
    });
  });
</script>
@endpush