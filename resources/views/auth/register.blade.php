@section('title', 'register')

@extends('layouts.master')

@section('auth')
    <div class="container py-4">
        <div class="card col-6 px-4 shadow-sm offset-3">
            <form class="" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="col-4 offset-4 ">
                    <div class="ratio ratio-21x9 ">
                        <img src="{{ url(asset('icon/logo/logo1.png')) }}" alt="">
                    </div>
                </div>
                <div class="ms-2 mb-2 text-secondary">
                    <h5><em>Registration</em></h5>
                </div>



                <div class="col-12 mb-2 form-floating">
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="" name='name'>
                    <label for="name">Name</label>
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="email" class="form-control p-2 @error('email') is-invalid @enderror" id="email"
                        placeholder="" name='email'>
                    <label for="email">Email</label>
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="phone" class="form-control p-2 @error('phone') is-invalid @enderror" id="phone"
                        placeholder="" name='phone'>
                    <label for="phone">Phone</label>
                </div>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="address" class="form-control p-2 @error('address') is-invalid @enderror" id="address"
                        placeholder="" name='address'>
                    <label for="address">Address</label>
                </div>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="password" class="form-control p-2 @error('password') is-invalid @enderror" id="password"
                        placeholder="" name='password'>
                    <label for="password">Password</label>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="password" class="form-control p-2 @error('comfirm_password') is-invalid @enderror"
                        id="confirm_password" placeholder="" name='confirm_password'>
                    <label for="confirm_password">Confirm_password</label>
                </div>
                @error('comfirm_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-sm btn-primary px-5"> <i class="fa-regular fa-address-card"></i>  Register</button>
                </div>

                <a href='{{ route('auth#login') }}' class="d-flex justify-content-center m-2">already have account?</a>
            </form>
        </div>
    </div>
@endsection
