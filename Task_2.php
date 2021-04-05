<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
   
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

   

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Add data</h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Insert data</h4>
                                </div>
                                <div class="card-body">
                                    <form action="/index.html" class="form form-horizontal ">
                                        <div class="row">
                                            
                                           
                                            <div class="col-12">

                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Data</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="fp-default" class="form-control " placeholder="data" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Message</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="fp-default" class="form-control " placeholder="message" />
                                                    </div>
                                                </div>
                                            </div>
                                          



                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="reset" class="btn btn-primary mr-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- Basic Horizontal form layout section end -->



            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    
    <!-- End: Customizer-->

    <!-- Buynow Button-->
   

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   
    <script>
    var gconfig = {
    'client_id': '954247199180-oevnp37lpb7upta8j6jo7tfa1ipnlf46.apps.googleusercontent.com',
    'scope': 'https://www.googleapis.com/auth/bigquery'
};
$.getScript("https://apis.google.com/js/client.js", function(d) {
  function loadGAPI() {
    setTimeout(function() {
      if (!gapi.client) {
        loadGAPI();
      } else {
        loadBigQuery();
      }
    }, 500);
  }
  
  function loadBigQuery() {
    gapi.client.load('bigquery', 'v2');
    setTimeout(function() {
      if (!gapi.client.bigquery) {
        loadBigQuery();
      } else {
        onClientLoadHandler();
      }
    }, 500);
  }
  
  loadGAPI();
});
function runQuery1() {
    var request = gapi.client.bigquery.jobs.query({
      'projectId': "bigdatameetup-83116",
      'timeoutMs': '30000',
      'query': 'SELECT DATE(time_ref) as date,SUM(INTEGER(trade_value)) as total_orders FROM [online-fourm:a1_2.test] limit 50; '
    });
    request.execute(function(response) {
      var bqData = [];

      response.result.rows.forEach(function(d) {
        bqData.push({"date": d3.time.format("%Y-%m-%d").parse(d.f[0].v),
          "total_orders": +d.f[1].v});
      });
      
      drawLineChart(bqData);
    });
  }
  function runQuery2() {
    var request = gapi.client.bigquery.jobs.query({
      'projectId': "bigdatameetup-83116",
      'timeoutMs': '30000',
      'query': 'SELECT “country_label”,“product_type”,“trade deficient value” FROM [online-fourm:a1_2.test] order by desc limit 50; '
    });
    request.execute(function(response) {
      var bqData = [];

      response.result.rows.forEach(function(d) {
        bqData.push({"date": d3.time.format("%Y-%m-%d").parse(d.f[0].v),
          "total_orders": +d.f[1].v});
      });
      
      drawLineChart(bqData);
    });
  }
  function runQuery3() {
    var request = gapi.client.bigquery.jobs.query({
      'projectId': "bigdatameetup-83116",
      'timeoutMs': '30000',
      'query': 'SELECT DATE(time_ref) as date,SUM(INTEGER(trade_value)) as total_orders FROM [online-fourm:a1_2.test] limit 30; '
    });
    request.execute(function(response) {
      var bqData = [];

      response.result.rows.forEach(function(d) {
        bqData.push({"date": d3.time.format("%Y-%m-%d").parse(d.f[0].v),
          "total_orders": +d.f[1].v});
      });
      
      drawLineChart(bqData);
    });
  }

  function drawLineChart(bqData) {
  var WIDTH = config.width, HEIGHT = config.height;
  var Y_AXIS_LABEL = "total_orders";
  var X_DATA_PARSE = d3.time.format("%d-%b-%y").parse;
  var Y_DATA_PARSE = vida.number;
  var X_DATA_TICK = d3.time.format("%b-%y");
  var X_AXIS_COLUMN = "date";
  var Y_AXIS_COLUMN = "total_orders";
  var margin = {top: 20, right: 20, bottom: 30, left: 50},
      width = WIDTH - margin.left - margin.right,
      height = HEIGHT - margin.top - margin.bottom;
  var x = d3.time.scale()
      .range([0, width]);
    var y = d3.scale.linear()
      .range([height, 0]);
  var xAxis = d3.svg.axis()
      .scale(x)
      .orient("bottom")
      .tickFormat(X_DATA_TICK);
  var yAxis = d3.svg.axis()
      .scale(y)
      .orient("left")
      .tickFormat(function(d) {
        return d / 1000000 + "M";
      });
  var line = d3.svg.line()
      .interpolate("basis")
      .x(function(d) { return x(d.x_axis); })
      .y(function(d) { return y(d.y_axis); });
  
  var svg = d3.select("#canvas-svg").append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
  
  bqData.forEach(function(d) {
    d.x_axis = d[X_AXIS_COLUMN];
    d.y_axis = d[Y_AXIS_COLUMN];
  });
  
  bqData.sort(function(a, b) {
    return (new Date(a.x_axis)) - (new Date(b.x_axis));
  });
  
  x.domain(d3.extent(bqData, function(d) { return d.x_axis; }));
  y.domain(d3.extent(bqData, function(d) { return d.y_axis; }));
  
  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);
  
  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text(Y_AXIS_LABEL);
  
  svg.append("path")
      .datum(bqData)
      .attr("class", "line")
      .attr("d", line);
  
  }
    </script>
</body>
<!-- END: Body-->

</html>