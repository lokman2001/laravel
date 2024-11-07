@section('ctitle', 'profile')

@extends('layouts.aplayout')

@section('content')
    <div class="p-3 row">

        <h5 class="text-secondary  ">Profile info</h5>
        <div class="col-4 pb ">
            @if (Auth::user()->image == null)
                <div class="ratio ratio-1x1 mt-4">
                    <img src={{ url(asset('default.png')) }} alt="" class=" border object-fit-cover">
                </div>
            @else
                <div class="ratio ratio-1x1 mt-4">
                    <img src='{{ url(asset('storage/' . Auth::user()->image)) }}' alt=""
                        class=" border object-fit-cover">
                </div>
            @endif


        </div>
        <div class="col-8">

            <div class="row m-2 ">
                <span for="name" class="col-4 text-align-center"> username </span>
                <div class="col-8 ">
                    <input name="name" class=" form-control  bg-white" type="text" value="{{ Auth::user()->name }}"
                        readonly>
                </div>

            </div>


            <div class="row m-2 ">
                <label for="email" class="col-4"> email </label>
                <div class="col-8 ">
                    <input name="email" class=" form-control  bg-white" type="text" value="{{ Auth::user()->email }}"
                        readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="phone" class="col-4"> phone </label>
                <div class="col-8 ">
                    <input name="phone" class="form-control bg-white" type="text" value="{{ Auth::user()->phone }}"
                        readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="role" class="col-4"> role </label>
                <div class="col-8 ">
                    <input name="role" class="form-control bg-white" type="text" value="{{ Auth::user()->role }}"
                        readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="address" class="col-4"> address </label>
                <div class="col-8 ">
                    <textarea name="address" class="form-control bg-white" type="text" value="" readonly>{{ Auth::user()->address }}</textarea>
                </div>

            </div>

        </div>
        <div class=" p-2 row ">

            <a class=" col-1 ms-3 btn btn-primary rounded shadow-sm" href="{{ route('admin#profile.edit') }}"><i
                    class="fa-solid fa-pen-nib"></i></a>
            <a class=" col-3 offset-6  btn rounded-pill shadow" href="{{ route('admin#password.changePage') }}">change password</a>

        </div>



    </div>
@endsection
