$(() => {
  var vetLable = $("#vets_by_semen_count_label").val();

  var splitbslabel = vetLable.substring(0, vetLable.length - 1);
  var vetFineLabel = splitbslabel.split(",");

  var vetData = $("#vets_by_semen_count_data").val();
  var splitbsdata = vetData.substring(0, vetData.length - 1);
  var vetFineData = splitbsdata.split(",");

  var vetFineDataMax = parseInt(vetFineData.sort((a, b) => b - a)[0]) + 10;


  var ctx = document.getElementById("vetSemenSummery");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: vetFineLabel,
      datasets: [
        {
          label: "Vet Semen Count",
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
          data: vetFineData,
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
              labelString: "Vets",
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
              max: Number(vetFineDataMax),
            },
            scaleLabel: {
              display: true,
              labelString: "Semen Count",
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

  var routeLable = $("#vets_by_route_label").val();
  var splitbslabel = routeLable.substring(0, routeLable.length - 1);
  var routeFineLable = splitbslabel.split(",");

  

  var routeData = $("#vets_by_route_data").val();
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
      text: "Vets By Route",
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


// //bookings
// var table = $('#bookings').DataTable({


//   'destroy' : true,
//   "processing": true,
//   "language": {
//       processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
//   },

//   'serverSide' : false,
//   'sAjaxSource': '/Cvet/bookings',
//   'sAjaxDataProp': '',
//   'order': [ [ 1, 'asc' ] ],
//   'columns': 
//   [ 
//           // { 'data': 'id', 'title':'ID'} ,

//      { 'data': 'fullName', 'title':'Names' } ,
//      { 'data': 'email', 'title':'Email'} ,
//      // { 'data': 'username', 'title':'Username'} ,
//      { 'data': 'nationalID',  'title':'NationalID'} ,
//      { 'data': 'phoneNumber',  'title':'PhoneNumber'} ,
//       { 'data': 'saccoName',  'title':'SaccoName'} ,
//       { 'data': 'dateCreated', 'title':'dateCreated'} ,
//   ],
 
//   'sorting':true,
//   'ordering' : true,
//   info: true,
//   "lengthChange": true,
//   "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
//   searching: true,
//   paging: true,
//   select: true,
//   "autoWidth": true,

// });

// var vetBookingCallBack = (vetId) =>{
//   console.log(vetId)
// }

// $('.bookingBtn').click( ()=>{

//  alert($(this).attr('id'));
// })

 


});
