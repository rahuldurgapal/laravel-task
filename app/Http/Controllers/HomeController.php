<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $tasks = Task::where('user_id',$user->id)->get();
        return view('dashboard',compact('tasks'));
    }
}
