$(() => {
  var breedLable = $("#cows_by_breed_label").val();
  var splitbslabel = breedLable.substring(0, breedLable.length - 1);
  var breedFineLable = splitbslabel.split(",");

  var breedData = $("#cows_by_breed_data").val();
  var splitbsdata = breedData.substring(0, breedData.length - 1);
  var breedFineData = splitbsdata.split(",");

  var breedFineDataMax = breedFineData.sort((a, b) => b - a)[0];

  var ctx = document.getElementById("cowsBreedSummery");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: breedFineLable,
      datasets: [
        {
          label: "Breeds of Cows",
          fillColor: "#000eee",
          strokeColor: "#000eee",
          pointColor: "#000eee",
          pointStrokeColor: "#000eee",
          pointHighlightFill: "#000eee",
          pointHighlightStroke: "#000eee",
          maintainAspectRatio: false,
          scaleFontColor: "#000eee",
          pointLabelFontColor: "#000eee",
          pointLabelFontSize: 30,
          data: breedFineData,
        },
      ],
    },
    options: {
      responsive: true,
      tooltips: {
        mode: "index",
        intersect: false,
      },
      hover: {
        mode: "nearest",
        intersect: true,
      },
      scales: {
        xAxes: [
          {
            display: true,
            scaleLabel: {
              display: true,
              labelString: "Breeds",
            },
          },
        ],
        yAxes: [
          {
            display: true,
            ticks: {
              beginAtZero: true,
              steps: 10,
              stepValue: 5,
              max: Number(breedFineDataMax),
            },
            scaleLabel: {
              display: true,
              labelString: "Number of Cows",
            },
          },
        ],
      },
      animation: {
        duration: 1,
        onComplete: function () {
          var chartInstance = this.chart,
            ctx = chartInstance.ctx;

          ctx.color = "#000eee";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";

          this.data.datasets.forEach(function (dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function (bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x, bar._model.y - 5);
            });
          });
        },
      },
    },
  });

  //pie

  var routeLable = $("#cows_by_route_label").val();
  var splitbslabel = routeLable.substring(0, routeLable.length - 1);
  var routeFineLable = splitbslabel.split(",");

  var routeData = $("#cows_by_route_data").val();
  var splitbsdata = routeData.substring(0, routeData.length - 1);
  var routeFineData = splitbsdata.split(",");

  let data = [];
  for (i = 0; i < routeFineData.length; i++) {
    let obj = { y: routeFineData[i], label: routeFineLable[i] };
    data.push(obj);
  }
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
      text: "Cows By Route",
      fontColor: "green",
    },

    data: [
      {
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0",
        indexLabel: "{label} {y}",
        dataPoints: data,
      },
    ],
  });
  chart.render();
});
