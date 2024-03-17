<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($category as $key => $value)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="color: gray;">
                            <a class="sportswear" data-idcategory={{ $value->id }}
                                data-toggle="collapse" data-parent="#accordian" href="#sportswear"
                                style="color: inherit;">
                                {{ $value->category }}
                            </a>
                        </h4>
                    </div>
                    {{-- <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Nike </a></li>
                            <li><a href="#">Under Armour </a></li>
                            <li><a href="#">Adidas </a></li>
                            <li><a href="#">Puma</a></li>
                            <li><a href="#">ASICS </a></li>
                        </ul>
                    </div>
                </div> --}}
                </div>
            @endforeach

        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($brand as $key => $value)
                        <li><a style="cursor: pointer;" data-idbrand={{$value->id}}> <span
                                    class="pull-right">(1)</span>{{ $value->brand }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0"
                    data-slider-max="10000" data-slider-step="5" data-slider-value="[250,450]"
                    id="sl2"><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <img src="/frontend/images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->

    </div>
</div>
