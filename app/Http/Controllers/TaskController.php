<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{
    public function addTask(Request $request) {

        \Log::info($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'task'=> 'required|string',
                'user_id'=> 'required|exists:users,id'
            ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()->all()
            ],403);
        }

        $task = Task::create([
            'task' => $request->task,
            'user_id' => $request->user_id
        ]);

        return response()->json([
             'status' => true,
             'message' => 'Successfully created a task',
             'task' => $task
        ]);
    }

    public function changeStatus(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'task_id' => 'required|exists:tasks,id',
                'status' => 'required|in:pending,done'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()->all()
                ]);
            }

            $task = Task::find($request->task_id);
            $task->status = $request->status;
            $task->save();

            return response()->json([
                'status' => 1,
                'message' => 'Marked task as ' .$request->status,
                'task' => $task,
            ]);
    }
}