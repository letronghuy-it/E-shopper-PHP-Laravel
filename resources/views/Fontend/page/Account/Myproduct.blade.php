@extends('Fontend.share.masterFE')
@section('content')
    @include('Fontend.share.menuAccount')
    <div class="col-sm-9">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td  class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($myproduct as $key => $value)
                        <tr>
                            <td class="cart_product">
                                @php
                                    $image = json_decode($value->image_product);
                                @endphp
                                @if(!empty($image))
                                    <a href=""><img width="100px" height="100px"
                                            src="{{ '/upload/user/' . $value->id_user . '/image_product/' . $image[0] }}"
                                            alt=""></a>
                                @endif
                            </td>

                            <td class="cart_description">
                                <h4><a href="">{{ Str::substr($value->name, 0, 15) }}</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price" style="white-space: nowrap;">
                                <p>{{ format_number($value->price) }}</p>
                            </td>
                            <td class="cart_quantity" >
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total" style="white-space: nowrap;">
                                <p class="cart_total_price">{{ format_number($value->price) }}</p>
                            </td>
                            <td class="cart_delete" style="white-space: nowrap;">
                                <a class="cart_quantity_delete" href="/shop/account/delete-product/{{$value->id}}"><i class="fa fa-times"></i></a>
                                <a class="cart_quantity_edit" href="/shop/account/edit-product/{{$value->id}}"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@php
    function format_number($number) {
    if ($number >= 1000000000) {
        return number_format($number / 1000000000, 1) . 'B';
    }
    else if ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'M';
    }
    else if ($number >= 1000) {
        return number_format($number / 1000, 1) . 'K';
    }
    return $number;
}

@endphp

