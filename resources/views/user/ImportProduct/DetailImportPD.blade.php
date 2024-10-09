@extends('ADMIN.share.master')
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4" style="max-width: 30%; float: right;">

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center align-middle">
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên Sản Phẩm</th>
                                <th class="text-center">Giá Sản Phẩm</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Thành Tiền</th>
                                <th class="text-center">Ghi Chú</th>
                                <th class="text-center">Ngày Nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($detailformImport))
                                @foreach ($detailformImport as $key => $value)
                                    <tr class="text-center align-middle">
                                        <th class="text-center">{{ $key + 1 }}</th>
                                        <th class="text-center">{{ $value['name_product'] }}</th>
                                        <th class="text-center">{{ number_format($value['price_import']) }} đ
                                        </th>
                                        <th class="text-center">{{ $value['quantity_import'] }}</th>
                                        <th class="text-center">{{ number_format($value['Total_amount'])}} đ</th>
                                        <th class="text-center">{{ $value['note_import_product'] }}</th>
                                        <th class="text-center">{{ \Carbon\Carbon::parse($value['created_at'])->format('d-m-Y H:i') }}</th>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection

