@section('ctitle', 'contact')

@extends('layouts.urlayout')

@section('content')
    <div class="  col-6 mt-3 p-4 shadow-sm">
        <h4>Contact us</h4>
        <hr>
        <div class=" p-2 ">
            <h4 class="ms-3">Suggestion box</h4>
            <div class="px-4">

                <input type="text" class=" form-control px-3" placeholder="Message" id="message" name="message">
                <div class="text-end mt-1 " id="btn-div" >
                    <button type="button" id="submit" class="btn btn-info " ><i
                            class="fa-regular fa-paper-plane"></i></button>

                </div>

            </div>
        </div>
        <hr>
        <div class=" text-center ">
            <address><em>No.10, Downing Street,London // phone 0800 112 4272</em></address>
        </div>
    </div>
@endsection
@section('childScript')
    <script type="text/javascript">
        $(document).ready(function() {
                $('#submit').click(
                    function() {
                        $message = $('#message').val()
                        if ($message != '') {
                            $.ajax({
                                type: 'get',
                                url: 'http://localhost:8000/ajax/Suggestion',
                                data: {
                                    'message': $message,
                                },
                                dataType: 'json',
                                success: function(response) {

                                    $response = `<div class="text-center text-success">
                                                     <small>${response['message']}</small>
                                                 </div>`

                                    $('#btn-div').html($response)


                                }

                            })


                        } else {
                            $('#message').addClass('is-invalid');
                        }
                    })




            }



        )
    </script>
@endsection
