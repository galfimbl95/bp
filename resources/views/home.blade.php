@extends('master')

@section('title')
    {{'Журнал артериального давления'}}
@endsection

@section('main')
    <div class="container">
        <table class="table">
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
                    <td rowspan="2">{{$entryPair['morning'] -> date -> format("d.m.Y")}}</td>
                    <td>Утро {{$entryPair['morning'] -> date -> format("H:i")}}</td>
                    <td>{{$entryPair['morning'] ->sistol}}/{{$entryPair['morning'] ->diastol}}</td>
                    <td>{{$entryPair['morning'] ->pulse}}</td>
                    @else
                        @if ($entryPair['evening'] != '')
                            <td rowspan="2">{{$entryPair['evening'] -> date -> format("d.m.Y")}}</td>
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

