@section('ctitle', 'productEdit')


@extends('layouts.aplayout')

@section('content')
    <form action="{{route('admin#product.list.editPage.update')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class=" col-4 py-5">
            {{-- image --}}
            <div class="ratio ratio-1x1 ">
                <img src="{{ url (asset ('storage/'.$data->image))}}" alt="" class="object-fit-scale border rounded">
            </div>
            <input type="file" name="image" id="" class="form-control mt-1" value="">

        </div>
        <div class="col-8">
            {{-- detail --}}
            <input type="text" name="id" id="" value="{{$data->id}}" hidden>
            <div class="m-3">
                <input type="text" id="name" name="name" placeholder="pizza name" class="form-control " value="{{ $data->name }}" >
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="m-3">

                <select name="category" id="category" class="form-select @error('category') is-invaild @enderror">
                    @foreach ($categories as $C)
                        @if ($C->id == $data->category_id)
                            <option value="{{$C->id}}" selected>{{$C->name}}</option>
                        @else
                            <option value="{{$C->id}}">{{$C->name}}</option>
                        @endif
                    @endforeach
                </select>
                @error('category')
                    <small class="text-danger">{{$message}}</small>
                @enderror

            </div>

            <div class="m-3 col-6 ">
                <div class="input-group">
                    <input type="number" id="price" name="price" placeholder="price" class="form-control " value="{{ $data->price }}" >
                    <span class="input-group-text text-secondary">Kyat</span>
                </div>
                @error('price')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="m-3">
                <textarea type="text" id="description" name="description" placeholder="description" class="form-control " rows="8" value="" >{{ $data->description}}</textarea>
                @error('description')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-end mb-2">
        <button type="submit" class=" btn shadow border text-primary mx-3"><i class="fa-solid fa-cloud-arrow-up mx-1"></i>Update</button>
    </div>
    </form>



@endsection
