@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <!-- Tiêu đề trang -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
        </div>

        <!-- Dòng thống kê -->
        <div class="row">

            <!-- Người dùng -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Người dùng</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($users_count) }}</div>
                            </div>
                            <div class="bg-primary text-white rounded-circle p-3">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chuyến đi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Chuyến đi</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($travel_packages_count) }}</div>
                            </div>
                            <div class="bg-success text-white rounded-circle p-3">
                                <i class="fas fa-route fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vé đã đặt -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Vé đã đặt</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($orders_count) }}</div>
                            </div>
                            <div class="bg-warning text-white rounded-circle p-3">
                                <i class="fas fa-ticket-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doanh thu -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs fw-bold text-danger text-uppercase mb-1">Doanh thu</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($revenue) }} VNĐ</div>
                            </div>
                            <div class="bg-danger text-white rounded-circle p-3">
                                <i class="fas fa-coins fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ Doanh thu ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái Đơn hàng</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <i class="fas fa-circle text-warning"></i> Chờ duyệt ({{ $statusCounts['pending'] ?? 0 }})
                            </div>
                            <div class="col-6 mb-2">
                                <i class="fas fa-circle text-success"></i> Đã duyệt ({{ $statusCounts['confirmed'] ?? 0 }})
                            </div>
                            <div class="col-6">
                                <i class="fas fa-circle text-primary"></i> Hoàn thành
                                ({{ $statusCounts['completed'] ?? 0 }})
                            </div>
                            <div class="col-6">
                                <i class="fas fa-circle text-danger"></i> Đã hủy ({{ $statusCounts['cancelled'] ?? 0 }})
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script-alt')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Revenue Chart
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    datasets: [{
                        label: "Doanh thu",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: {!! json_encode($chartRevenue) !!},
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    return new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ';
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function (tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + new Intl.NumberFormat('vi-VN').format(tooltipItem.yLabel) + ' VNĐ';
                            }
                        }
                    }
                }
            });

            // Pie Chart
            var ctxPie = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ["Chờ duyệt", "Đã duyệt", "Hoàn thành", "Đã hủy"],
                    datasets: [{
                        data: {{ json_encode($chartStatus) }},
                        backgroundColor: ['#f6c23e', '#1cc88a', '#4e73df', '#e74a3b'],
                        hoverBackgroundColor: ['#dda20a', '#17a673', '#2e59d9', '#be2617'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                                    return previousValue + currentValue;
                                }, 0);
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = 0;
                                if (total > 0) {
                                    percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                }
                                return data.labels[tooltipItem.index] + ': ' + currentValue + ' đơn (' + percentage + '%)';
                            }
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
        });
    </script>
@endpush