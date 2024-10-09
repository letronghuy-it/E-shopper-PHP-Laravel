@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuAccount')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Cập Nhật Đơn Hàng</h2>
            <div class="signup-form">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-0">
                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Sản Phẩm</td>
                                            <td class="description"></td>
                                            <td class="price">Giá</td>
                                            <td class="quantity">Số Lượng</td>
                                            <td class="total">Thành Tiền</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($re_bill as $key => $value)
                                            <tr>
                                                <td class="cart_product">
                                                    <a><img width="80px" height="80px"
                                                            src="/upload/user/1/image_product/{{ $value['image_product'] }}"
                                                            alt=""></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a>{{ $value['name_product'] }}</a></h4>
                                                </td>
                                                <td class="cart_price">
                                                    <p>{{ number_format($value['price'], 0, ',', '.') }}</p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <input class="cart_quantity_input form-control" disabled type="text"
                                                        name="quantity" value="{{ $value['qty'] }}" autocomplete="off"
                                                        size="2">
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">
                                                        {{ number_format($value['price'] * $value['qty'], 0, ',', '.') }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                            <td colspan="6">
                                                <input type="hidden" class="form-control" id="id_user"
                                                    value="{{ $history_information['id_user'] }}" name="id">
                                                <div class="form-group">
                                                    <label for="name">Tên Khách Hàng</label>
                                                    <input type="text" class="form-control" id="name"
                                                        value="{{ $history_information['name']  }}" name="name"
                                                        placeholder="Nhập tên  của bạn">
                                                </div>
                                            </td>

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <label for="address">Địa Chỉ:</label>
                                                        <input type="text" class="form-control" id="address"
                                                            value="{{ $history_information['address'] }}" name="address"
                                                            placeholder="Nhập địa chỉ của bạn">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="text" class="form-control" id="email"
                                                            value="{{ $history_information['email'] }}"  disabled ="email"
                                                            placeholder="Nhập Email ỉ của bạn">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <label for="address">Số Điện Thoại</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $history_information['phone'] }}" name="phone"
                                                            placeholder="Nhập số điện thoại của bạn">
                                                    </div>
                                                </td>
                                            </tr>
                                        <tr>
                                            <td colspan="4">
                                            </td>
                                            <td colspan="2">
                                                <table class="table table-condensed total-result">
                                                    <tbody>
                                                        <tr class="text-end">
                                                            <td>Tổng tiền phải trả :</td>

                                                                <th><span>{{ number_format($history_information['total_price'], 0, ',', '.') }}
                                                                        đ</span></th>

                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <button id="update-bill" class="btn btn-primary">Cập
                                                                    Nhật Thông Tin</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

            $(document).on('click', '#update-bill', function() {
                var id = $('#id_user').val();
                var name_user = $('#name').val();
                var address = $('#address').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ url(route('update-bill')) }}',
                    data: {
                        id: id,
                        name: name_user,
                        address: address,
                        phone: phone,
                        email: email
                    },
                    success: function(response) {
                        console.log('Success Res: ',
                        response);

                        if (response.status === 200) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('Error: ', error);
                    }
                });
            })

        });
    </script>
@endsection
