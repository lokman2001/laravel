@section('ctitle', 'changePassword')


@extends('layouts.master')

@section('auth')


<div class="container py-5">
    <div class="card col-6 p-3 shadow offset-3">
        <form class="" method="POST" action="{{ route ('admin#password.change')}}">
            @csrf
            <div class="">
                <h2 class="text-dark text-center m-3 pb-4 ">Riza Pizza</h2>
            </div>


                <div class="col-12 my-3">
                    <input type="password" class="form-control p-2 @error ('currentPassword') is-invalid @enderror @session ('error') is-invalid @endsession " id="inputEmail" placeholder="Current password" name='currentPassword'>
                    @error('currentPassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @session('error')
                        <small class="text-danger">{{ session('error') }}</small>
                    @endsession
                </div>


                <div class="col-12 my-3">
                    <input type="password" class="form-control p-2 @error ('newPassword') is-invalid @enderror" id="inputPassword" placeholder="New password" name='newPassword'>
                    @error('newPassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="col-12 my-3">
                    <input type="password" class="form-control p-2 @error ('comfirmPassword') is invalid @enderror" id="inputPassword" placeholder="Comfirm password" name='comfirmPassword'>
                    @error('comfirmPassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


            <div class="d-flex justify-content-end m-2">
                <a href="{{route('admin#profile')}}" class="btn btn-danger me-2 rounded-pill" type="submit">
                    cancel
                </a>
                <button type="submit" class="btn btn-primary px-3 rounded-pill"> Change your new password <i class="fa-solid fa-angles-right"></i></button>
            </div>

          </form>
    </div>
</div>

@endsection
