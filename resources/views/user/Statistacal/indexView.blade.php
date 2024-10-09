@extends('ADMIN.share.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><b>Số lượng hàng tồn kho</b></h4>
                        <div class="mt-3" id="chartjs">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title m-b-5"><b>Tổng thu chi</b></h5>
                                <h3 class="font-light" id="totalAll"></h3>
                            </div>
                            <div class="col-6">
                                <h5 class="card-title m-b-5"><b>Doanh thu</b></h5>
                                <h3 class="font-light" id="total-sales"></h3>
                            </div>
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <h5 class="card-title m-b-5"><b>Công nợ</b></h5>
                                <h3 class="font-light" id="debt"></h3>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <label for="label">Từ Ngày</label>
                            <input type="date" name="start_date" id="nextDay" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label for="label">Đến Ngày</label>
                            <input type="date" name="end_date" id="endDay" class="form-control">
                        </div>
                        <button style="float: right" class="btn btn-success" id="searchButton">Tìm Kiếm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Các Đơn Hàng Bán Được </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Tên sản phẩm</th>
                                    <th class="border-top-0">Số Lượng</th>
                                    <th class="border-top-0">Ngày Bán</th>
                                    <th class="border-top-0">Giá Bán</th>
                                    <th class="border-top-0">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody id="LoadProductSaled">
                                {{-- <tr>
                                    <td class="txt-oflo">Elite admin</td>
                                    <td><span class="label label-success label-rounded">1</span> </td>
                                    <td class="txt-oflo">April 18, 2017</td>
                                    <td><span class="font-medium">$24</span></td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><b>Đánh sản phẩm</b></h4>
                    </div>
                    <div class="comment-widgets" style="height:430px;">
                        <!-- Comment Row -->
                        {{-- <div class="d-flex flex-row comment-row">
                            <div class="p-2">
                                <img src="../../assets/images/users/4.jpg" alt="user" width="50"
                                    class="rounded-circle">
                            </div>
                            <div class="comment-text active w-100">
                                <h6 class="font-medium">Michael Jorden</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type
                                    setting industry. </span>
                                <div class="comment-footer ">
                                    <span class="text-muted float-right">April 14, 2016</span>
                                    <span class="label label-success label-rounded">Approved</span>
                                    <span class="action-icons active">
                                        <a href="javascript:void(0)">
                                            <i class="icon-close"></i>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="ti-trash text-danger"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let myChart = null; // Biến global để lưu instance của chart

            LoadStatistical();
            loadProductReiew();
            $('#searchButton').click(function() {
                const startDate = $('#nextDay').val();
                const endDate = $('#endDay').val();
                $.ajax({
                    url: "{{ route('handle.Statistical.All') }}",
                    type: 'POST',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        updateStatisticalUI(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            function LoadStatistical() {
                $.ajax({
                    url: "{{ route('Load.Statistical.All') }}",
                    type: 'GET',
                    success: function(response) {
                        updateStatisticalUI(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function updateStatisticalUI(response) {
                let stockProductData = response.inventory;

                const labels = stockProductData.map(value => value.name_product || "");
                const data = stockProductData.map(value => value.total_quantity || 0);
                if (myChart) {
                    myChart.destroy();
                }

                const ctx = $('#myChart');

                if (stockProductData.length === 0) {
                    ctx.parent().hide();
                    $('#noDataMessage').show();
                } else {
                    ctx.parent().show();
                    $('#noDataMessage').hide();

                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Số lượng tồn kho',
                                data: data,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Số lượng tồn'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Sản phẩm'
                                    }
                                }
                            }
                        }
                    });
                }

                let DataProductSale = response.soldProduct;
                let html = ``;

                if (response.status !== 200) {
                    toastr.error(response.message);
                    return;
                }

                if (DataProductSale.length === 0) {
                    html += `<tr><td colspan="5" class="text-center">Không có sản phẩm nào được bán.</td></tr>`;
                } else {
                    DataProductSale.map(function(value, index) {
                        html += `<tr>
                    <td class="txt-oflo">${value.name_product}</td>
                    <td><span class="label label-success label-rounded">${value.qty}</span> </td>
                    <td class="txt-oflo">${new Date(value.created_at).toLocaleDateString()}</td>
                    <td><span class="font-medium">${formatPriceVND(value.price)}</span></td>
                    <td><span class="font-medium">${formatPriceVND(value.total_amount)}</span></td>
                </tr>`;
                    });
                }


                $('#LoadProductSaled').html(html);
                $('#totalAll').text(formatPriceVND(response.net_revenue));
                $('#total-sales').text(formatPriceVND(response.total_sales));
                $('#debt').text(formatPriceVND(response.total_imports));
            }

            function loadProductReiew() {
                $.ajax({
                    url: "{{ route('Load.user.Review') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log(response);

                        let dataReiew = response.data;
                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        let html = ``;
                        dataReiew.map(function(reiew, index) {
                            html += `
                                <div class="d-flex flex-row comment-row">
                                   <div class="p-2">
                                       <img src="/upload/user/avatar/${reiew.avatar_user}" alt="user" width="50" class="rounded-circle">
                                   </div>
                                   <div class="comment-text active w-100">
                                       <h6 class="font-medium">${reiew.name_user}</h6>
                                       <span class="m-b-15 d-block">${reiew.review}</span>
                                       <div class="comment-footer">
                                           <span class="text-muted float-right">${new Date(reiew.created_at).toLocaleDateString()}</span>
                                           <span class="label label-success label-rounded">Approved</span>
                                           <span class="action-icons active">
                                               <a href="javascript:void(0)">
                                                   <i class="icon-close"></i>
                                               </a>
                                               <a href="javascript:void(0)">
                                                   <i class="ti-trash text-danger delete-review" data-id="${reiew.id}"></i>
                                               </a>
                                           </span>
                                       </div>
                                   </div>
                                </div>`;
                        })
                        $('.comment-widgets').html(html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
            $(document).on('click', '.delete-review', function() {
                let idReiew = $(this).data('id');
                $.ajax({
                    url: "{{ route('Destroy.user.Review') }}",
                    type: 'POST',
                    data: {
                        idReview: idReiew,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        loadProductReiew();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        toastr.error(response.message);
                    }
                });

            })

            function formatPriceVND(price) {
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " ₫";
            }
        });
    </script>
@endsection
