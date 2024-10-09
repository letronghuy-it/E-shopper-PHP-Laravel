@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" style="float: right; " data-bs-toggle="modal"
                        data-bs-target="#importModal">Nhập Hàng</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>

                            <tr class="text-center middle-align">
                                <th class="text-center middle-align">#</th>
                                <th class="text-center middle-align">Nhà Cung Cấp</th>
                                <th class="text-center middle-align">Tổng tiền nhập</th>
                                <th class="text-center middle-align">Ngày Nhập</th>
                                <th class="text-center middle-align">Người Nhập</th>
                                <th class="text-center middle-align">Hoạt Động</th>
                            </tr>
                        </thead>
                        <tbody id="invoice-importProduct">
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Nhà Cung Cấp
                                </td>
                                <td>
                                    Tổng tiền nhập
                                </td>
                                <td>
                                    Ngày Nhập
                                </td>
                                <td>
                                    Ngày Nhập
                                </td>
                                <td class="text-center middle-align">
                                    <button class="btn btn-info">Chi Tiết Đơn Nhập</button>
                                    <button class="btn btn-danger">Xoá Đơn Nhập</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Modal - Import-products --}}
                    <!-- Modal -->
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 90%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập Kho Sản Phẩm</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive"
                                                        style="max-height: 500px; overflow-y: auto;">
                                                        <table class="table table-bordered">
                                                            <thead
                                                                style="position: -webkit-sticky; position: sticky; top: 0; background-color: #eceef0; z-index: 1;">
                                                                <tr>
                                                                    <th colspan="4">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control"
                                                                                id="SearchProduct"
                                                                                placeholder="Tìm kiếm sản phẩm ...."
                                                                                name="">
                                                                            <button class="btn btn-primary"
                                                                                id="btn_searchProduct">Tìm Kiếm</button>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr class="text-center middle-align">
                                                                    <th>#</th>
                                                                    <th>Tên Sản Phẩm</th>
                                                                    <th>Giá Sản Phẩm</th>
                                                                    <th>Hoạt động</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="Import_SanPham">
                                                                {{-- <tr class="text-center middle-align">
                                                                    <td>
                                                                        1
                                                                    </td>
                                                                    <td>
                                                                        Áo Khoác Da Bò
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-success">Thêm Mới</button>
                                                                    </td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive"
                                                        style="max-height: 500px; overflow-y: auto;">
                                                        <table class="table table-bordered">
                                                            <thead
                                                                style="position: -webkit-sticky; position: sticky; top: 0; background-color: #eceef0; z-index: 1;">
                                                                <tr>
                                                                    <th colspan="4">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control"
                                                                                id="search-Product-Import"
                                                                                placeholder="Tìm kiếm sản phẩm ....">
                                                                            <button
                                                                                class="btn btn-primary search-Product-Import">Tìm
                                                                                Kiếm</button>
                                                                        </div>
                                                                    </th>
                                                                    <th colspan="3">
                                                                        <div class="input-group">

                                                                            <select class="form-control" name="name_company"
                                                                                id="id_supplier">
                                                                                <option value="0">Vui Lòng Chọn Công Ty
                                                                                </option>
                                                                                @foreach ($supplier as $key => $value)
                                                                                    <option value="{{ $value['id'] }}">
                                                                                        {{ $value['name_company'] }}
                                                                                    </option>
                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </th>

                                                                </tr>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Tên Sản Phẩm</th>
                                                                    <th>Giá Sản Phẩm</th>
                                                                    <th>Số Lượng</th>
                                                                    <th>Thành Tiền</th>
                                                                    <th>Ghi Chú</th>
                                                                    <th>Hoạt Động</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="LoadProductInBill">
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Sản phẩm A</td>
                                                                    <td>100,000 VND</td>
                                                                    <td>2</td>
                                                                    <td>200,000 VND</td>
                                                                    <td>
                                                                        <textarea type="text" class="form-control" width="20px" name="note"></textarea>
                                                                    <td><button class="btn btn-danger">Xoá</button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="text-align: right;">
                                                    <label for="label" id="total">0</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" id="import-product">Nhập Hàng</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            LoadDataImPortProduct();
            LoadProductInBill();
            fetchProducts();

            function LoadDataProduct(products) {
                let productTable = $('#Import_SanPham');
                productTable.empty();
                let html = ``;
                products.map((product, index) => {
                    html += `
                            <tr class="text-center middle-align">
                                  <td>${index + 1}</td>
                               <td>${product.name}</td>
                               <td>${formatPriceVND(product.price)}</td>
                              <td>
                                  <button class="btn btn-success import-port-in-bill" data-id="${product.id}">Thêm Mới</button>
                              </td>
                             </tr>
                         `;
                });

                productTable.append(html);
            }

            function fetchProducts() {
                $.ajax({
                    url: "{{ route('LoadDataProduct') }}",
                    method: 'GET',
                    success: function(response) {
                        let products = response.data;
                        LoadDataProduct(products);
                    },
                    error: function() {
                        console.error("Failed to load data");
                    }
                });
            }

            //Add - Product import Bill
            $(document).on('click', '.import-port-in-bill', function() {
                let productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('add.Product.in.Bill') }}",
                    method: 'POST',
                    data: {
                        id: productId,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function(response) {

                        console.log("Product added successfully:", response);
                        LoadProductInBill();

                    },
                    error: function(xhr) {
                        console.error("Failed to add product to bill:", xhr);

                    }
                });
            });
            //LoadProduct In Bill
            function LoadProductInBill() {
                $.ajax({
                    url: "{{ route('load.Product.In.Bill') }}",
                    method: 'GET',
                    success: function(response) {
                        let BillImportTable = $('#LoadProductInBill');
                        let total = $("#total");
                        BillImportTable.empty();

                        let BillImport = response.data;

                        let html = ``;

                        BillImport.map((productImport, index) => {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${productImport.name_product}</td>
                                    <td>${formatPriceVND( productImport.price_import)}</td>
                                    <td>${productImport.quantity_import}</td>
                                    <td>${ formatPriceVND(productImport.Total_amount)}</td>
                                    <td>
                                        <textarea type="text" class="form-control" width="20px" name="note"></textarea>
                                    <td><button class="btn btn-danger delete-product-inbill" data-id ="${productImport.id}"  >Xoá</button></td>
                                </tr>
                                `;

                        });
                        total.text(formatPriceVND(response.total));
                        BillImportTable.append(html);
                    },
                    error: function() {
                        console.error("Failed to load data");
                    }
                });
            }
            //fotmat giá tiền
            function formatPriceVND(price) {
                // Chuyển giá thành chuỗi và định dạng với dấu phẩy
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " ₫";
            }
            $(document).on('click', '#btn_searchProduct', function() {
                let key_search = $('#SearchProduct').val();
                $.ajax({
                    url: "{{ route('search-product') }}",
                    method: 'POST',
                    data: {
                        key_search: key_search,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        console.log("Product added successfully:", response);
                        LoadDataProduct(response.data);

                    },
                    error: function(xhr) {
                        console.error("Failed to add product to bill:", xhr);

                    }
                });

            })
            $(document).on('click', '.search-Product-Import', function() {
                let key_search = $('#search-Product-Import').val();

                $.ajax({
                    url: "{{ route('search.Product.in.Bill') }}",
                    method: 'POST',
                    data: {
                        key_search: key_search,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        console.log("Product added successfully:", response);
                        let BillImportTable = $('#LoadProductInBill');
                        BillImportTable.empty();

                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }

                        let BillImport = response.data;

                        let html = ``;

                        BillImport.map((productImport, index) => {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${productImport.name_product}</td>
                                    <td>${formatPriceVND( productImport.price_import)}</td>
                                    <td>${productImport.quantity_import}</td>
                                    <td>${ formatPriceVND(productImport.Total_amount)}</td>
                                    <td>
                                        <textarea type="text" class="form-control" width="20px" name="note"></textarea>
                                    <td><button class="btn btn-danger">Xoá</button></td>
                                </tr>
                                `;

                        });
                        BillImportTable.append(html);
                        toastr.success(response.message);

                    },
                    error: function(xhr) {
                        console.error("Failed to add product to bill:", xhr);
                        toastr.error(response.message);
                    }
                });

            });
            //ImportProduct
            $(document).on('click', '#import-product', function() {
                var id_suppliers = $('#id_supplier').val();
                var totalLabel = $("#total");
                var total_imports = parseFloat(totalLabel.text().replace(/[^0-9.-]+/g, "")) ||
                    0; // Chuyển đổi giá trị text thành số, nếu không có thì mặc định là 0
                $.ajax({
                    url: "{{ route('import.Product.Bill') }}",
                    method: 'POST',
                    data: {
                        id_suppliers: id_suppliers,
                        total_imports: total_imports
                    },
                    success: function(response) {
                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        LoadProductInBill();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.success(response.message);
                    }
                });

            })
            //LoadDataImPortProduct
            function LoadDataImPortProduct() {
                $.ajax({
                    url: "{{ route('Load.Invoice.Import.Product') }}",
                    method: 'GET',
                    success: function(response) {
                        let ImportTable = $('#invoice-importProduct');
                        ImportTable.empty();
                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        let ImportData = response.data;
                        let html = ``;
                        ImportData.map((value, index) => {
                            html += `
                             <tr>
                                <td>
                                    ${index + 1}
                                </td>
                                <td>
                                    ${value.name_company}
                                </td>
                                <td>
                                    ${formatPriceVND(value.total_imports)}
                                </td>
                                <td>
                                     ${value.day_import}
                                </td>
                                <td>
                                    ${value.name}
                                </td>
                                <td class="text-center middle-align">
                                <a class="btn btn-info" href="/admin/import-product/Detail-Importbill-product/${value.id}">Chi Tiết Đơn Nhập</a>
                                    <button class="btn btn-danger btn-delete-ImportProduct" data-id="${value.id}">Xoá Đơn Nhập</button>
                                </td>
                            </tr>
                                `;

                        });
                        ImportTable.append(html);
                    },
                    error: function() {
                        console.error("Failed to load data");
                    }
                });
            }
            //Delete Product Inbill
            $(document).on('click', '.delete-product-inbill', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('Delete.import.Product.Bill') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function(response) {

                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        console.log("Product added successfully:", response);
                        LoadProductInBill();
                        toastr.success(response.message);

                    },
                    error: function(xhr) {
                        console.error("Failed to add product to bill:", xhr);
                        toastr.error(response.message);
                    }
                });

            })
            //Delete Product
            $(document).on('click', '.btn-delete-ImportProduct', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('Delete.import.Product') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'

                    },
                    success: function(response) {

                        if (response.status !== 200) {
                            toastr.error(response.message);
                            return;
                        }
                        console.log("Product added successfully:", response);
                        LoadDataImPortProduct();
                        toastr.success(response.message);

                    },
                    error: function(xhr) {
                        console.error("Failed to add product to bill:", xhr);
                        toastr.error(response.message);
                    }
                });

            })

        });
    </script>
@endsection
