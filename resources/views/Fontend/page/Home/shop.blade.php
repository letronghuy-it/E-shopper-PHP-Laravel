@extends('Fontend.share.masterFE')
@section('content')
    <section id="advertisement">
        <div class="container">
            <img src="/frontend/images/shop/advertisement.jpg" alt="" />
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                @include('Fontend.share.menuleft')
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        <div class="row">
                            <div class="col-12">
                                <div id="products"></div>
                            </div>
                        </div>

                        <ul class="pagination">
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">&raquo;</a></li>
                        </ul>
                    </div><!--features_items-->
                </div>
            </div>
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
            loadData();
            //ADD product to cart
            $(document).on('click', '.product-overlay .add-to-cart', function(e) {
                e.preventDefault();
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
            });
            //Search Name
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var search_name = $('#search_name').val();
                var search_price = $('#search_price').val();
                var search_category = $('#search_category').val();
                var search_brand = $('#search_brand').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ url(route('search.product')) }}',
                    data: {
                        search_name: search_name ? search_name : "",
                        search_price: search_price ? search_price : "",
                        search_category: search_category ? search_category : "",
                        search_brand: search_brand ? search_brand : ""
                    },
                    success: function(res) {
                        renderProducts(res.data);
                    }
                });
            });

            $('#sl2').on('slideStop', function(slideEvt) {
                var valueprice = slideEvt.value;
                $.ajax({
                    type: 'POST',
                    url: '{{ url(route('search.product')) }}',
                    data: {
                        key_price_slide: valueprice
                    },
                    success: function(res) {
                        renderProducts(res.data);
                    }
                });
            });

            $('.sportswear').on('click', function(e) {
                var search_category = $(this).data('idcategory');
                $.ajax({
                    type: 'POST',
                    url: '{{ url(route('search.product')) }}',
                    data: {
                        search_category: search_category
                    },
                    success: function(res) {
                        renderProducts(res.data)
                    }
                });
            })

            function renderProducts(dataproduct) {
                var html = "";
                if (dataproduct.length == 0) {
                    html = "Không có sản phẩm!";
                    $('.pagination').hide();
                } else {
                    $('.pagination').show();
                    $.each(dataproduct, function(key, value) {
                        html += `<div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img width="110px" height="110px"
                                src="/upload/user/${value.product.id_user}/image_product/${value.image}" alt="">
                            <h2>${value.product.price}</h2>
                            <p>${value.product.name}</p>
                            <button class="btn btn-default add-to-cart"
                                data-id="${value.product.id}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>${value.product.price}</h2>
                                <p>${value.product.name}</p>
                                <button class="btn btn-default add-to-cart"
                                    data-id="${value.product.id}"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="/shop/product-detail/${value.product.id}"><i
                                        class="fa fa-eye"></i>See details</a></li>
                        </ul>
                    </div>
                </div>
            </div>`;
                    });
                }
                $('#products').html(html);
            }

            function loadData(dataproduct) {
                $.ajax({
                    type: 'GET',
                    url: '{{ url(route('load.data.product')) }}',
                    success: function(res) {
                        renderProducts(res.dataproduct);
                    }
                });
            }
        })
    </script>
@endsection
