@extends('entries.master')

@section('title')
    {{'Журнал артериального давления'}}
@endsection
@section('main')
    <div class="container">

        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
                <th scope="col">Давление</th>
                <th scope="col">Пульс</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($arrEntries as $entry)

                <tr>
                    <td data-entryId="{{$entry->id}}" onclick="">{{$entry -> date -> format("d.m.Y")}}</td>
                    <td>{{$entry -> date -> format("H:i")}}</td>
                    <td>{{$entry -> sistol}}/{{$entry ->diastol}}</td>
                    <td>{{$entry ->pulse}}</td>
                    <td>
                        <div class="dropdown">
                            <svg data-bs-toggle="dropdown" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('entries.edit', $entry->id) }}">Изменить</a></li>
                                <li>
                                    <form class="dropdown-item" action="{{ route('entries.destroy', $entry->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button   type="submit" title="Удалить"
                                                style="border: none; background-color:transparent;">
                                            Удалить
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        @if ($message = Session::get('success'))
            <div id="successMessage" class="alert alert-success" style="position: fixed;  bottom: 50px; left: 20px; right: 20px; text-align: center;">
                <p>{{ $message }}</p>
            </div>
        @endif
        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        </script>
    </div>


@endsection

