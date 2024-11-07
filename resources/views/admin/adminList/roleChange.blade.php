@section('ctitle', 'userList')

@extends('layouts.aplayout')

@section('content')
    <div class="text-secondary row ">
        <div class="col-1 pe-2">
            <a href="{{ route('admin#admin.list') }}" class=" btn text-danger shadow"><i
                    class="fa-solid fa-angles-left"></i></a>
        </div>
        <h6 class="col-5"><i class="fa-solid fa-user m-1 fs-5 "></i>User List</h6>
        <div class="col-6 ">

            <form action="{{ route('admin#admin.addAdmin') }}" class="d-flex justify-content-end col-12 " method="get">
                @csrf

                <div class=" input-group border rounded  ">
                    <input type="text" class="border-0 form-control" value="{{ $key }}"
                        placeholder="Search user by name" name="key">
                    <button type="submit" class="btn btn-sm border-2 border-start px-3"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>

        </div>

    </div>
    <div class="">
        <div class="row text-center fs-6 fst-italic p-2">
            <div class="col-1">image</div>
            <div class="col-3">name</div>
            <div class="col-4">email</div>
            <div class="col-2">phone</div>
            <div class="col-2"></div>
        </div>
        @if (count($data) == 0)
            <div class="text-center text-secondary py-5">

                <h5>there is no user</h5>

            </div>
        @else
            @foreach ($data as $d)
                <div class="row text-center fs-6 border rounded bg-white shadow-sm mb-1  align-items-center p-1">
                    @if ($d->image == null)
                        <div class="col-1 ">
                            <div class="ratio ratio-1x1"><img src="{{ url(asset('default.png')) }}" alt=""
                                    class="col-1 object-fit-cover rounded-circle"></div>
                        </div>
                    @else
                        <div class="col-1 ">
                            <div class="ratio ratio-1x1"><img src="{{ url(asset('storage/' . $d->image)) }}" alt=""
                                    class="col-1 object-fit-cover rounded-circle"></div>
                        </div>
                    @endif
                    <small class="col-3">{{ $d->name }}</small>
                    <small class="col-4">{{ $d->email }}</small>
                    <small class="col-2">{{ $d->phone }}</small>
                    @if (Auth::user()->name != $d->name)
                        <div class="col-2 text-end">
                            <a href="{{ route('admin#admin.list.personalDetails', $d->id) }}" class="me-1"><i
                                    class="fa-solid fa-circle-info"></i></a>
                            <a href="{{ route('admin#admin.addAdmin.change', $d->id) }}" class=""><i
                                    class="fa-solid fa-user-plus"></i></a>
                        </div>
                    @endif

                </div>
            @endforeach

        @endif

    </div>
@endsection
