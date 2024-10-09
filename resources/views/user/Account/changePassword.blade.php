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
        <div class="col-8">
            <form action="/admin/account-user/update-password" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <input type="text" name="id" hidden value="{{ $Ac_user_edit->id }}">

                        <div class="mb-5">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="mb-5">
                            <label for="re_password">Confirm Password</label>
                            <input type="password" class="form-control" name="re_password" id="re_password">
                        </div>

                        <!-- Toggle password visibility -->
                        <div class="mb-3">
                            <input type="checkbox" id="show-password"> Show Password
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#show-password').on('change', function() {
                var type = $(this).is(':checked') ? 'text' : 'password';
                $('#password').attr('type', type);
                $('#re_password').attr('type', type);
            });
        });
    </script>
@endsection
