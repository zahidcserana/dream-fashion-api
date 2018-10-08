@extends('front.layout.cart')
@section('header_js')
    @parent

@endsection
@section('front_content')

    <!--================Shopping Cart Area =================-->
    <section class="shopping_cart_area p_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart_items">
                        <h3>Your Cart Items</h3>
                        <div class="table-responsive-md">
                            <table class="table">
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <th scope="row">
                                            <img src="img/icon/close-icon.png" alt="">
                                        </th>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{asset('image/products/'.$item->image)}}" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{$item->product->name}}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td><p class="red">${{$item->unit_price}}</p></td>
                                        <td>
                                            <div class="quantity">
                                                <h6>Quantity</h6>
                                                <div class="custom">
                                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                                            class="reduced items-count" type="button"><i
                                                                class="icon_minus-06"></i></button>
                                                    <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                                           title="Quantity:" class="input-text qty">
                                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                                            class="increase items-count" type="button"><i
                                                                class="icon_plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td><p>$150</p></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row">
                                    </th>
                                </tr>
                                <tr class="last">
                                    <th scope="row">
                                        <img src="img/icon/cart-icon.png" alt="">
                                    </th>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <h5>Cupon code</h5>
                                            </div>
                                            <div class="media-body">
                                                <input type="text" placeholder="Apply cuopon">
                                            </div>
                                        </div>
                                    </td>
                                    <td><p class="red"></p></td>
                                    <td>
                                        <h3>update cart</h3>
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart_totals_area">
                        <h4>Cart Totals</h4>
                        <div class="cart_t_list">
                            <div class="media">
                                <div class="d-flex">
                                    <h5>Subtotal</h5>
                                </div>
                                <div class="media-body">
                                    <h6>$14</h6>
                                </div>
                            </div>
                            <div class="media">
                                <div class="d-flex">
                                    <h5>Shipping</h5>
                                </div>
                                <div class="media-body">
                                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                        their default model tex</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="d-flex">

                                </div>
                                <div class="media-body">
                                    <select class="selectpicker">
                                        <option>Calculate Shipping</option>
                                        <option>Calculate Shipping</option>
                                        <option>Calculate Shipping</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="total_amount row m0 row_disable">
                            <div class="float-left">
                                Total
                            </div>
                            <div class="float-right">
                                $400
                            </div>
                        </div>
                    </div>
                    <button type="submit" value="submit" class="btn subs_btn form-control">Proceed to checkout</button>
                </div>
            </div>
        </div>
    </section>
    <!--================End Shopping Cart Area =================-->

@endsection