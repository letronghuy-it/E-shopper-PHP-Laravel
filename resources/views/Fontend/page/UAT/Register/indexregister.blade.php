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
                        <h2>New User Signup!</h2>
                        <form action="/shop/register-user" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            @endif

                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" name='avatar'>
                                @error('avatar')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="text" placeholder="Name" name="name">
                            @error('name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                            <input type="email" placeholder="Email" name="email">
                            @error('email')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                            <input type="password" placeholder="Password" name="password">
                            @error('password')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                            <input type="text" placeholder="Address" name="address">


                            <input type="text" name='phone' placeholder="84+  0337576158">
                            @error('phone')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label>Select Country</label>
                                <select class="form-control form-control-line" name='id_country'>
                                    @foreach ($country as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
