@extends('Fontend.share.masterFE')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (isset($getcart))
                            @foreach ($getcart as $key => $value)
                                <tr>
                                    <td class="cart_product">
                                        <a><img width="110px" height="110px"
                                                src="{{ '/upload/user/' . $value['id_user'] . '/image_product/' . $value['image'] }}"
                                                alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a>{{ $value['name'] }}</a></h4>
                                        <p>Web ID: 1089772</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ $value['price'] . '$' }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $value['quantity'] }}" autocomplete="off" size="2">
                                            <a class="cart_quantity_down"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{ $value['price'] * $value['quantity'] . '$' }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" data-id="{{ $key }}"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <h4>Không có sản phẩm</h4>
                        @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update">Get Quotes</a>
                        <a  class="btn btn-default check_out">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span id="Totalz">$61</span></li>
                        </ul>
                        <a class="btn btn-default update">Update</a>
                        <a href="/shop/check-out" class="btn btn-default check_out">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadData();
            //quantity_delete
            $(document).on('click', '.cart_quantity_delete', function() {
                var findkey = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('action.in.cart')) }}',
                    data: {
                        action: 'delete',
                        key_product: findkey,
                    },
                    success: function(res) {
                        loadData();
                    }
                });
            })
            //quantity_up
            $(document).on('click', '.cart_quantity_up', function() {
                var findkey = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('action.in.cart')) }}',
                    data: {
                        action: 'cart_quantity_up',
                        key_product: findkey,
                    },
                    success: function(res) {
                        console.log(res);
                        loadData();
                    }
                });
            })

            //quantity_down
            $(document).on('click', '.cart_quantity_down', function() {
                var findkey = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('action.in.cart')) }}',
                    data: {
                        action: 'cart_quantity_down',
                        key_product: findkey,
                    },
                    success: function(res) {

                        loadData();
                    }
                });
            })
            //Load data in cart
            function loadData() {
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('load.data.cart')) }}',
                    success: function(res) {
                        var datacart = res.getcart;
                        var id_product_user = res.getproduct[0]['id_user']
                        $('#Totalz').text(convert(res.totalprice));
                        $('#totalcart').text(res.totalqty);
                        var html = "";
                        if (datacart.length == 0) {
                            html = "Không có sản phẩm trong giỏ hàng!";
                        } else {
                            $.each(datacart, function(key, value) {
                                html += `
                                        <tr >
                                            <td class="cart_product">
                                                <a><img width="110px" height="110px"
                                                    src="/upload/user/${id_product_user}/image_product/${value.image}"
                                                        alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a>${value.name}</a></h4>
                                                <p>Web ID: 1089772</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>${convert(value.price)}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button" >
                                                    <a class="cart_quantity_up" data-id="${key}"> + </a>
                                                    <input class="cart_quantity_input"   type="text" name="quantity"
                                                    value="${value.quantity}" autocomplete="off" size="2">
                                                    <a class="cart_quantity_down" data-id="${key}"> - </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">${convert(value.price * value.quantity)}</p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" data-id="${key}"><i
                                                    class="fa fa-times"></i></a>
                                            </td>
                                        </tr>`;
                            });
                        }
                        $('table tbody').html(html);
                    }
                });
            }
            //conver price
            function convert(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }
        })
    </script>
@endsection
