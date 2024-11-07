@section('ctitle', 'productDetail')

@extends('layouts.urlayout')

@section('content')
    <div class=" p-2 col-8 row ">
        <div class="col-12 row">
            <a href="{{ route('user#dashboard') }}"class="btn btn-white bg-white shadow-sm py-2 col-1"> <i
                    class="fa-solid fa-angles-left"></i></a>
            <h5 class="col-10 px-4">pizza detail</h5>
        </div>
        <div class="col-9  bg-white rounded py-1 mt-2 border shadow-sm mb-4">
            <form action="{{ route('user#addtocart') }}" method="post" class="row">
                <input type="text" class="category_id" value="{{ $detail->category_id }}" name="category_id" hidden>
                <input type="text" class="product_id" value="{{ $detail->id }}" name="product_id" hidden>
                <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden>


                @csrf
                <div class="col-4 p-4">
                    <div class="ratio ratio-1x1 ">
                        <img src="{{ url(asset('storage/' . $detail->image)) }}" alt=""
                            class="object-fit-cover rounded border">
                    </div>

                </div>
                <div class="col-8 px-4 ">
                    <h5>{{ $detail->name }}</h5>
                    <p class="col-5 text-warning">
                        @for ($i = 0; $i < $avgStar; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </p>

                    <small>price</small>
                    <h5 class="font-monospace">{{ $detail->price }} <b>Kyat</b></h5>
                    <small>Description</small>
                    <hr class="">
                    <p class="overflow-y-scroll" style="height:100px;">
                        {{ $detail->description }}
                    </p>
                </div>
                <div class="col-6 offset-5 mt-2 mb-2 row">
                    <div class="col-2 text-center"><small class=""><i class="fa-regular fa-eye"></i>
                            {{ $detail->view_count }}</small> </div>
                    <div class="col-2"></div>
                    <button class="col-1 btn btn-outline-warning p-0" type="button" onclick="sub()"><i
                            class="fa-solid fa-minus"></i></button>

                    <input type="text" name="qty" id="QTY"
                        class="col-2 border border-warning rounded text-center" readonly>

                    <button class="col-1 btn btn-outline-warning p-0" type="button" onclick="add()"><i
                            class="fa-solid fa-plus"></i></button>
                    <div class="col-1 offset-3">
                        <button type="submit" class="btn btn-warning "><i class="fa-solid fa-cart-arrow-down"></i></button>
                    </div>
                </div>
            </form>
            <div class=" row rounded  ">
                @if ($chanceOfRating == 0)
                    <div class=" border-top">
                        <p class="ps-5"><em><u>Rate Pizza</u></em></p>
                    </div>
                    <div class="col-5 mb-1 text-center " id="stars-display">
                        <span class=" star p-2"><i class=" fa-solid fa-star"></i></span>
                        <span class=" star p-2"><i class=" fa-solid fa-star"></i></span>
                        <span class=" star p-2"><i class=" fa-solid fa-star"></i></span>
                        <span class=" star p-2"><i class=" fa-solid fa-star"></i></span>
                        <span class=" star p-2"><i class=" fa-solid fa-star"></i></span>
                    </div>
                    <div class=" col-7 row px-4">
                        <input type="hidden" id="rating">
                        <input type="hidden" value="{{ $detail->id }}" id="product-id">
                        <div class="col-10">
                            <input class=" form-control" name="" id="rating-message" cols="" rows="2"
                                placeholder="Message"></input>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-warning btn-sm mt-1" id="rating-submit" disabled>submit</button>
                        </div>
                    </div>
                @else
                    <hr>
                    <div class="text-center">
                        <h6><em>- you already rated -</em></h6>
                    </div>
                @endif


            </div>

        </div>

        <div class="col-3  ">
            <h6>recommend food</h6>
            <hr>
            <div id="recommend" class="h-100 overflow-y-scrol px-1">

            </div>
        </div>

        <div class=" mb-4">
            <h5 class="px-4">rating and comment</h5>
            <hr>
            <div class="">
                @foreach ($ratings as $r)
                    <div class=" row  align-content-center">
                        <div class="col-1 offset-1">
                            <div class="ratio ratio-1x1">
                                @if ($r->image == null)
                                    <img src="{{ url(asset('default.png')) }}" alt=""
                                        class=" w-100 border rounded-circle object-fit-cover">
                                @else
                                    <img src="{{ url(asset('storage/' . $r->image)) }}" alt=""
                                        class=" w-100 border rounded-circle object-fit-cover">
                                @endif
                            </div>
                        </div>
                        <h6 class="col-4 py-2">{{ $r->name }}</h6>
                        <div class="col-3 text-warning">
                            @for ($i = 1; $i <= $r->rating_count; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <div class="col-3">{{ $r->rcreated_at }}</div>
                        <p class=" offset-2">{{ $r->message }}</p>
                    </div>
                    <hr>
                @endforeach

            </div>

        </div>

    </div>
@endsection

@section('childScript')
    <script type="text/javascript">
        var QTY = 1
        $('#QTY').val(QTY);

        function add() {
            QTY += 1;
            $('#QTY').val(QTY);
        }

        function sub() {
            QTY -= 1;
            $('#QTY').val(QTY);
            if (QTY < 1) {
                QTY = 1
                $('#QTY').val(QTY);
            }
        }
        $(document).ready(function() {


            $('.star').click(
                function() {
                    $stopPoint = $(this).index();
                    $('.star').removeClass('text-warning');
                    for ($i = 0; $i <= $stopPoint; $i++) {
                        $('.star').eq($i).addClass('text-warning');
                    }
                    $('#rating').val($stopPoint + 1);
                    $('#rating-submit').removeAttr('disabled');

                }
            )
            $('#rating-submit').click(function() {
                $rating = $('#rating').val();
                $productid = $('#product-id').val();
                $ratingmessage = $('#rating-message').val();
                $simple = ['', 'bad', 'not bad', 'normal', 'good', 'grate']
                if ($ratingmessage == '') {
                    $ratingmessage = $simple[$rating * 1];
                }
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/ajax/ratingStar',
                    data: {
                        'rating': $rating,
                        'product_id': $productid,
                        'message': $ratingmessage,
                    },
                    dataType: 'json',
                    success: function(response) {
                        location.reload();
                    }
                })
            })


            $category = $('.category_id').val();
            $product = $('.product_id').val();

            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/ajax/getProductDataByCategory',
                data: {
                    'category': $category,
                    'sort': 'asc'
                },
                dataType: 'json',
                success: function(response) {
                    let list = '';
                    for ($i = 0; $i < response.length; $i++) {
                        if (response[$i].id != $product) {
                            list += `<div class=" col-12 mb-1">

                                            <a href="{{ url('user/dashboard/pizzaDetail/${response[$i].id}') }}" class="rounded card link-underline link-underline-opacity-0 shadow-sm border-0 ">
                                                <div class="shadow-sm">
                                                    <div class="ratio ratio-21x9 ">
                                                        <img src="{{ url(asset('storage/${response[$i].image}')) }}" alt="" class="object-fit-cover rounded ">
                                                    </div>
                                                    <div class="p-2">
                                                        <small><em>${response[$i].name}</em></small>
                                                        <br>
                                                        <small>${response[$i].price} <b>Kyat</b></small>
                                                    </div>

                                                </div>
                                            </a>

                                        </div>`
                        }

                    }
                    console.log($category);
                    $('#recommend').html(list)
                }

            })



        })
    </script>
@endsection
