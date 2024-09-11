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
                                <th class="text-center">Name_product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">qty</th>
                                <th class="text-center">total_amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($invoice_detail))
                                @foreach ($invoice_detail as $key => $value)
                                    <tr class="text-center align-middle">
                                        <th class="text-center">{{ $key + 1 }}</th>
                                        <th class="text-center">{{ $value['name_product'] }}</th>
                                        <th class="text-center">{{ number_format($value['price']) }} đ
                                        </th>
                                        <th class="text-center">{{ $value['qty'] }}</th>
                                        <th class="text-center">{{ number_format($value['total_amount'])}} đ</th>
                                        <th class="text-center">{{ \Carbon\Carbon::parse($value['created_at'])->format('d-m-Y H:i') }}</th>
                                        <th class="text-center text-nowrap">
                                            <a class="btn btn-danger"
                                                href="/admin/history/delete-history/{{ $value['id'] }}"><b>Remove</b></a>
                                        </th>
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
