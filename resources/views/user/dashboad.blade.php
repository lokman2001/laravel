@section('ctitle', 'home')

@extends('layouts.urlayout')

@section('content')

    <div class="col-8">

        <div class="row">
            <div class="col-3 ">
                <select name="sort" id="sort" class="btn bg-white shadow-sm col-12 ">
                    <option value="asc" selected>ascending</option>
                    <option value="desc">descending</option>
                </select>
            </div>
            <div class="col-5">
                    <select name="" id="categoryFilter" class="btn bg-white text-start shadow-sm">
                            <option value="0">Filter By Category : all </option>
                        @foreach ($categories as $c )
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
            </div>


        </div>
        <div class="p-1 row overflow-y-scroll mt-1" id="pizzaList" style="height:400px;">

            @foreach ($data as $d )
                <div class=" col-3 p-1 " >

                    <a href="{{route('user#pizza.detail',$d->id)}}" class="rounded card link-underline link-underline-opacity-0 shadow-sm border-0 ">
                        <div class="shadow-sm">
                            <div class="ratio ratio-21x9 ">
                                <img src="{{url(asset('storage/'.$d->image))}}" alt="" class="object-fit-cover rounded ">
                            </div>
                            <div class="p-2">
                                <h6>{{$d->name}}</h6>
                                <p>{{$d->price}} <b>Kyat</b></p>
                            </div>

                        </div>
                    </a>

                </div>
            @endforeach

        </div>

    </div>


@endsection

@section('childScript')
<script type="text/javascript">
    let sort ='';
    let category ='';

     $(document).ready(function(){

        // sorting selector
        //----------------------------------------------------------------------------------------------------------------------------------
        $('#sort').change(function(){

            // -----------------------------------------------------------------------------------------------------------------------------
            sort = $('#sort').val();
            if (sort == 'asc') {
                $.ajax({
                        type : 'get' ,
                        url  : 'http://localhost:8000/ajax/getProductData',
                        data : {'sort' : 'asc'},
                        dataType : 'json',
                        success : function(response){
                            let list = '';
                            for(var i = 0 ; i<response.length ; i++ ){
                                let id = 1
                               list += `<div class=" col-3 p-1 ">

                                            <a href="{{url('user/dashboard/pizzaDetail/${response[i].id}')}}" class="rounded card link-underline link-underline-opacity-0 shadow-sm border-0 ">
                                                <div class="shadow-sm">
                                                    <div class="ratio ratio-21x9 ">
                                                        <img src="{{url(asset('storage/${response[i].image}'))}}" alt="" class="object-fit-cover rounded ">
                                                    </div>
                                                    <div class="p-2">
                                                        <h6>${response[i].name}</h6>
                                                        <p>${response[i].price} <b>Kyat</b></p>
                                                    </div>

                                                </div>
                                            </a>

                                        </div>`
                            }

                            $('#pizzaList').html(list)
                        }

                    })
                } else if(sort == 'desc'){
                    $.ajax({
                        type : 'get' ,
                        url  : 'http://localhost:8000/ajax/getProductData',
                        data : {'sort' : 'desc'},
                        dataType : 'json',
                        success : function(response){
                            let list = '';
                            for(var i = 0 ; i<response.length ; i++ ){
                               list +=    `<div class=" col-3 p-1 ">

                                            <a href="{{url('user/dashboard/pizzaDetail/${response[i].id}')}}" class="rounded card link-underline link-underline-opacity-0 shadow-sm border-0 ">
                                                <div class="shadow-sm">
                                                    <div class="ratio ratio-21x9 ">
                                                        <img src="{{url(asset('storage/${response[i].image}'))}}" alt="" class="object-fit-cover rounded ">
                                                    </div>
                                                    <div class="p-2">
                                                        <h6>${response[i].name}</h6>
                                                        <p>${response[i].price} <b>Kyat</b></p>
                                                    </div>

                                                </div>
                                            </a>

                                        </div>`
                            }
                            $('#pizzaList').html(list)
                        }

                    })

            }
            // -----------------------------------------------------------------------------------------------------------------------------
        })

        //----------------------------------------------------------------------------------------------------------------------------------


        $('#categoryFilter').change(function(){
            category = $('#categoryFilter').val();
            sort = $('#sort').val();

        // -----------------------------------------------------------------------------------------------------------------------------

                $.ajax({
                        type : 'get' ,
                        url  : 'http://localhost:8000/ajax/getProductDataByCategory',
                        data : {'category' : category ,
                                  'sort'   :   sort  },
                        dataType : 'json',
                        success : function(response){
                            let list = '';
                            for(var i = 0 ; i<response.length ; i++ ){
                                let id = 1
                            list += `<div class=" col-3 p-1 ">

                                            <a href="{{url('user/dashboard/pizzaDetail/${response[i].id}')}}" class="rounded card link-underline link-underline-opacity-0 shadow-sm border-0 ">
                                                <div class="shadow-sm">
                                                    <div class="ratio ratio-21x9 ">
                                                        <img src="{{url(asset('storage/${response[i].image}'))}}" alt="" class="object-fit-cover rounded ">
                                                    </div>
                                                    <div class="p-2">
                                                        <h6>${response[i].name}</h6>
                                                        <p>${response[i].price} <b>Kyat</b></p>
                                                    </div>

                                                </div>
                                            </a>

                                        </div>`
                            }

                            $('#pizzaList').html(list)
                        }

                    })



            })
        // -----------------------------------------------------------------------------------------------------------------------------

    })

</script>
@endsection





