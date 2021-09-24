@extends('entries.master')

@section('title')
    {{'Журнал артериального давления'}}

@endsection

@section('main')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ui>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ui>
            </div>
        @endif

        <form action="{{route('entries.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">Дата и время</label>
                <input name="date" type="datetime-local"
                       class="form-control @error('date') is-invalid @enderror" id="datetimeInput"
                       aria-describedby="datetimeHelp" value="{{ old('date') }}">
            </div>
            <div class="mb-3">
                <label for="sistol" class="form-label">Верхнее</label>
                <input name="sistol" type="number"
                       class="form-control @error('sistol') is-invalid @enderror" id="numberSistolInput"
                       value="{{ old('sistol') }}">
            </div>
            <div class="mb-3">
                <label for="diastol" class="form-label">Нижнее</label>
                <input name="diastol" type="number"
                       class="form-control @error('diastol') is-invalid @enderror" id="numberDiastolInput"
                       value="{{ old('diastol') }}">
            </div>
            <div class="mb-3">
                <label for="pulse" class="form-label">Пульс</label>
                <input name="pulse" type="number" class="form-control @error('pulse') is-invalid @enderror"
                       id="numberPulseInput" value="{{ old('pulse') }}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection

