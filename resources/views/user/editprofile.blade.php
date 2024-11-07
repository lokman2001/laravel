@section('ctitle', 'profileEdit')


@extends('layouts.urlayout')

@section('content')
    <div class=" col-5 mt-4 mb-4 py-4 px-5 border rounded bg-white shadow-sm">
        <div class="text-center text-secondary ">
            <h6><em>profile infomation</em></h6>
            <hr>
        </div>
        <form action="{{url(route('user#profile.update'))}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-4 offset-4">

                <div class="ratio ratio-1x1 ">
                    @if (Auth::user()->image == null )
                        <img src="{{url(asset('default.png'))}}" alt="" class="border rounded-circle">
                    @else
                        <img src="{{url(asset('storage/'.Auth::user()->image))}}" alt="" class="border rounded-circle object-fit-cover">
                    @endif
                </div>
                <input type="file" class="form-control mt-2" name="img" id="" >
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 offset-3 mt-4" >
                <input type="text" name="id" id="" value="{{Auth::user()->id}}" hidden>
                <div class="my-1">
                    <small>name</small>
                    <hr class="m-0">
                    <input type="text"  name='name' class="border border-0 bg-white form-control px-3  @error('name') is-invalid @enderror" style="font-style: italic" value="{{Auth::user()->name}}" >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-1">
                    <small>email</small>
                    <hr class="m-0">
                    <input type="text" id="input" name='email' class="border border-0 bg-white form-control px-3  @error('email') is-invalid @enderror" style="font-style: italic" value="{{Auth::user()->email}}" >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-1">
                    <small>phone</small>
                    <hr class="m-0">
                    <input type="text" id="input" name='phone' class="border border-0 bg-white form-control px-3  @error('phone') is-invalid @enderror" style="font-style: italic" value="{{Auth::user()->phone}}" >
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="my-1">
                    <small>address</small>
                    <hr class="m-0">
                    <input type="text" id="input" name='address' class="border border-0 bg-white form-control px-3 @error('address') is-invalid @enderror" style="font-style: italic" value="{{Auth::user()->address}}" >
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class=" mt-3 d-flex justify-content-between ">
                    <a href="{{route('user#profile')}}" class="btn btn-danger  shadow-sm   "><i class="fa-solid fa-close"> </i> cancel </a>
                    <button id="edit" class="btn btn-primary  shadow-sm   "><i class="fa-solid fa-cloud-arrow-up"> </i> save </button>
                </div>
            </div>
        </form>

    </div>
@endsection
