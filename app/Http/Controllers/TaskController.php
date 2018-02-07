<?php

namespace App\Http\Controllers;

use App\Model\Task;
use Illuminate\Http\Request;
use Gate;

class TaskController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['web','auth']);
    }

    public function index()
    {
        $data['tasks'] = $this->getAllTasks();
        return view('task', $data);
    }

    // добавление / редактирование задачи
    public function setTask(Request $request)
    {
        $task_id = $request->task_id;
        $task_name = $request->task_name;
        $task_text = $request->task_text;
        $task_deadline = $request->task_deadline;
        $task_status = $request->task_status;
        $user_id = $request->user()->id;
//        $user_id = 1;
//        dump($task_id);
        if($task_id){
            $task = Task::find($task_id);
            $task->name = $task_name;
            $task->text = $task_text;
            $task->deadline = $task_deadline;
            $task->status = $task_status;
            $task->user_id = $user_id;
        } else {
            $task = new Task;
            $task->name = $task_name;
            $task->text = $task_text;
            $task->deadline = $task_deadline;
            $task->status = $task_status;
            $task->user_id = $user_id;
        }
        if($task->save()){
            return $this->getAllTasks();
        }
    }

    // получение задачи
    public function getTask(Request $request)
    {
        $task = Task::find($request->id);
        if(Gate::denies('del', $task)){
            return ['message' => 'У Вас нет прав редактировать чужие задачи!'];
        }
        return $task;
    }

    // удаление задачи
    public function delTask(Request $request)
    {
        $task = Task::find($request->id);
        if(Gate::denies('del', $task)){
            return ['message' => 'У Вас нет прав удалять чужие задачи!'];
        }
        return Task::destroy($request->id);
    }

    // получение списка всех задач
    public function getAllTasks()
    {
        return Task::all();
    }
}
