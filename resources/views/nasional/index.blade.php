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
      <h1 class="title-page">IPK Nasional <br> <span class="sub-title"></span></h1>
    </div>
  </div>
</div>
<div class="row" id="block-content">
</div>
<div class="container mb-5 mt-5">
  <h4 class="text-center">Pilih salah satu tahun data:</h3>
    <!-- <div class="d-flex justify-content-center">
      @foreach($year as $yearData)
      <button id="btn-{{$yearData}}" class="btn btn-default btn-year btn-sm fs-4 text-primary border m-3" data-year="{{$yearData}}">
        {{$yearData}}
      </button>
      @endforeach
    </div> -->
    <div class="row">
      <h3 class="text-primary mt-5 text-center">Grafik Nilai IPK</h3>
      <div class="col-md-6">
        <div class="chart-nasional">
          <canvas id="ipk-nasional"></canvas>
        </div>
      </div>
      <div class="col-md-4 offset-md-2 align-self-center">
        <h4 class="text-primary">Nilai IPK Nasional</h4>
        <h1 id="total-ipk-nasional"></h1>
      </div>
    </div>
</div>
<div class="container">
  <h3 class="text-primary text-center"> Rincian Nilai per Indikator </h3>
  <h5 class="text-center"> Klik pada masing masing logo untuk melihat nilai per indikator</h5>
  <center>
    <div class="mb-3 row justify-content-center">
      <label for="staticEmail" class="col-md-2 col-form-label">Tahun: </label>
      <div class="col-md-2 p-1">
        <select name="year" id="change-year-nasional" class="form-control form-control-sm">
          <option disabled>Pilih Tahun</option>
          @foreach($year as $yearData)
          <option value="{{$yearData}}">{{$yearData}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </center>
  <div class="owl-carousel owl-theme">
    @foreach($dimensi as $dataDimensi)
    <div class="item">
      <p class="text-capitalize text-primary p-3 mb-2 text-left mt-4">
        <span class="dimension-action" style="cursor:pointer;" data-slug="{{$dataDimensi['dimension_slug']}}">
          <img class="img-fluid img-center" src="{{asset('assets/img')}}/{{$dataDimensi['dimension_icon']}}" style="width: 100px !important;">
          <span class="text-center">{{$dataDimensi['dimension_name']}}</span>
        </span>
      </p>
    </div>
    @endforeach
  </div>
</div>
@endsection
@push('custom-scripts');
<script>
  $(document).ready(function() {
    let labelYear = '2018';
    let initYear = '2018';
    let initProvince = '1001';
    let year = "{{$year[0]}}";

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
      console.log(year);
      const urlAreaNasional = "{{url('/chart/area-nasional')}}";
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

          myChart.update();
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
    const getTotalAreaNasional = (year, provinceId) => {
      const urlTotalAreaNasional = "{{url('/chart/area-nasional')}}";
      $.ajax({
        url: urlTotalAreaNasional + '/' + year + '/province-id' + '/' + provinceId + '/total',
        success: function(data) {
          if (data) {
            $("#total-ipk-nasional").text(data.total);
          }
        }
      });
    }

    const getDimensionIndicator = (year, '1001')
    getDataAreaNasional('2018', initProvince);
    getTotalAreaNasional('2018', initProvince);
    // $('#change-year-nasional').on('change', () => {

    //   $("#indicator").remove();
    //   $(".chart-indicator").append('<canvas id="indicator" class="animated fadeIn"></canvas>');
    //   yearSelected = $(this).find(":selected").val();
    // });

    $('.dimension-action').on('click', function() {
      // change button
      $('.dimension-action').removeClass('text-success');
      $(this).addClass('text-success');
      // getDimensionIndicator(year);
    });
  });
</script>
@endpush