<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $inputs['user_id'] = auth()->id();

        Task::create($inputs);

        return redirect()->route('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $inputs = $request->all();
        $task->update($inputs);

        return redirect()->route('dashboard.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return redirect()->route('dashboard.index');
    }

}
