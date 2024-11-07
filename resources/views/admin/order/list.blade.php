@section('ctitle', 'orderList')

@extends('layouts.aplayout')


@section('content')
    <div class="">
        <div class="row mb-1">
            {{-- header --}}
            <h4 class="text-secondary col-8 px-5 ">Order List</h4>
            <div class="col-4  ">
                <input type="hidden" name="status" class="status" value="{{ $status }}">
                <div class="btn-group btn-group-sm border shadow-sm">
                    <a class="btn " id="0" href="{{ route('admin#order.list', 0) }}">pending</a>
                    <a class="btn" id="1" href="{{ route('admin#order.list', 1) }}">accept</a>
                    <a class="btn" id="2" href="{{ route('admin#order.list', 2) }}">reject</a>
                </div>
            </div>
        </div>

        <div class="bg-white px-3 pb-3 pt-2 mt-2 col-12">
            @if (count($orderList) == 0)
                <hr>
                <div class="text-center text-secondary py-5">

                    <h5>there is no products</h5>

                </div>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Order_code</th>
                            <th scope="col">Total price</th>
                            <th scope="col"></th>
                            <th scope="col">Status</th>
                            <th scope="col">Order_at</th>
                        </tr>
                    </thead>
                    <tbody class="">

                        @foreach ($orderList as $item)
                            <tr>
                                <td scope="row" class="">
                                    <small>{{ $item->order_code }}</small>
                                </td>
                                <td>
                                    <small>{{ $item->total_price }}</small>
                                </td>
                                <td>
                                    <small>
                                        <a href="{{ route('admin#order.list.detail', $item->id) }}">see detail...</a>
                                    </small>

                                </td>
                                <td>

                                    @if ($item->status == '0')
                                        <small class=" text-secondary align-middle"> <i class="fa-regular fa-clock"></i>
                                            pending</small>
                                    @elseif ($item->status == '1')
                                        <small class=" text-success"><i class="fa-solid fa-check"></i>success</small>
                                    @elseif ($item->status == '2')
                                        <small class=" text-danger"><i class="fa-solid fa-circle-exclamation"></i>
                                            reject</small>
                                    @endif
                                </td>
                                <td>
                                    <small>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </small>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @endif

            <div class="d-flex justify-content-end">
                <span>
                    {{ $orderList->links() }}
                </span>

            </div>

        </div>

    </div>
@endsection
@section('childScript')
    <script type="text/javascript">
        $(document).ready(
            function() {
                $status = $('.status').val();
                console.log($status);
                if ($status == '0') {
                    $('#0').addClass('border border-top-0 border-start-0 border-end-0 border-info border-3');
                } else if ($status == '1') {
                    $('#1').addClass('border border-top-0 border-start-0 border-end-0 border-info border-3');
                } else if ($status == '2') {
                    $('#2').addClass('border border-top-0 border-start-0 border-end-0 border-info border-3');
                }
            }
        )
    </script>
@endsection
