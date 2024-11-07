@section('ctitle', 'personal-infomation')

@extends('layouts.aplayout')

@section('content')
    <div class="p-3 row">
        <div class="col-1 pe-2">
            @if ($data->role == 'admin')
                <a href="{{ route('admin#admin.list') }}" class=" btn text-danger shadow"><i
                        class="fa-solid fa-angles-left"></i></a>
            @else
                <a href="{{ route('admin#admin.addAdmin') }}" class=" btn text-danger shadow"><i
                        class="fa-solid fa-angles-left"></i></a>
            @endif

        </div>
        <div class="text-center">
            <h5 class="text-secondary">Profile info</h5>
        </div>

        <div class="col-4 pb">

            <div class="ratio ratio-1x1 mt-4">
                @if ($data->image == NULL )
                    <img src="{{ url(asset('default.png')) }}" alt=""
                        class="border  object-fit-cover">
                @else
                    <img src="{{ url(asset('storage/' . $data->image)) }}" alt=""
                        class="border  object-fit-cover">
                @endif
            </div>

        </div>
        <div class="col-8">

            <div class="row m-2 ">
                <span for="name" class="col-4 text-align-center"> username </span>
                <div class="col-8 ">
                    <input name="name" class=" form-control  bg-white" type="text" value="{{ $data->name }}"
                        readonly>
                </div>

            </div>


            <div class="row m-2 ">
                <label for="email" class="col-4"> email </label>
                <div class="col-8 ">
                    <input name="email" class=" form-control  bg-white" type="text" value="{{ $data->email }}"
                        readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="phone" class="col-4"> phone </label>
                <div class="col-8 ">
                    <input name="phone" class="form-control bg-white" type="text" value="{{ $data->phone }}" readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="role" class="col-4"> role </label>
                <div class="col-8 ">
                    <input name="role" class="form-control bg-white" type="text" value="{{ $data->role }}" readonly>
                </div>

            </div>

            <div class="row m-2 ">
                <label for="address" class="col-4"> address </label>
                <div class="col-8 ">
                    <textarea name="address" class="form-control bg-white" type="text" value="" readonly>{{ $data->address }}</textarea>
                </div>

            </div>

        </div>



    </div>
@endsection
