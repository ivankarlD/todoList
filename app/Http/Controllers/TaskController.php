<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function addform()
    {
        return view('task.components.addForm');
    }

    public function index($category)
    {   
        $category = ($category == 0 || $category == "null") ? null : $category;        
        $tasksNotDone = Task::where('category_id', $category)->where('task_status', false)->get();
        $tasksDone = Task::where('category_id', $category)->where('task_status', true)->get();
        return view('task.components.taskItem', ['done' => $tasksDone, 'notDone' =>$tasksNotDone]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_content' => 'required',
            'task_date' => 'required|date|after:today',
        ]);

        $category = ($request['category_id'] == 0 || $request['category_id'] == 'null') ? null : $request['category_id'];
        if ($validator->passes()) {
            Task::create([
                'user_id' => Auth::user()->id,
                'category_id' => $category,
                'task_content' => $request['task_content'],
                'task_date' => $request['task_date'],
            ]);
            // return response()->json($shit);
            return response()->json(['success' => 'New task added successfully']);
        }
        return response()->json(['error' => $validator->messages()]);
    }

    public function status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|numeric',
            'status' => 'required|in:true,false',
        ]);
        if ($validator->passes()) {
            $status = ($request['status']=='true') ? 1 : 0 ;
            Task::where('id', $request['task'])->update([
                'task_status' => $status
            ]);
            return response()->json(['success' => 'successful']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($task)
    {   
        $task = Task::where('id', $task)->get();
        return view('task.components.editForm', ['task' => $task]);
    }

    public function update(Request $request)
    {
        // return response()->json($request);
        $validator = Validator::make($request->all(), [
            'task_content' => 'required',
            'task_date' => 'required|date|after:today',
        ]);

        $category = ($request['category_id'] == 0 || $request['category_id'] == 'null') ? null : $request['category_id'];
        if ($validator->passes()) {
            Task::where('id', $request['task_id'])->update([
                'user_id' => Auth::user()->id,
                'category_id' => $category,
                'task_content' => $request['task_content'],
                'task_date' => $request['task_date'],
            ]);
            return response()->json(['success' => 'New task added successfully']);
        }
        return response()->json(['error' => $validator->messages()]);
    }

}
