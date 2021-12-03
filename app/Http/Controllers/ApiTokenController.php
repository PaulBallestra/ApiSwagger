<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{

    /*-----AUTH-----*/
    //FUNCTION REGISTER
    public function register(Request $request)
    {
        //Validation 422 si erreur
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
        ]);

        //Check si l'user existe
        $exists = User::where('email', $request->email)->exists();

        //Si l'user existe 409
        if($exists){
            return response()->json(['errors' => "Utilisateur déjà inscrit"], 409);
        }

        //Sinon on le créé
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        //TOKEN CREATION
        $token = $user->createToken($request->email)->plainTextToken;

        //RETURN 201 OK
        return response()->json([
            'token' => $token
        ], 201);

    }

}
