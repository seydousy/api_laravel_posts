<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(RegisterUser $request)
    {
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status_code'=>200,
                'status_message'=> 'Utilisateur enregistre avec succes',
                'data'=>$user
          ]);
        }catch(Exception $e){
            return response()->json($e);
        }
    }


    public function login(LoginUserRequest $request)
    {
        if(auth()->attempt($request->only(['email','password']))){
            $user = auth()->user();
            $token = $user->createToken('MA_CLE_SECRETE_VISIBLE_ONLY_AU_BACKEND')->plainTextToken;

            return response()->json([
                'status_code'=>200,
                'status_message'=> 'Utilisateur connecte',
                'user'=>$user,
                'token'=>$token
          ]);
        }else{
        return response()->json([
                'status_code'=>403,
                'status_message'=> 'Information non valide',
          ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
