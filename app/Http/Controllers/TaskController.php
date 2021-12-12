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

    //FUNCTION UPDATE TASK ID
    public function update(Request $request, $id){

        //401 UNAUTHENTICATED GÉRÉ PAR SANCTUM

        //422 GÉRÉ PAR SANCTUM
        $request->validate([
            'body' => 'required',
            'completed' => 'required'
        ]);

        //On recup la tache
        $ifTaskExists = Task::where('id', $id)->exists();

        //CHECK IF EXIST 404
        if(!$ifTaskExists){
            return response()->json([
                'errors' => "La tâche n'existe pas."
            ], 404);
        }

        $task = Task::where('id', $id)->first();

        //CHECK IF USER CAN USE THAT TASK 403
        if($task->user_id !== $request->user()->id){
            return response()->json([
                'errors' => "Accès à la tâche non autorisé."
            ], 403);
        }

        //Update de la task
        $updatedTask = Task::find($id);

        $updatedTask->body = $request->body;
        $updatedTask->completed = $request->completed;

        $updatedTask->save();

        //STATUS 200 COOL
        return response()->json([
            'id' => $updatedTask->id,
            'created_at' => $updatedTask->created_at,
            'updated_at' => $updatedTask->updated_at,
            'body' => $updatedTask->body,
            'completed' => $updatedTask->completed,
            'user' => Auth()->user()
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

    //FUNCTION SHOW ALL TASK OF USER UPDATED_AT FIRST THEN CREATED_AT
    public function showAll(Request $request){

        //401 UNAUTHENTICATED GÉRÉ PAR SANCTUM

        $tasks = Task::where('user_id', Auth()->user()->id)->orderBy('updated_at', 'desc')->orderBy('created_at', 'asc')->get();

        return response()->json([
            'tasks' => $tasks
        ], 201);

    }
}
