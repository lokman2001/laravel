@section('ctitle', 'suggestionMail')

@extends('layouts.aplayout')


@section('content')
    <div class="px-3">
        <h4>Suggestion mail inbox</h4>
    </div>
    <div class="py-2 px-2 overflow-y-scroll" style="height: 300px">
        @if (count($data) == 0)
            <div class="py-5 text-center text-secondary">
                <h4>there is no message</h4>
            </div>
        @else

            @foreach ($data as $d)
                <div class="message-box border p-2 mb-2 rounded">

                    <div class="px-2 row">
                        <div class="col-10"><em>{{ $d->email }}</em></div>
                        <div class="col-2">{{ $d->created_at->format('d/M/Y') }}</div>
                    </div>

                    <div class="message " style="display: none" >
                        <small class="text-secondary"><em>name </em> : <em>{{ $d->name }}</em></small>
                        <br>
                        <small class="text-secondary">message</small>
                        <div class="border rounded p-1">
                            <span>{{ $d->message }}</span>
                            <div class="text-end"><a href="{{ route('admin#inbox.delete', $d->id) }}"
                                    class="btn btn-sm text-danger"><i class="fa-solid fa-trash"></i></a></div>
                        </div>

                    </div>

                </div>
            @endforeach

        @endif


    </div>
@endsection
@section('childScript')
    <script type="text/javascript">
        $(document).ready(



            $('.message-box').click(function() {

                $(this).children('.message').toggle();
            })
        )
    </script>
@endsection
