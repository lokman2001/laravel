@section('ctitle', 'categoryEdit')

@extends('layouts.aplayout')

@section('content')


    <div class=" mb-4">
        <div class="mb-4">
            <a href="{{ route('admin#category.list') }}" class="btn text-danger shadow"><i class="fa-solid fa-angles-left"></i></a>
        </div>

        <div class="d-flex justify-content-center mb-4">
            <h5>Editing Category</h5>
        </div>

        <form action="{{ route('admin#category.list.update') }}" method="post" class="px-1 mx-2 mb-5">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class=" mx-1 px-1 d-flex justify-content-center ">
                <div class="w-75 row input-group border rounded shadow">
                    <input type="text" placeholder="Enter Category Name.." class=" px-3 form-control border-0 " name="name" value="{{ $data->name }}">
                    <button type="submit" class="col-1 btn btn-sm text-success  border-2 border-start"><i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>

            </div>
            <div class="d-flex justify-content-center">
                 @error('name')
                    <small class="mx-4  text-danger">{{ $message }}</small>
                @enderror
            </div>

        </form>


    </div>

@endsection
