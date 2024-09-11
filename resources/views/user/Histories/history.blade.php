@extends('ADMIN.share.master')
@section('content')
    <style>
        /* .disabled-link {
                                            pointer-events: none;
                                            cursor: not-allowed;
                                            opacity: 0.65;
                                        } */
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4" style="max-width: 30%; float: right;">
                        <form action="" method="POST">
                            @csrf
                            <select id="search-bill" name="search-bill" class="form-control"
                                onchange="window.location.href=this.value;">
                                <option value="{{ route('search.bil.history') }}">Hoá Đơn</option>
                                <option value="{{ route('search.bil.paided') }}">Hoá đơn Bán</option>
                                <option value="{{ route('search.bil.unapprove') }}">Hoá đơn chưa duyệt</option>
                                <option value="{{ route('search.bil.unpaid') }}">Hoá đơn chưa thanh toán</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center align-middle">
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Toltal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($history))
                                @foreach ($history as $key => $value)
                                    <tr class="text-center align-middle">
                                        <th class="text-center">{{ $key + 1 }}</th>
                                        <th class="text-center">{{ $value['name'] }}</th>
                                        <th class="text-center">{{ $value['email'] }}</th>
                                        <th class="text-center">{{ $value['phone'] }}</th>
                                        @if ($value['slug_history'] == 0)
                                            <th class="text-center text-nowrap">
                                                <a class="btn btn-warning"><b>Chưa thanh toán</b></a>
                                            </th>
                                        @else
                                            <th class="text-center text-nowrap">
                                                <a class="btn btn-success"><b>Đã Thanh Toán</b></a>
                                            </th>
                                        @endif
                                        <th class="text-center">{{ number_format($value['price']) }} đ
                                            <a class="btn btn-infor" href="/admin/history/invoice-detail/{{ $value['id'] }}"><b>Detail</b></a>

                                        </th>
                                        <th class="text-center text-nowrap">
                                            <a class="btn btn-danger"
                                                href="/admin/history/delete-history/{{ $value['id'] }}"><b>Remove</b></a>
                                            @if ($value['approve'] == 1)
                                                <a class="btn btn-success disabled-link" aria-disabled="true"
                                                    href="/admin/history/change-approve/{{ $value['id'] }}"><b>Approved</b></a>
                                            @else
                                                <a class="btn btn-secondary"
                                                    href="/admin/history/change-approve/{{ $value['id'] }}"><b>not
                                                        Approve</b></a>
                                            @endif
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
