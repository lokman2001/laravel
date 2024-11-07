@section('ctitle', 'orderList')

@extends('layouts.urlayout')

@section('content')
<div class=" p-2 col-8 ">
    <div class="col-12 row">
        <a href="{{route('user#dashboard')}}"class="btn btn-white bg-white shadow-sm py-2 col-1"> <i class="fa-solid fa-angles-left"></i></a>
    </div>
    <div class="bg-white rounded shadow-sm px-3 pb-3 pt-2 mt-2 col-12">
        <h5 class="ps-4"><em>Order list</em></h5>
        <hr>
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
              @foreach ($orderList as $item )
                    <tr>
                        <th scope="row">
                            {{$item->order_code}}
                        </th>
                        <td>
                            {{$item->total_price}}
                        </td>
                        <td >
                            <a href="{{route('user#order.detail',$item->id)}}">see detail...</a>
                        </td>
                        <td>
                            @if ($item->status == "0")
                                <p class=" text-secondary align-middle"> <i class="fa-regular fa-clock"></i> pending</p>
                            @elseif ($item->status == "1")
                                <p class=" text-success"><i class="fa-solid fa-check"></i>success</p>
                            @elseif ($item->status == "2")
                                <p class=" text-danger"><i class="fa-solid fa-circle-exclamation"></i> fail</p>
                            @endif
                        </td>
                        <td >
                            {{$item->created_at->format('d/M/y')}}
                        </td>
                    </tr>
              @endforeach

            </tbody>
          </table>

          <div>
            {{ $orderList->links() }}
          </div>

    </div>
</div>
@endsection
@section('childScript')

@endsection

