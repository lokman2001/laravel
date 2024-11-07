@extends('layouts.master')

@section('title')
    @yield('ctitle')
@endsection

@section('aplayout')

<div class=" container-fluid d-flex justify-content-center py-5 p-2 ">

    <div class="w-75 px-5 pt-2 shadow rounded pb-2 ">

        <div class="col-12 px-5 py-1 font-monospace text-center">
            <!-- //name and logo  -->
            <h5 class="">Riza Pizza Order System</h5>
            <h6 class="badge bg-dark">Admin panel </h6>

        </div>
        <hr>

        {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="row pb-2">

            <div class="col-9 offset-1">
                {{-- display content --}}
                @yield('content')

            </div>
            <div class="col-1 ">

                <div class="w-100 border rounded bg-white shadow  mb-2">
                    <a class=" text-dark link-underline link-underline-opacity-0 " href="{{route('admin#profile')}}">
                        <div class="p-2">
                            @if (Auth::user()->image == null )
                                <div class="ratio ratio-1x1">
                                    <img src={{url(asset('default.png') )}} alt="" class="rounded-circle border object-fit-cover"  >
                                </div>
                            @else
                                <div class="ratio ratio-1x1 ">
                                    <img src='{{ url (asset('storage/'.Auth::user()->image))}}' alt="" class="rounded-circle border object-fit-cover"  >
                                </div>
                            @endif

                        </div>
                    </a>
                </div>

                <div class="w-100 border border rounded bg-white shadow p-1">

                    <a href="{{ route('admin#dashboard')}}" class="btn">
                            <i class="fa-solid fa-house"></i>
                    </a>

                    <a href="{{ route('admin#admin.list')}}" class="btn">
                            <i class="fa-solid fa-users"></i>
                    </a>

                    <a href="{{route('admin#category.list')}}" class="btn">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </a>

                    <a href="{{route('admin#product.list')}}"" class="btn">
                            <i class="fa-solid fa-pizza-slice"></i>
                    </a>
                    <a href="{{route('admin#order.list', 0)}}" class="btn">
                            <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <a href="{{route('admin#inbox')}}" class="btn">
                        <i class="fa-solid fa-inbox"></i>
                </a>

                    <div class="w-100 ">
                        <form action="{{ route('logout')}}" method="post" class="">
                            @csrf
                            <button class="btn w-100 text-danger" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </div>


                </div>

            </div>

            {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}


    </div>

</div>

@endsection
@section('script')

 @yield('childScript')

@endsection
