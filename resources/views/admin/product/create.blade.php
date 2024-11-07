@section('ctitle', 'productCreate')

@extends('layouts.aplayout')

@section('content')


    <div class="">
        <a href="{{route ('admin#product.list')}}" class="btn text-danger shadow"><i class="fa-solid fa-angles-left"></i></a>

        <div class="">
            {{-- Data --}}
            <form action="{{route('admin#product.list.create')}}" method="POST" enctype="multipart/form-data" class="p-3">
                @csrf
                <div class="row ">
                    <div class="col-6 pt-5">
                        <div class="ratio ratio-1x1 border">
                            <img src="{{ url (asset('defaultPizza.png'))}}" alt="">
                        </div>
                    </div>
                    <div class="col-6 pt-5">
                        <h3 class="mb-3 text-secondary px-3">Product creation</h3>
                        <div class="m-3">
                            <input type="text" id="name" name="name" placeholder="pizza name" class="form-control @error('name') is-invaild @enderror" value="{{ old('name')}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="m-3">
                            <select name="category" id="category" class="form-select @error('category') is-invaild @enderror" value="{{ old('category')}}">
                                @foreach ($categories as $C)
                                    <option value="{{$C->id}}">{{$C->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="m-3">
                            <div class="input-group">
                                <input type="number" id="price" name="price" placeholder="price" class="form-control @error('price') is-invaild @enderror" value="{{ old('price')}}">
                                <span class="input-group-text text-secondary">Kyat</span>
                            </div>
                                @error('prize')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>


                        <div class="m-3">
                            <textarea type="text" id="description" name="description" placeholder="description" class="form-control @error('description') is-invaild @enderror" rows="4" value="{{ old('description')}}"></textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="m-3">
                            <label for="img" class="form-label px-2">Upload Photo</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invaild @enderror" value="{{ old('image')}}">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>


                    </div>
                    <div class="d-flex justify-content-end p-4">
                        <button type="submit" class="btn btn-lg border text-success rounded-pill shadow-sm"><i class="fa-solid fa-cloud-arrow-up"></i></button>
                    </div>
                </div>



            </form>

        </div>

        <div class="">
            {{-- more Option --}}

        </div>

    </div>

@endsection
