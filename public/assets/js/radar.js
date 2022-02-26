$(function(){
                //get the bar chart canvas
                var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                var ctx = $("#bar-chart");

           
                //bar chart data
                var data = {
                  labels: cData.label,
                  datasets: [
                    {
                      pontRadius: 0,
                      borderWidth: 4,
                      data: cData.data,
                      backgroundColor: [
                        "#DEB887",
                        "#A9A9A9",
                        "#DC143C",
                        "#F4A460",
                        "#2E8B57",
                        "#1D7A46",
                        "#CDA776",
                        "#CDA776",
                        "#989898",
                        "#CB252B",
                        "#E39371",
                      ],
                      borderColor: [
                       'rgba(0, 255, 0, 1)'
                      ],
                      fill: false,
                      borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
                    }
                  ]
                };
           
                //options
                var options = {
                  responsive: true,
                  title: {
                    display: true,
                    position: "top",
                    text: "IPK 2018",
                    fontSize: 18,
                    fontColor: "#111"
                  },
                  legend: {
                    display: false
                  }
                };
           
                //create bar Chart class object
                var chart1 = new Chart(ctx, {
                  type: "radar",
                  data: data,
                  options: options
                });
           
            });