@extends('layouts.app')

@section('content')



    <form action="{{url('/store')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-2">
            <label for="name">Название сделки</label>
            <input type="text" class="form-control" name="name" placeholder="Введите название">
        </div>
        <div class="form-group col-2">
            <label for="date">Дата сделки</label>
            <input type="date" class="form-control" name="date" placeholder="Укажите дату">
        </div>
        <div class="form-check col-2">
            <label for="status">Статус сделки</label>
            <input type="number" min="0" step="10" max="100" class="form-control" name="status" placeholder="Укажите статус в %">
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </form>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
