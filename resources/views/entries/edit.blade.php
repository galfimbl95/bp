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

        <form action="{{route('entries.update', $entry->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="datetime" class="form-label">Дата и время</label>
                <input name="datetime" type="datetime-local"
                       class="form-control @error('datetime') is-invalid @enderror" id="datetimeInput"
                       aria-describedby="datetimeHelp" value="{{ old('datetime') }}">
            </div>
            <div class="mb-3">
                <label for="numberSistol" class="form-label">Верхнее</label>
                <input name="numberSistol" type="number"
                       class="form-control @error('numberSistol') is-invalid @enderror" id="numberSistolInput"
                       value="@if(old('numberSistol' != 100)){{ old('numberSistol') }} @else {{$entry -> sistol}}" @endif>
            </div>
            <div class="mb-3">
                <label for="numberDiastol" class="form-label">Нижнее</label>
                <input name="numberDiastol" type="number"
                       class="form-control @error('numberDiastol') is-invalid @enderror" id="numberDiastolInput"
                       value="{{ $entry -> diastol }}">
            </div>
            <div class="mb-3">
                <label for="numberPulse" class="form-label">Пульс</label>
                <input name="numberPulse" type="number" class="form-control @error('numberPulse') is-invalid @enderror"
                       id="numberPulseInput" value="{{ old('numberPulse') }}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection

