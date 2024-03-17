@extends('ADMIN.share.master')
@section('content')
    <div class="row">
        <div class="col-12">
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
                                <th class="text-center">{{ $value['name']}}</th>
                                <th class="text-center">{{ $value['email'] }}</th>
                                <th class="text-center">{{ $value['phone'] }}</th>
                                @if ($value['slug_history'] == 0 )
                                <th class="text-center text-nowrap">
                                    <a class="btn btn-warning"><b>Chưa thanh toán</b></a>
                                </th>
                                @else
                                <th class="text-center text-nowrap">
                                    <a class="btn btn-success"><b>Đã Thanh Toán</b></a>
                                </th>
                                @endif
                                <th class="text-center">{{ number_format($value['price'])  }} đ</th>
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
@endsection
