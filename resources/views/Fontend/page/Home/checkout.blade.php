@extends('Fontend.share.masterFE')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="step-one">
                <h2 class="heading">Step1</h2>
            </div>
            <div class="checkout-options">
                <h3>New User</h3>
                <p>Checkout options</p>
                <ul class="nav">
                    <li>
                        <label><input type="checkbox"> Register Account</label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Guest Checkout</label>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-times"></i>Cancel</a>
                    </li>
                </ul>
            </div><!--/checkout-options-->

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        @if (session()->get('Islogin') == true)
                            <div class="bill-to">
                                <p>Bill To</p>
                                <div class="form-one">
                                    <form>
                                        <input type="text" placeholder="Company Name">
                                        <input type="text" placeholder="Email*">
                                        <input type="text" placeholder="Title">
                                        <input type="text" placeholder="First Name *">
                                        <input type="text" placeholder="Middle Name">
                                        <input type="text" placeholder="Last Name *">
                                        <input type="text" placeholder="Address 1 *">
                                        <input type="text" placeholder="Address 2">
                                    </form>
                                </div>
                            </div>
                        @endif
                        @if (session()->get('Islogin') == false)
                            <div class="signup-form">
                                <p>New User Signup!</p>
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
                        @endif

                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
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

                        @if (isset($getcart))
                            @foreach ($getcart as $key => $value)
                                <tr>
                                    <td class="cart_product">
                                        <a><img width="110px" height="110px"
                                                src="{{ '/upload/user/' . $get_id_user . '/image_product/' . $value['image'] }}"
                                                alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a>{{ $value['name'] }}</a></h4>
                                        <p>Web ID: 1089772</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($value['price']) . ' đ' }}</p>
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
                                        <p class="cart_total_price">
                                            {{ number_format($value['price'] * $value['quantity']) . ' đ' }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" data-id="{{ $key }}"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <h4>Không có sản phẩm</h4>
                        @endif
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$59</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>{{ number_format($totalprice) . ' đ' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button id="continue" class="btn btn-primary">Continue</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#continue').click(function() {
            $.ajax({
                type: 'POST',
                url: '{{ url(route('oder.bill')) }}',
                success: function(res) {
                    alert(res.message);
                    location.reload();
                }
            });
        })

        function convert(number) {
            return new Intl.NumberFormat('vi-VI', {
                style: 'currency',
                currency: 'VND'
            }).format(number);
        }
    </script>
@endsection
