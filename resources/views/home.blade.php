@extends('layouts.app')

@section('content')

    <form action="{{url('/api/deal')}}" id="form">
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
            <select class="form-control" name="status">
                <option>0</option>
                <option>1</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </form>


@endsection
