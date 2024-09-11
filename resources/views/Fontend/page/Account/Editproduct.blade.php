@extends('Fontend.share.masterFE')
<style>
    .custom-alert {
        font-size: 1.2em;
    }
</style>
@section('content')
    @include('Fontend.share.menuAccount')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Update Product</h2>
            <div class="signup-form">
                <h2>Update product Signup!</h2>
                <form action="{{ url('/admin/edit-product/' . $product->id) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible"
                            style="position: fixed; top:40; right: 0; z-index: 9999;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible"
                            style="position: fixed; top:40; right: 0; z-index: 9999;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif


                    <input type="hidden" value="{{ $product->id }}">
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="text" placeholder="Name" value="{{ $product->name }}" name="name">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    <input type="number" placeholder="Price" value="{{ $product->price }}" name="price">
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
                        value="{{ $product->sale }}" placeholder="0">%

                    <input type="text" placeholder="Company profile" name="company" value="{{ $product->company }}">
                    @error('company')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <div class="form-group" style="width: 100%">
                        <label>Image Product</label>
                        <input type="file" name='image_product[]' multiple>
                        @php
                            $images = json_decode($product->image_product);
                        @endphp

                        @if (!empty($images))
                            @foreach ($images as $image)
                                <div style="width: 20%; display: inline-block;">
                                    <input type="checkbox" id="" name="removeimage[]" value="{{ $image }}">
                                    <label>
                                        <a href=""><img width="100px" height="100px"
                                                src="{{ '/upload/user/' . $product->id_user . '/image_product/' . $image }}"
                                                alt=""></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    @error('image_product')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <textarea name="detail" id="" cols="30" rows="10" placeholder="Detail:">{{ $product->detail }}</textarea>
                    <button type="submit" class="btn btn-default">Update</button>
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
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000); // Thông báo sẽ tự động ẩn sau 5 giây


        });
    </script>
@endsection
