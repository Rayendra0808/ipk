<script>
  $('.owl-carousel').owlCarousel({
    center: false,
    loop: true,
    margin: 40,
    nav: false,
    dots: false,
    items: 2,
    autoWidth: true,
    autoplay: false,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 3
      },
      1000: {
        items: 7
      }
    }
  })

  window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
      new bootstrap.ScrollSpy(document.body, {
        target: '#mainNav',
        offset: 74,
      });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
      document.querySelectorAll('#navbarCollapsex .nav-link')
    );
    responsiveNavItems.map(function(responsiveNavItem) {
      responsiveNavItem.addEventListener('click', () => {
        if (window.getComputedStyle(navbarToggler).display !== 'none') {
          navbarToggler.click();
        }
      });
    });

  });

  const map = L.map('map').setView([-2.548926, 118.0148634], 5);
  const tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 20,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
  }).addTo(map);

  let labelYear = '2020';

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
  // ipk-nasional-chart
  $(document).ready(function() {
    let initYear = '2020';
    let initProvince = '1001';
    // logic to get new data
    const getDataAreaNasional = (year, provinceId) => {
      console.log(year);
      const urlAreaNasional = "{{url('/chart/area-nasional')}}";
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
        }
      });
    };
    const getTotalAreaNasional = (year, provinceId) => {
      const urlTotalAreaNasional = "{{url('/chart/area-nasional')}}";
      $.ajax({
        url: urlTotalAreaNasional + '/' + year + '/province-id' + '/' + provinceId + '/total',
        success: function(data) {
          if (data) {
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