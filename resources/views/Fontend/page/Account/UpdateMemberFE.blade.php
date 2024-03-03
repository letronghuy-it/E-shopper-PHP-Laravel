@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuAccount')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Update user</h2>
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <form action="/shop/account/update-account" method="POST">
                    @csrf
                    @if ($errors->any())
                    @endif
                    <input type="hidden" value="{{ Auth::user()->id }}">

                    <input type="text" placeholder="Name" value="{{ Auth::user()->name }}">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="email" placeholder="Email Address" value="{{ Auth::user()->email }}">
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="password" placeholder="Password" value="{{ Auth::user()->password }}">
                    @error('password')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="text" placeholder="Address" name="address" value="{{ Auth::user()->address }}">
                    @error('address')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="text" name='phone' placeholder="84+  " value="{{ Auth::user()->phone }}">
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

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name='avatar'>
                        <img src="{{ asset('upload/user/avatar/' . Auth::user()->avatar) }}" class="rounded-circle"
                            width="150" />
                        @error('avatar')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-default">Signup</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
