@section('ctitle', 'changePassword')

@extends('layouts.urlayout')

@section('content')

    <div class=" col-5 mt-4 mb-4 py-4 px-5 border rounded bg-white shadow-sm">
        <div class=" text-secondary ">
            <h6 class="col-10 "><em> <i class="fa-solid fa-key"></i> re-new user password</em></h6>
            <hr>
        </div>
        <form action="{{url(route('user#password.change'))}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-8 offset-2">
                <small class="">current password</small>
                <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword">
                @error('currentPassword')
                    <small class="text-danger">{{$message}}</small>
                @enderror


                <br>

                <small class="">new password</small>
                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword">
                @error('newPassword')
                    <small class="text-danger">{{$message}}</small>
                @enderror


                <br>

                <small class="">confirm password</small>
                <input type="password" class="form-control @error('comfirmPassword') is-invalid @enderror" name="comfirmPassword">
                @error('comfirmPassword')
                    <small class="text-danger">{{$message}}</small>
                @enderror

            </div>
            <div class="text-end mt-3 mb-2 col-8 offset-2">

                <a href="{{url(route('user#profile'))}}" class="btn me-1 text-danger border-danger">cancel</a>
                <button type='submit' class="btn btn-outline-secondary "><i class="fa-solid fa-cloud-arrow-up"></i> update</button>

            </div>



        </form>

    </div>
@endsection
