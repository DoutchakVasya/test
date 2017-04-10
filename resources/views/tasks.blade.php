@extends('layouts.app')

@section('content')

@if (!empty($dealId))
    <div class="panel panel-default">
        <div class="panel-heading col-3">
            <p>
                <strong>Сделка успешно создана</strong>
            </p>
        </div>

        <div class="panel-body col-3">
           <p>Идентификатор сделки: {{$dealId}}</p>
           <p>Идентификатор задачи: {{$taskId}}</p>
        </div>
    </div>
    <div class="col-3">
        <a href="{{url('/')}}">Назад</a>
    </div>
@endif

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