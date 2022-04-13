<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        return view('dashboard', compact('tasks'));
    }

    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'due_date' => 'required'
        ]);
        $due_date = $request->due_date;

        auth()->user()->tasks()->create([
            'description' => $request->description,
            'due_date' => $due_date,
        ]);

        return redirect('/dashboard');
    }

    public function edit(Task $task)
    {

        if (auth()->user()->id == $task->user_id) {
            return view('edit', compact('task'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Task $task)
    {
        if (isset($_POST['delete'])) {
            $task->delete();
            return redirect('/dashboard');
        } else {
            $this->validate($request, [
                'description' => 'required',
                'due_date' => 'required'
            ]);
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();
            return redirect('/dashboard');
        }
    }
}
