@section('title','login')

@extends('layouts.master')

@section('auth')
    <div class="container py-5">
        <div class="card col-6 px-4 shadow-sm offset-3">
            <form class="" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-4 offset-4 ">
                    <div class="ratio ratio-21x9 ">
                        <img src="{{ url(asset('icon/logo/logo1.png')) }}" alt="">
                    </div>
                </div>

                <div class="col-12 mb-2 form-floating">
                    <input type="email" class="form-control p-2 @error('email') is-invalid @enderror" id="email"
                        placeholder="" name='email'>
                    <label for="email">Email</label>
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="col-12 mb-2 form-floating">
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password"
                        placeholder="" name='password'>
                    <label for="password">Password</label>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="d-flex justify-content-end m-2">
                    <button type="submit" class="btn btn-sm btn-primary px-5">Login</button>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <small>Don't have an account? <a href="{{ route('auth#register') }}"> register </a></small>
                </div>


            </form>
        </div>
    </div>
@endsection
