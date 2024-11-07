@section('ctitle', 'adminList')

@extends('layouts.aplayout')

@section('content')
    <div class="text-secondary row ">
        <h6 class="col-10"><i class="fa-solid fa-user-tie m-1 fs-5 "></i>Admin List</h6>
        <div class="col-2">
            <a href="{{ route('admin#admin.addAdmin') }}" class="btn btn-sm text-secondary border "><i
                    class="fa-solid fa-user"></i> user list</a>
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
        @foreach ($data as $d)
            <div class="row text-center fs-6 border rounded bg-white shadow-sm mb-1  align-items-center p-1">
                @if ($d->image == null)
                    <div class="col-1 ">
                        <div class="ratio ratio-1x1"><img src="{{ url(asset('default.png')) }}" alt=""
                                class="col-1 object-fit-cover border rounded-circle"></div>
                    </div>
                @else
                    <div class="col-1 ">
                        <div class="ratio ratio-1x1"><img src="{{ url(asset('storage/' . $d->image)) }}" alt=""
                                class="col-1 object-fit-cover border rounded-circle"></div>
                    </div>
                @endif

                <div class="col-3">{{ $d->name }}</div>
                <div class="col-4">{{ $d->email }}</div>
                <div class="col-2">{{ $d->phone }}</div>
                @if (Auth::user()->name != $d->name)
                    <div class="col-2 text-end">
                        <a href="{{ route('admin#admin.list.personalDetails', $d->id) }}" class="m-1"><i
                                class="fa-solid fa-circle-info"></i></a>
                        <a href="{{ route('admin#admin.addAdmin.remove', $d->id) }}" class="m-1 text-danger"><i
                                class="fa-solid fa-circle-minus"></i></a>
                    </div>
                @endif

            </div>
        @endforeach
    </div>
@endsection
