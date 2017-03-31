@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Текущие таски
        </div>

        <div class="panel-body col-3">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Список</th>
                <th>&nbsp;</th>
                <th><a href="/">Назад</a></th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($tasks as $task)
                    <tr id="{{$task->id}}">
                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $task->name }}</div>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger" _method="delete" onclick="deleteTask({{ $task->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection