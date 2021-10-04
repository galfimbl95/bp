@extends('entries.master')

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
    @if ($message = Session::get('success'))
        <div id="successMessage" class="alert alert-success" style="  position: fixed;  bottom: 0px;  left: 20px;">
            <p>{{ $message }}</p>
        </div>
    @endif
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>

@endsection

@section('footer')
    <form action="{{route('entries.create')}}">
        <button type="submit" class="btn btn-primary" style="position: fixed;  bottom: 20px;  right: 20px;" >
            <i class="bi bi-journal-plus"></i>
        </button>
    </form>


@endsection

