@extends('layouts.main')
@section('main.content')
    <style>
        .card-bg-voilet {
            background: linear-gradient(to right, #654ea3, #eaafc8);
            color: #fff !important;
        }
        .card-bg-lunada {
            background: linear-gradient(to right, #5433ff, #20bdff, #a5fecb);
            color: #fff !important;
        }
        .card-bg-anwar {
            background: linear-gradient(to right, #334d50, #cbcaa5);
            color: #fff !important;
        }
        .card-bg-flare {
            background: linear-gradient(to right, #f12711, #f5af19);
            color: #fff !important;
        }
        .card-bg-amin {
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            color: #fff !important;
        }
        .card-bg-neuro {
            background: linear-gradient(to right, #f953c6, #b91d73);
            color: #fff !important;
        }
        .text-white {
            color: #fff;
        }
        .card-title {
            font-size: 30px !important;
        }
        .card-subtitle {
            margin-top: 0;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- first row start -->
                <div class="row mb-2">
                    <div class="col-lg-8">
                        <!-- inner row -->
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-bg-amin">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($totalOrder->todayOrder) }}</h2>
                                        <h6 class="card-subtitle text-white">Todays Order</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-bg-lunada">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ $totalOrder->totalOrder - $orderComplete->totalOrderComplete }}</h2>
                                        <h6 class="card-subtitle text-white">Total Order Panding</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-bg-anwar">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ $orderComplete->totalOrderComplete }}</h2>
                                        <h6 class="card-subtitle text-white">Total Order Complete</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card  card-bg-neuro">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($purchasePrice->totalPurchasePrice) }}</h2>
                                        <h6 class="card-subtitle text-white">Todays Purchase Amount</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-bg-flare">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($orderPrice->totalOrderAmount) }}</h2>
                                        <h6 class="card-subtitle text-white">Todays Sale Amount</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-bg-voilet">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($todayCollection->todayCollection) }}</h2>
                                        <h6 class="card-subtitle text-white">Todays Total Collection</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="min-height: 55%;">
                            <div class="card-body">
                                <div id="top_x_div" style="width: 600px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <div id="piechart" style="max-width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                        <!-- inner row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-bg-amin">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($purchaseInMonth->purchaseInMonth) }}</h2>
                                        <h6 class="card-subtitle text-white">Total Purchase</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-bg-anwar">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($saleInMonth->saleInMonth) }}</h2>
                                        <h6 class="card-subtitle text-white">Total Sale</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-bg-neuro">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($collectionInMonth->collectionInMonth) }}</h2>
                                        <h6 class="card-subtitle text-white">Total Collection</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-bg-voilet">
                                    <div class="card-body text-center">
                                        <h2 class="card-title text-white">{{ abs($saleInMonth->saleInMonth - $collectionInMonth->collectionInMonth) }}</h2>
                                        <h6 class="card-subtitle text-white">Total Due</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- first row end -->

                <!-- second row start -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle">Your Recent Order</h5>
                                <!-- table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Order Total</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Ordered Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recentOrders as $recentOrder)
                                        <tr>
                                            <th scope="row">{{ $recentOrder->orderId }}</th>
                                            <td>{{ $recentOrder->orderTotal }}</td>
                                            <td>{{ $recentOrder->payment_status }}</td>
                                            <td>{{ $recentOrder->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle">Top Selling Product</h5>
                                <!-- table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Ordered Times</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($topSalingProducts as $product)
                                        <tr>
                                            <th scope="row">{{ $product->productId }}</th>
                                            <td>{{ $product->productName }}</td>
                                            <td>{{ $product->topproduct }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second row end -->

                @foreach($topCategories as $tc)
                    [{{$tc->categoryName}}, {{$tc->topcaterogy}}],
                @endforeach
            </div>
        </div>
    </div>


@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            @foreach($topCategories as $tc)
            ['{{$tc->categoryName}}', {{$tc->topcaterogy}}],
            @endforeach
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
{{--        sale last 7 days--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            @foreach($last7dayssales as $ls)
            ['{{$ls->saledate}}', '{{$ls->totalsale}}'],
            @endforeach

        ]);

        var options = {
            width: 800,
            legend: { position: 'none' },
            chart: {
                title: 'Last 7 days Sale',
               },


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
    };
</script>
