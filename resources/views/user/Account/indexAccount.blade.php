@extends('ADMIN.share.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="position: fixed; bottom: 0; right: 0; z-index: 9999;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" style="position: fixed; bottom: 0; right: 0; z-index: 9999;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-times"></i> Lỗi!</h4>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="text-center">ID</th>
                        <th class="text-center">Name User</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Change Password</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($Ac_user))
                        @foreach ($Ac_user as $key => $value)
                            <tr class="text-center align-middle">
                                <th class="text-center">{{ $key + 1 }}</th>
                                <th class="text-center">{{ $value['name'] }}</th>
                                <th class="text-center">{{ $value['email'] }}</th>
                                <th class="text-center">{{ $value['phone'] }}</th>
                                <th class="text-center">
                                    @if ($value['status'] == 0)
                                        <a class="btn btn-success"
                                            href="/admin/account-user/block/{{ $value['id'] }}"><b>Activity</b></a>
                                    @else
                                        <a class="btn btn-danger"
                                            href="/admin/account-user/block/{{ $value['id'] }}"><b>Block</b></a>
                                    @endif
                                </th>
                                <th class="text-center"> <a class="btn btn-info"
                                        href="/admin/account-user/update-password/{{ $value['id'] }}"><b>Change_Password</b></a>
                                </th>
                                <th class="text-center text-nowrap">
                                    <a class="btn btn-danger"
                                        href="/admin/account-user/delete/{{ $value['id'] }}"><b>Remove</b></a>
                                </th>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
