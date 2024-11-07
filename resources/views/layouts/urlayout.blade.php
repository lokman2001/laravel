@extends('layouts.master')

@section('title')
    @yield('ctitle')
@endsection

@section('urlayout')
    <div class=" col-12 bg-light bg-gradient ">
        <div class="offset-1 col-10 shadow-sm sticky-top bg-white row">
            <div class="col-9 ps-4">
                <img src="{{ url(asset('icon/logo/logo1.png')) }}" alt="" srcset="" class="col-2">
            </div>
            <div class="col-3 py-2">
                <div class="col-12 border p-1 rounded-pill d-flex align-items-center  h-100">
                    <a class="col-10 text-dark d-flex align-items-center ps-1 link-underline link-underline-opacity-0" href="{{ url(route('user#profile')) }}" >
                        <div class="col-2  ">
                            <div class="ratio ratio-1x1">
                                @if (Auth::user()->image == null)
                                    <img src="{{ url(asset('default.png')) }}" alt=""
                                        class=" w-100 border rounded-circle object-fit-cover">
                                @else
                                    <img src="{{ url(asset('storage/' . Auth::user()->image)) }}" alt=""
                                        class=" w-100 border rounded-circle object-fit-cover">
                                @endif
                            </div>

                        </div>
                        <div class="col-10 text-start  ps-2">
                            <small><em>{{ Auth::user()->name }}</em></small>
                        </div>
                    </a>
                    <div class="col-2">
                        <form action="{{ url(route('logout')) }}" method="post" class="col-12">
                            @csrf
                            <button class="btn btn-danger rounded-circle w-100" type="submit"><i
                                    class="fa-solid fa-right-from-bracket"></i></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class=" d-flex justify-content-center">
            <div class="col-10 px-5 mt-1">

                <div class=" bg-white btn-sm btn-group btn-warning w-100 shadow-sm" role="group" aria-label="Basic example">
                    <a href="{{ url(route('user#dashboard')) }}" class="btn "> <i class="fa-solid fa-house"></i> Home</a>
                    <a href="{{ url(route('user#cartList')) }}" class=" btn "> <i class="fa-solid fa-cart-shopping"></i>
                        Cart list
                        <small class="badge-cart badge bg-warning text-end"></small></a>
                    <a href="{{ url(route('user#orderList')) }}" class=" btn "><i class="fa-solid fa-receipt"></i> Order
                        list </a>
                    <a href="{{ url(route('user#contact')) }}" class=" btn "><i class="fa-solid fa-envelope"></i> contact</a>


                </div>

            </div>
        </div>

        <div class="d-flex justify-content-center mt-1">
            @yield('content')
        </div>



    </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/ajax/badgeData',
                dataType: 'json',
                success: function(response) {
                    if (response['cartListBadge'] != 0) {
                        $('.badge-cart').html(response['cartListBadge']);
                    }

                }
            })
        })
    </script>
    @yield('childScript')
@endsection
