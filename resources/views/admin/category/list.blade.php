@section('ctitle', 'categoryList')

@extends('layouts.aplayout')

@section('content')
    <div class=" text-secondary  pb-1 row">
        <h4 class="col-4">Category List</h4>
        <div class="col-8 row">
            <div class="col-4 align-middle py-1 text-end ">

                @if ($key != null)
                    <span class="badge bg-secondary text-white rounded-pill  align-middle"><small> {{ $key }} </small></span>
                @endif

            </div>
            <div class="col-8 ">

                <form action="{{route('admin#category.list')}}" class="d-flex justify-content-end col-12" method="get">
                    @csrf

                    <div class=" input-group border rounded ">
                        <input type="text" class="border-0 form-control" placeholder="Search" name="key" >
                        <button type="submit" class="btn btn-sm border-2 border-start px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-12 p-2">


        <div class="col-12 pb-1 row  ">

             @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
                    <i class="fa-solid fa-cloud-arrow-up"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif
            @if(session('delete'))

               <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
                <i class="fa-solid fa-trash"></i>{{ session('delete') }}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>

           @endif
        </div>

        <div class="p-1 ">

            @if(count($categories) != 0 )
                <table class="table table-striped border rounded">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>created at</th>
                        <th>updated at</th>
                        <th>   </th>
                    </tr>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td> <a href="{{ route('admin#category.list.delete', $category->id) }}" class="btn text-danger "><i class="fa-solid fa-trash-can"></i></a>
                            <a href="{{ route('admin#category.list.editPage', $category->id) }}" class="btn text-primary "><i class="fa-solid fa-pen-nib"></i></a></td>
                    </tr>
                    @endforeach

                </table>

                {{ $categories->appends(request()->query())->links() }}
            @else
                <div class="py-5 d-flex justify-content-center opacity-25">

                    <h5 class="text-secondary"> there is no category</h5>

                </div>


            @endif


        </div>


            <div class="col-12 pb-2 d-flex justify-content-end">
                <a href="{{ route('admin#category.list.createPage') }}" class=" btn text-success border rounded-circle bg-white shadow"><i class="fa-solid fa-plus"></i></a>
            </div>


    </div>
@endsection
