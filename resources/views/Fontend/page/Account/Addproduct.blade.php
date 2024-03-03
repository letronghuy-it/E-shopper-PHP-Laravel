@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuAccount')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Create Product</h2>
            <div class="signup-form">
                <h2>New product Signup!</h2>
                <form action="/shop/account/add-product" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible"
                            style="position: fixed; bottom:0; right: 0; z-index: 9999;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{ session('success') }}
                        </div>
                    @endif

                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="text" placeholder="Name" name="name">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="number" placeholder="Price" name="price">
                    @error('price')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <select class="form-control form-control-line" name='id_category'>
                            <option value="0">Plase choose category</option>
                            @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_category')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <select class="form-control form-control-line" name='id_brand'>
                            <option value="0">Plase choose brand</option>
                            @foreach ($brand as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('id_brand')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <select class="form-control form-control-line" name='status' id="status">
                            <option value="0">New</option>
                            <option value="1">Sale</option>
                        </select>
                    </div>

                    <input style="width: 30%; display: inline-block;" id="sale" type="number" name="sale"
                        placeholder="0">%

                    <input type="text" placeholder="Company profile" name="company">
                    @error('company')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>Image Product</label>
                        <input type="file" name='image_product[]' multiple>

                    </div>
                    @error('image_product')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <textarea name="detail" id="" cols="30" rows="10" placeholder="Detail:"></textarea>
                    <button type="submit" class="btn btn-default">Signup</button>
                </form>
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

            // Kiểm tra giá trị ban đầu của #status
            if ($('#status').val() == '0') {
                $('#sale').prop('disabled', true);
            }

            // Thêm  change cho #status
            $('#status').change(function() {
                if ($(this).val() == '0') {
                    $('#sale').prop('disabled', true);
                } else {
                    $('#sale').prop('disabled', false);
                }
            });


        });
    </script>
@endsection
