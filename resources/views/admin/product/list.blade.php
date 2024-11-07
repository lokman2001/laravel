@section('ctitle', 'productList')


@extends('layouts.aplayout')

@section('content')
    <div class="">
        <div class="row mb-1">
            {{-- header --}}
            <h4 class=" text-secondary col-4 px-5 ">Pizza List</h4>
            <div class="col-2 py-1">
                @if ($key != null)
                    <span class="badge bg-secondary text-white rounded-pill  align-middle"><small> {{ $key }}
                        </small></span>
                @endif
            </div>
            <div class="col-6 ">

                <form action="{{ route('admin#product.list') }}" class="d-flex justify-content-end col-12" method="get">
                    @csrf

                    <div class=" input-group border rounded ">
                        <input type="text" class="border-0 form-control" placeholder="Search" name="key"
                            value="{{ $key }}">
                        <button type="submit" class="btn btn-sm border-2 border-start px-3"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

            </div>

        </div>
        <hr>
        <div class="col-12 pb-1 row  ">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
                    <i class="fa-solid fa-cloud-arrow-up"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
                    <i class="fa-solid fa-trash"></i>{{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row ">
            @if (count($products) == 0)
                <div class="text-center text-secondary py-5">

                    <h5>there is no products</h5>

                </div>
            @else
            @endif
                {{-- List --}}
                @foreach ($products as $p)
                    <div class="col-4 p-1">
                        <div class="card ">
                            <div class="ratio ratio-21x9 bg-secondary rounded">
                                <img src="{{ url(asset('storage/' . $p->image)) }}" class="card-img-top object-fit-cover"
                                    alt="...">
                            </div>
                            <div class="card-body py-1">

                                <h5 class="mb-0 pb-0">{{ $p->name }}</h5>


                                <div class=" row">
                                    <div class="col-8">
                                        <a href="{{ route('admin#product.list.detail', $p->id) }}"
                                            class="btn btn-sm text-primary">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>

                                        <a href="{{ route('admin#product.list.delete', $p->id) }}"
                                            class="btn btn-sm text-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                    <div class="col-4 d-flex align-items-center ">
                                        <small><i class="fa-solid fa-eye"> {{ $p->view_count }}</i></small>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

        </div>


        <hr>
        <div class="row">
            <div class="col-5">
                {{ $products->appends(request()->query())->links() }}
            </div>

            <div class=" offset-5 col-2  text-end">
                <a href="{{ route('admin#product.list.createPage') }}" class="btn  text-success border rounded-circle "> <i
                        class="fa-solid fa-plus"></i></a>
            </div>
        </div>

    </div>
@endsection
