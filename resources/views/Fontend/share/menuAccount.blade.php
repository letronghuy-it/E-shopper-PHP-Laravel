<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Account</h2>
        <div class="panel-group category-products" id="accordian">
            @if (Auth::user()->level==0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{ route('Account.Member') }}">Tài Khoản</a></h4>
                </div><div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('view-update-bill')}}">Đơn Hàng</a></h4>
                </div>
            </div>
            @endif
            @if (Auth::user()->level != 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('Add.product') }}">Add product</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('My.product') }}">My product</a></h4>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
