@extends('master')

@section('title')
    {{'Журнал артериального давления'}}
@endsection

@section('main')
    <div class="container">
        <table class="table table-bordered table-sm ">
            <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
                <th scope="col">Давление</th>
                <th scope="col">Пульс</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($arrEntryPairs as $entryPair)

                <tr>
                    @if ($entryPair['morning'] != '')
                        <td rowspan="2"
                            data-date="{{$entryPair['morning'] -> date -> format("Y-m-d")}}"
                            onclick="document.location='{{route('showDay', ['date'=>$entryPair['morning'] -> date -> format("Y-m-d")])}}'">{{$entryPair['morning'] -> date -> format("d.m.Y")}}</td>
                        <td>Утро {{$entryPair['morning'] -> date -> format("H:i")}}</td>
                        <td>{{$entryPair['morning'] ->sistol}}/{{$entryPair['morning'] ->diastol}}</td>
                        <td>{{$entryPair['morning'] ->pulse}}</td>
                    @else
                        @if ($entryPair['evening'] != '')
                            <td rowspan="2"
                                data-date="{{$entryPair['evening'] -> date -> format("Y-m-d")}}"
                                onclick="document.location='{{route('showDay', ['date'=>$entryPair['evening'] -> date -> format("Y-m-d")])}}'">{{$entryPair['evening'] -> date -> format("d.m.Y")}}</td>
                        @endif
                        <td>Утро</td>
                        <td>--</td>
                        <td>--</td>
                    @endif
                </tr>
                <tr>
                    @if ($entryPair['evening'] != '')
                        <td>Вечер {{$entryPair['evening'] -> date -> format("H:i")}}</td>
                        <td>{{$entryPair['evening'] ->sistol}}/{{$entryPair['evening'] ->diastol}}</td>
                        <td>{{$entryPair['evening'] ->pulse}}</td></td>
                    @else
                        <td>Вечер</td>
                        <td>--</td>
                        <td>--</td>
                    @endif
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('footer')
    <form action="{{route('addEntry')}}">
        <button type="submit" style="  position: fixed;  bottom: 20px;  right: 20px;" >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
            </svg>
        </button>
    </form>
@endsection

