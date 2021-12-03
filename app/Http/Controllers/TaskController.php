<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //CREATE TASK
    public function create(Request $request)
    {
        //Validation 422 si erreur
        $request->validate([
            'body' => 'required',
            'completed' => 'required',
        ]);

        //Creation de la tache
        $task = Task::create([
            'body' => $request->body,
            'completed' => $request->completed,
            'user_id' => $request->user()->id
        ]);

        //RETURN 200 CRÉÉ, RENVOIT LA TACHE
        return response()->json([
            'task' => $task,
        ], 200);

    }
}
