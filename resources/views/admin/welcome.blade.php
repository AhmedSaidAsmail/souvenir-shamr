@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Main page</a>
            </li>
        </ul>
        <div class="dashboard-shortcut-wrapper row">
            <div class="col-md-3">
                <div class="dashboard-shortcut red">
                    <span class="number">150</span>
                    <span class="number-ref">New Orders</span>
                    <i class="fas fa-shopping-bag"></i>
                    <div class="dashboard-ref-footer">
                        <a href="">More info <i class="fas fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-shortcut green">
                    <span class="number">50</span>
                    <span class="number-ref">Unique Visitors</span>
                    <i class="fas fa-chart-pie"></i>
                    <div class="dashboard-ref-footer">
                        <a href="">More info <i class="fas fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-shortcut yellow">
                    <span class="number">1050</span>
                    <span class="number-ref">Products</span>
                    <i class="fab fa-product-hunt"></i>
                    <div class="dashboard-ref-footer">
                        <a href="">More info <i class="fas fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-shortcut turquoise">
                    <span class="number">150</span>
                    <span class="number-ref">Customers</span>
                    <i class="fas fa-user"></i>
                    <div class="dashboard-ref-footer">
                        <a href="">More info <i class="fas fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome-counting">
            <div class="row">
                <div class="col">
                    <div class="chart">
                        <canvas id="barChart" style="height: 230px; width: 510px;" height="230" width="510"></canvas>
                    </div>
                </div>
                <div class="col last-orders">
                    <h1>Last Orders</h1>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0080</td>
                            <td>240.00 $</td>
                            <td>2Checkout</td>
                            <td>Sep, 03 2019</td>
                            <td>
                                <button class="btn btn-success">Completed</button>
                            </td>
                        </tr>
                        <tr>
                            <td>0081</td>
                            <td>60.00 $</td>
                            <td>Paypal</td>
                            <td>Sep, 03 2019</td>
                            <td>
                                <button class="btn btn-warning">pending</button>
                            </td>
                        </tr>
                        <tr>
                            <td>0080</td>
                            <td>240.00 $</td>
                            <td>2Checkout</td>
                            <td>Sep, 03 2019</td>
                            <td>
                                <button class="btn btn-success">Completed</button>
                            </td>
                        </tr>
                        <tr>
                            <td>0081</td>
                            <td>60.00 $</td>
                            <td>Paypal</td>
                            <td>Sep, 03 2019</td>
                            <td>
                                <button class="btn btn-warning">pending</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-secondary btn-block">
                        see all orders
                    </a>
                </div>
            </div>
        </div>
        <div class="most-product">
            <div class="card">
                <div class="card-header">
                    <h2>Most-selling Product <span>Mar-2019</span></h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price <i class="fas fa-dollar-sign"></i></th>
                            <th>Vendor</th>
                            <th>Quantity</th>
                            <th>Last Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>TV Lg 32inch - smart</td>
                            <td>3600,00</td>
                            <td>vendor@vendors.com</td>
                            <td>20</td>
                            <td>Mar ,3-2019</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @parent
    <script src="{{asset('js/plugins/chartjs/Chart.min.js')}}"></script>
    <script>
        $(function () {
            var areaChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Electronics",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Digital Goods",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };
            //Create the line chart


            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
</script>
@endsection