<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function addform()
    {
        return view('task.components.addForm');
    }

    public function store(Request $request)
    {
        
    }
}
