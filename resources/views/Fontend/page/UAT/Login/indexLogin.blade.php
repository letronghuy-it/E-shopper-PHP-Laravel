@extends('Fontend.share.masterFE')
@section('content')
    <section id="form">
        <div class="container">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible"
                        style="position: fixed; top:0; right: 0; z-index: 9999;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="col-sm-8">
                    <div class="signup-form">
                        <h2>Login</h2>
                        <form action="/shop/login-user" method="post">
                            @csrf
                            <input type="email" placeholder="Email Address" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <div style="width: 100%; display: inline-block;">
                                <button style="float: left;" type="submit" class="btn btn-default">Login</button>
                                <a  style="float: right; margin-top: 0px" class="btn btn-primary"   href="/shop/register-user">Register</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
