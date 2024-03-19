@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuleft')
    @php
        $image = json_decode($productdetail->image_product);
    @endphp
    <section>
        <div class="col-sm-9 padding-right">
            <div class="product-details"><!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{{ '/upload/user/' . $productdetail->id_user . '/image_product/' . $image[0] }}"
                            alt="">
                        <a href="{{ '/upload/user/' . $productdetail->id_user . '/image_product/' . $image[0] }}"
                            rel="prettyPhoto">
                            <h3>ZOOM</h3>
                        </a>
                    </div>
                    <div id="similar-product" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @php
                                $dem = 0;
                            @endphp

                            @foreach ($image as $key => $value)
                                <div class="item @if ($dem == 0) active @endif">
                                    @foreach ($image as $images)
                                        <a><img width="60px" id="imageproduct"
                                                src="{{ '/upload/user/' . $productdetail->id_user . '/image_product/' . $images }}"
                                                alt=""></a>
                                    @endforeach
                                </div>
                                @php
                                    $dem++;
                                @endphp
                            @endforeach

                        </div>

                        <!-- Controls -->
                        <a class="left item-control" href="/frontend/#similar-product" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right item-control" href="/frontend/#similar-product" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
                <div class="col-sm-7">
                    <div class="product-information">
                        <img src="/frontend/images/product-details/new.jpg" class="newarrival" alt="" />
                        <h2>{{ $productdetail->name }}</h2>
                        <p>Web ID: 1089772</p>
                        <img src="/frontend/images/product-details/rating.png" alt="" />
                        <span>
                            <span>{{ number_format($productdetail->price) }}đ</span>
                            <label>Quantity:</label>
                            <input type="text" value="1" />
                            <button type="button" class="btn btn-fefault cart" data-id={{ $productdetail->id }}
                                id="add-to-cart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                        </span>
                        <p><b>Category: </b> {{ $productdetail->category }}</p>

                        <p><b>Condition:</b>
                            @if ($productdetail->status == 0)
                                New
                            @elseif($productdetail->status == 1)
                                {{ $productdetail->sale_price }} %
                            @endif
                        </p>

                        <p><b>Brand:</b> {{ $productdetail->brand }}</p>
                        <a><img src="/frontend/images/product-details/share.png" class="share img-responsive"
                                alt="" /></a>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->

            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li><a href="/frontend/#details" data-toggle="tab">Details</a></li>
                        <li><a href="/frontend/#companyprofile" data-toggle="tab">Company Profile</a></li>
                        <li><a href="/frontend/#tag" data-toggle="tab">Tag</a></li>
                        <li class="active"><a href="/frontend/#reviews" data-toggle="tab">Reviews (5)</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="details">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="companyprofile">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tag">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/frontend/images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade active in" id="reviews">
                        <div class="col-sm-12">
                            <ul>
                                @php
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                @endphp

                                <li><a><i class="fa fa-user"></i>{{ Auth::user() ? Auth::user()->name : 'Khách' }}</a></li>
                                <li><a><i class="fa fa-clock-o"></i>{{ date('H:i:s') }}</a></li>
                                <li><a><i class="fa fa-calendar-o"></i>{{ date('d M Y', strtotime(now())) }}</a></li>

                            </ul>
                            <p><b>Viết Đánh Giá sản phẩm</b></p>

                            <form action="#">
                                <span>
                                    <input type="text" placeholder="Your Name"
                                        value="{{ Auth::user() ? Auth::user()->name : ' ' }}" />
                                    <input type="email" placeholder="Email Address"
                                        value="{{ Auth::user() ? Auth::user()->email : ' ' }}" />
                                </span>
                                <textarea name=""></textarea>
                                <b>Rating: </b>
                                <div class="rate">
                                    <div class="vote">
                                        <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                        <span class="rate-np"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default pull-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->

            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">recommended items</h2>

                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend1.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend2.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/frontend/images/home/recommend3.jpg" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left recommended-item-control" href="/frontend/#recommended-item-carousel"
                        data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="/frontend/#recommended-item-carousel"
                        data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div><!--/recommended_items-->
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#similar-product img").click(function() {
                var image = $(this).attr("src");
                $(".view-product img").attr("src", image);
                $(".view-product a").attr("href", image);
            });
            $("#add-to-cart").click(function(e) {
                e.preventDefault();
                var checkLogin = "{{ Auth::Check() }}";
                if (checkLogin) {
                    var product_id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: '{{ url(route('add.to.cart')) }}',
                        data: {
                            product_id: product_id,
                        },
                        success: function(res) {
                            $('#totalcart').text(res.totalqty);
                        }
                    });
                } else {
                    alert("Vui lòng đăng nhập để Add to cart.");
                }
            });

            // Cập nhật lại số sao
            // function updateStars(averageRate) {
            //     var fullStars = Math.round(averageRate);
            //     var hasHalfStar = averageRate % 1 !== 0;

            //     $('.rate-np').text(averageRate.toFixed(1));
            //     $('.ratings_stars').removeClass('ratings_over').removeClass('ratings_half');

            //     for (var i = 1; i <= fullStars; i++) {
            //         $('.star_' + i).addClass('ratings_over');
            //     }

            //     if (hasHalfStar) {
            //         $('.star_' + (fullStars + 1)).addClass('ratings_half');
            //     }
            // }


            // Hover cho ngôi sao
            $('.ratings_stars').hover(
                function() {
                    $(this).prevAll().addBack().addClass('ratings_hover');
                },
                function() {
                    $(this).prevAll().addBack().removeClass('ratings_hover');
                }
            );
            $('.ratings_stars').click(function(e) {
                var rate = $(this).find("input").val();

                console.log(rate);
            })

        });


        $(".view-product a").prettyPhoto();
    </script>
@endsection
