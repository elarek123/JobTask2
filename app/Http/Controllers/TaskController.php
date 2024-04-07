<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\StatusHistory;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $data =  $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task = Task::create(['title' => $data['title'], 'description' => $data['description']]);

        StatusHistory::create(['status' => '0', 'task_id' => $task->id, 'created_at' => now()]);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */

    public function show(){
        $tasks = Task::paginate(2);
        return view('tasks', ['tasks' => $tasks]);
    }

    /**
     * Display the specified resource.
     */
    public function showOne(Task $task)
    {
        return json_encode(['data' => $task, 'status' => $task->status()->status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data =  $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task->update([ 'title' => $data['title'], 'description' => $data['description']]);
        
        return redirect()->back();
    }

    public function updateStatus(Request $request, Task $task){

        StatusHistory::create(['status' => $request->status, 'task_id' => $task->id, 'created_at' => now()]);
        return redirect()->back();
    }

    public function showAllStatus(Task $task){
        $status = $task->statuses()->get();
        return json_encode(['status' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->statuses()->delete();
        $task->delete();
        return redirect()->back();
    }
}
