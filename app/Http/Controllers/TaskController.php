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


    //FUNCTION DELETE TASK ID
    public function delete(Request $request, $id){

        //401 UNAUTHENTICATED GÉRÉ PAR SANCTUM

        //On recup la tache
        $ifTaskExists = Task::where('id', $id)->exists();

        //CHECK IF EXIST 404
        if(!$ifTaskExists){
            return response()->json([
                'errors' => "La tâche n'existe pas."
            ], 404);
        }

        $task = Task::where('id', $id)->first();

        //CHECK IF USER CAN DELETE THAT TASK 403
        if($task->user_id !== $request->user()->id){
            return response()->json([
                'errors' => "Accès à la tâche non autorisé."
            ], 403);
        }

        //DELETE DE LA TASK 200
        Task::where('id', $id)->first()->delete();

        return response()->json([
            'id' => $task->id,
            'created_at' => $task->created_at,
            'updated_at' => $task->updated_at,
            'body' => $task->body,
            'completed' => $task->completed,
            'user' => Auth()->user()
        ], 200);

    }
}
