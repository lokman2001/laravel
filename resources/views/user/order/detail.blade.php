@section('ctitle', 'orderInfo')


@extends('layouts.urlayout')

@section('content')
    <div class="  col-8 ">
        <div class="col-12 row">
            <a href="{{ route('user#orderList') }}"class="btn btn-white bg-white shadow-sm py-2 col-1"> <i
                    class="fa-solid fa-angles-left"></i></a>
        </div>
        <div class="bg-white rounded shadow-sm px-3 pb-3 pt-2 mt-2 col-12">
            <div class="ps-4 fs-6"><b><em>Order_id - {{$order->order_code}}</em></b> </div>

            <hr>

            <table class="table table-sm text-center">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-regular fa-image"></i></th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($orderList as $item)
                        <tr>
                            <th scope="row" >
                                <div class="ratio ratio-21x9 p-0">
                                    <img src="{{ url(asset('storage/' . $item->image)) }}" alt=""
                                        class="object-fit-cover">
                                </div>
                            </th>
                            <td>

                                {{ $item->name }}

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
                    <small><b>Total amount</b></small>
                    <input id="totalamount" class="form-control  font-monospace fs-5" type="text"
                        value="{{ $order->total_price }}" readonly>
                </div>
            </div>

        </div>
    </div>
@endsection
