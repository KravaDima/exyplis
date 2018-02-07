@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Все задачи:</div>
                    <div id="alert" class="alert alert-danger" style="display: none">
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success" data-toggle="modal" href="#modal" onclick="clearModal()">Добавить задачу</a>

                        <div class="row">
                            <table id="" class="table">
                                <thead>
                                <tr>
                                    <th style="width: 40px;">&#8470;</th>
                                    <th style="width: 230px;">Наименование</th>
                                    <th style="width: 50px;padding-left: 0px!important;text-align: center;">Срок</th>
                                    <th style="width: 50px;">Статус</th>
                                    <th style="width: 50px;">Действия</th>
                                </tr>
                                </thead>
                                <tbody id="all-tasks-tab" class="">
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task['id'] }}</td>
                                        <td>{{ $task['name'] }}</td>
                                        <td>{{ $task['deadline'] }}</td>
                                        <td>{{ $task['status'] }}</td>
                                        <td class="text-center"><a href="#" onclick="editTask({{ $task['id'] }})">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a class="col-md-offset-3" href="#" onclick="delTask({{ $task['id'] }})">
                                                <i class="fa fa-trash-o fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- HTML-код модального окна -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-lg modalInsideEmployee">
            <div class="modal-content" style="min-height: 400px;">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о задаче</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <input id="task_id" type="hidden" class="form-control" name="task_id">
                        <label for="task_name" class="col-md-4 control-label">Наименование</label>
                        <div class="col-md-6">
                            <input id="task_name" type="text" class="form-control" name="task_name" value="{{ old('task_name') }}" required autofocus>
                        </div>
                        <label for="task_text" class="col-md-4 control-label">Текст задачи</label>
                        <div class="col-md-6">
                            <textarea id="task_text" rows="8" type="text" class="form-control" name="task_text" value="{{ old('task_text') }}" required></textarea>
                        </div>
                        <label for="task_deadline" class="col-md-4 control-label">Deadline</label>
                        <div class="col-md-6">
                            <input id="task_deadline" type="date" class="form-control" name="task_deadline" value="{{ old('task_deadline') }}" required>
                        </div>
                        <label for="task_status" class="col-md-4 control-label">Статус</label>
                        <div class="col-md-6">
                            <select id="task_status">
                                <option value="0">Невыполнено</option>
                                <option value="1">Выполнено</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-md-offset-8">
                            <button id="" type="submit" form="" class="btn btn-danger" onclick="setTask();">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
