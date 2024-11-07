@section('ctitle', 'cartList')

@extends('layouts.urlayout')

@section('content')
    <div class="  col-8 ">
        <div class="col-12 row">
            <a href="{{ route('user#dashboard') }}"class="btn btn-white bg-white shadow-sm py-2 col-1"> <i
                    class="fa-solid fa-angles-left"></i></a>
        </div>
        <div class="bg-white rounded shadow-sm px-3 pb-3 pt-2 mt-2 col-12">
            <h5 class="ps-4"><em>cart list</em></h5>
            <hr>
            @if (count($cartlist) == 0)
                <h5 class="my-5 text-center">nothing in your cartlist</h5>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">- <i class="fa-solid fa-image"></i> -</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($cartlist as $item)
                            <tr>
                                <th scope="row">
                                    <div class="ratio ratio-1x1 p-0">
                                        <img src="{{ url(asset('storage/' . $item->image)) }}" alt=""
                                            class="object-fit-cover">
                                    </div>
                                </th>
                                <td>
                                    <input type="hidden" class="user_id" value="{{ $item->user_id }}">
                                    <input type="hidden" class="product_id" value="{{ $item->product_id }}">
                                    {{ $item->name }}
                                </td>
                                <td id="price">
                                    {{ $item->price }}
                                </td>
                                <td>
                                    <div class="row">
                                        <button class="button col-1 btn btn-outline-warning p-0" type="button"
                                            id="" value="minus"><i class="fa-solid fa-minus"></i></button>

                                        <input type="text" name="" id=""
                                            class="qty col-2 border border-warning rounded text-center"
                                            value="{{ $item->qty }}" readonly>

                                        <button class="button col-1 btn btn-outline-warning p-0" type="button"
                                            id="" value="plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>

                                </td>
                                <td id="">
                                    <input type="text" class="totalprice form-control border-0 font-monospace"
                                        value="{{ $item->price * $item->qty }}" readonly>
                                </td>
                                <td>
                                    <button class="close btn text-danger"> <i class="fa-regular fa-circle-xmark"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    <div class="col-4 px-2">
                        <small><b>Total amount</b></small>
                        <input id="totalamount" class="form-control  font-monospace fs-4" type="text"
                            value="{{ $totalamount }}" readonly>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-around">
                        <button id="order" class="btn btn-warning btn-sm ">Order</button>
                        <button id="clear-cart" class="btn btn-danger btn-sm ">clear cart</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('childScript')
    <script type="text/javascript">
        $(document).ready(
            function() {
                //  qty click function
                $('.button').click(
                    function() {

                        $parent1 = $(this).parents('tr');
                        $parent2 = $(this).parent();
                        $button = $(this).val();
                        $price = $parent1.find('#price').html() * 1;
                        $qty = $parent2.find('input').val() * 1;

                        // check value
                        if ($button == 'plus') {

                            $Nqty = $qty + 1
                            $total = $price * $Nqty;
                            $parent2.find('input').val($Nqty);
                            $parent1.find('.totalprice').val($total);


                        } else if ($button == 'minus') {

                            $Nqty = $qty - 1

                            if ($Nqty <= 1) {
                                $Nqty = 1
                            }

                            $total = $price * $Nqty;
                            $parent2.find('input').val($Nqty);
                            $parent1.find('.totalprice').val($total);
                        }
                        totalamount()

                    }
                )
                $('.close').click(function() {
                    $(this).parents('tr').remove();
                    totalamount()
                })
                //calculate total amount
                function totalamount() {
                    $totalamount = 0
                    $('.totalprice').each(
                        function() {
                            $totalamount += Number($(this).val());
                        }
                    )
                    $('#totalamount').val($totalamount);
                }

                $('#order').click(function() {
                    $random1 = Math.floor(Math.random() * 1000000001);
                    $random2 = Math.floor(Math.random() * 10001);
                    $ordercoder = $random2 + 'RPPOS' + $random1;
                    $cartlist = [];

                    $('.tbody tr').each(function(index, row) {

                        data = {
                            'user_id': $(row).find('.user_id').val(),
                            'product_id': $(row).find('.product_id').val(),
                            'qty': $(row).find('.qty').val(),
                            'total': $(row).find('.totalprice').val(),
                            'order_code': $ordercoder,
                        }
                        $cartlist.push(data);


                    })
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost:8000/ajax/orderlist',
                        data: Object.assign({}, $cartlist),
                        dataType: 'json',
                        success: function(response) {
                            window.history.back();
                            location.reload();


                        }
                    })

                })

                $('#clear-cart').click(function() {
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost:8000/ajax/cartlist/clear',
                        dataType: 'json',
                        success: function(response) {
                            location.reload();

                        }
                    })
                })


            }
        )
    </script>
@endsection
