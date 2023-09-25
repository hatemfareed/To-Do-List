<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class tasksController extends Controller
{
    public function index()
    {
        $task = Task::orderBy('id')->get();
        return view('tasks')->with('tasks' , $task);
    }
    public function store(Request $request)
    {
       $request->validate([
           'task' => 'required|max:100'
       ],[
              'task.required' => 'Please enter task name',
              'task.max' => 'Task name should not be greater than 100 characters'
       ]);
        $task = new Task();
        $task->task = $request->task ;
        $task->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'status' => 'success',
        ]);
        
    }
    public function complete(Task $task)
    {
        if ($task->iscompleted) {
            $task->iscompleted = 0;
        } else
            $task->iscompleted = 1;
        $task->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
