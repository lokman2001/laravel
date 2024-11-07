@section('ctitle', 'profileEdit')


@extends('layouts.aplayout')

@section('content')
<div class="">
    <form action="{{ route('admin#profile.update')}}" method="post" class="p-3 row" enctype="multipart/form-data">
    @csrf
    <h2 class="text-secondary pb-2 ">Profile info</h2>
    <div class="col-6">
    @if (Auth::user()->image == null )

        <img src={{url(asset('default.png') )}} alt="" class="card card img" width="100%" height="100%" >

    @else
        <div class="ratio ratio-1x1">
            <img src='{{ url (asset('storage/'.Auth::user()->image))}}' alt="" class=" object-fit-scale  border"  >
        </div>
    @endif
        <div class="my-2 ">
            <input type="file" name="img" id="" class="form-control" ></button>
        </div>

    </div>

    <div class="col-6">

        <input name="id" class=" form-control  bg-white" type="text" value="{{ Auth::user()->id }}" hidden>


        <div class="row m-2 ">
            <label for="name" class="col-4"> username </label>
            <div class="col-8 ">
                <input name="name" class=" form-control  bg-white" type="text" value="{{ Auth::user()->name }}" >
            </div>

        </div>


        <div class="row m-2 ">
            <label for="email" class="col-4"> email </label>
            <div class="col-8 ">
                <input name="email" class=" form-control  bg-white" type="text" value="{{ Auth::user()->email }}" >
            </div>

        </div>

        <div class="row m-2 ">
        <label for="phone" class="col-4" > phone </label>
            <div class="col-8 ">
                <input name="phone" class="form-control bg-white" type="text" value="{{ Auth::user()->phone }}"  >
            </div>

        </div>

        <div class="row m-2 ">
        <label for="role" class="col-4"> role </label>
            <div class="col-8 ">
                <input name="role" class="form-control bg-white" type="text" value="{{ Auth::user()->role }}"  disabled>
            </div>

        </div>

        <div class="row m-2 ">
        <label for="address" class="col-4"> address </label>
            <div class="col-8 ">
                <textarea name="address" class="form-control bg-white" rows="3" >{{ Auth::user()->address }}</textarea>
            </div>

        </div>

        <div class="d-flex flex-row-reverse">
            <button class="btn btn-success m-3 rounded-pill" type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
            </button>
            <a href="{{route('admin#profile')}}" class="btn btn-danger m-3 rounded-pill" type="submit">
                <i class="fa-regular fa-close"></i>
            </a>

        </div>



    </div>
    </form>


</div>
@endsection
