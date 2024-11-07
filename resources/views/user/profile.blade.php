@section('ctitle', 'profile')

@extends('layouts.urlayout')

@section('content')
    <div class=" col-5 mt-4 mb-4 py-4 px-2 border rounded bg-white shadow-sm">
        <div class="text-center text-secondary ">
            <h6><em>profile infomation</em></h6>
            <hr>
        </div>
        <div class="col-4 offset-4">

            <div class="ratio ratio-1x1 ">
                @if (Auth::user()->image == null )
                    <img src="{{url(asset('default.png'))}}" alt="" class="border rounded-circle object-fit-cover">
                @else
                    <img src="{{url(asset('storage/'.Auth::user()->image))}}" alt="" class="border rounded-circle object-fit-cover">
                @endif
            </div>


        </div>
        <div class="col-10 offset-1  mt-4" >
            <div class="text-end">
                <a href="{{url(route('user#profile.edit'))}}" class=" btn btn-warning border "> <i class="fa-solid fa-pen-to-square"></i></a>
            </div>

            <div class="my-1">
               <small>name</small>
               <hr class="m-0">
               <input type="text"  class="border border-0 bg-white form-control px-3 " style="font-style: italic" value="{{auth::user()->name}}" disabled>
            </div>
            <div class="my-1">
                <small>email</small>
                <hr class="m-0">
                <input type="text"  class="border border-0 bg-white form-control px-3 " style="font-style: italic" value="{{auth::user()->email}}" disabled>
             </div>
             <div class="my-1">
                <small>phone</small>
                <hr class="m-0">
                <input type="text"  class="border border-0 bg-white form-control px-3 " style="font-style: italic" value="{{auth::user()->phone}}" disabled>
             </div>
             <div class="my-1">
                <small>address</small>
                <hr class="m-0">
                <input type="text"  class="border border-0 bg-white form-control px-3 " style="font-style: italic" value="{{auth::user()->address}}" disabled>
             </div>
             <div class=" mt-2 text-center ">
                <a href="{{url(route('user#password.changePage'))}}" class="btn btn-white btn-sm rounded-pill px-4 text-capitalize py-2   shadow-sm border "><i class="fa-solid fa-key"></i> change password</a>

            </div>
        </div>

        <div class="text-center pt-5">
            <p><small><em>{{auth::user()->name}} joined at {{auth::user()->created_at}}</em></small></p>
        </div>
    </div>
@endsection
