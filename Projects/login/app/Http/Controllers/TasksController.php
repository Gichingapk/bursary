<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
      public function create()
    {
      return view('tasks.create');
    }
        public function index()
    {
        $tasks = Task::all();

        return view('tasks.index')->withTasks($tasks);
        }

        // public function store(Request $request)
        // {
        // $input = $request->all();
        //
        // Task::create($input);
        //
        // return redirect()->back();
        // }
        //
        // public function edit($id)
        //   {
        //     $task = Task::findOrFail($id);
        //
        // return view('tasks.edit')->withTask($task);
        // }
        //
        // public function show($id)
        //   {
        //     return view('tasks.show');
        //   }
        //
        //
        // public function destroy($id)
        // {
        // $task = Task::findOrFail($id);
        //
        // $task->delete();
        //
        // Session::flash('flash_message', 'Task successfully deleted!');
        //
        // return redirect()->route('tasks.index');
        // }
}
