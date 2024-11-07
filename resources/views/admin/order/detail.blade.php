@section('ctitle', 'orderInfo')

@extends('layouts.aplayout')


@section('content')
    <div class=" col-12 ">
        <div class="col-12 row">
            <a href="{{ route('admin#order.list', 0) }}"class="btn btn-white bg-white shadow-sm py-2 col-1"> <i
                    class="fa-solid fa-angles-left"></i></a>
        </div>
        <div class="px-3 pb-3 pt-2 mt-2 col-12 ">
            <div class="bg-white border rounded shadow-sm row p-2">

                <div class=" fs-6 col-9">
                    <b><em>Order_id - {{ $orderdetail->order_code }}</em></b>
                    <input type="hidden" name="" class="order-status" value="{{ $orderdetail->status }}">
                </div>

                @if ($orderdetail->status == '0')
                    <div class=" col-3 d-flex justify-content-between ">
                        <input type="hidden" name="" class="order-code" value="{{ $orderdetail->order_code }}">
                        <button class="status-change btn btn-sm btn-danger" value="2">reject</button>
                        <button class="status-change btn btn-sm btn-primary" value="1">accept</button>
                    </div>
                @elseif ($orderdetail->status == '1')
                    <div class="bg-success rounded col-3 text-center text-white py-1">
                        <small>already accepted <i class="fa-solid fa-check"></i></small>
                    </div>
                @elseif ($orderdetail->status == '2')
                    <div class="bg-danger rounded col-3 text-center text-white py-1">
                        <small>already rejected <i class="fa-solid fa-xmark"></i></small>
                    </div>
                @endif

                <div>
                    <small>user name - {{ $orderdetail->name }}</small><br>
                    <small>address - {{ $orderdetail->address }}</small><br>
                    <small>phone - {{ $orderdetail->phone }}</small><br>
                </div>
            </div>

            <hr>

            <table class="table table-sm text">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($orderList as $item)
                        <tr>
                            <td>

                                {{ $item->product_name }}

                            </td>
                            <td>

                                {{ $item->price }}

                            </td>
                            <td>

                                {{ $item->qty }}

                            </td>
                            <td>

                                {{ $item->total }}

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                <div class="col-4  px-4">
                    <div>
                        <small><b>Total amount</b></small>
                        <input id="totalamount" class="form-control  font-monospace fs-5" type="text"
                            value="{{ $orderdetail->total_price }}" readonly>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('childScript')
    <script type="text/javascript">
        $(document).ready(
            function() {
                $ordercode = $('.order-code').val();
                $('.status-change').click(
                    function() {
                        $status = $(this).val();
                        $.ajax({
                            type: 'get',
                            url: 'http://localhost:8000/ajax/order/status/change',
                            data: {
                                'status': $status,
                                'order_code': $ordercode
                            },
                            dataType: 'json',
                            success: function(response) {
                                location.reload();
                            }
                        })
                    }
                )
            }
        )
    </script>
@endsection
