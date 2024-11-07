@section('ctitle', 'productInfo')


@extends('layouts.aplayout')

@section('content')
    <a href="{{route ('admin#product.list')}}" class="btn text-danger shadow"><i class="fa-solid fa-angles-left"></i></a>
    @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
                    <i class="fa-solid fa-cloud-arrow-up"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif
    <div class="row">
        <div class=" col-4 py-5">
            {{-- image --}}
            <div class="ratio ratio-1x1 ">
                <img src="{{ url (asset ('storage/' . $data->image))}}" alt="" class="object-fit-scale border rounded">
            </div>
        </div>
        <div class="col-8">
            <h5 class="text-secondary">Product detail</h5>
            {{-- detail --}}
            <input type="text" id="name" name="name" placeholder="pizza name" class="form-control " value="{{ $data->id }}" hidden>

            <div class="m-3">
                <input type="text" id="name" name="name" placeholder="pizza name" class="form-control " value="{{ $data->product_name }}" disabled>
            </div>
            <div class="m-3">
                <input type="text" id="category" name="category_id" placeholder="pizza name" class="form-control " value="{{  $data->category_name }}" disabled>
            </div>

            <div class="m-3 col-6 ">
                <div class="input-group">
                    <input type="number" id="price" name="price" placeholder="price" class="form-control " value="{{ $data->price }}" disabled>
                    <span class="input-group-text text-secondary">Kyat</span>
                </div>
            </div>


            <div class="m-3">
                <textarea type="text" id="description" name="description" placeholder="description" class="form-control " rows="8" value="" disabled>{{ $data->description}}</textarea>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('admin#product.list.editPage',$data->product_id)}}" class="btn shadow border text-primary mx-3"><i class="fa-solid fa-pen-nib"></i></a>
    </div>




@endsection
