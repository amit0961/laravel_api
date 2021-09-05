<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register to Register with validation
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input_fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'

            ]);
            
            $user = User::create([
                'name' => $input_fields['name'],
                'email' => $input_fields['email'],
                'password' => $input_fields['password']
            ]);

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response , 201);
    }


    /**
     * Register to Login with validation
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $input_fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'

            ]);

            //Check Email
            $user = User::where('email',$input_fields['email'])->first();
            //Check Password
            if (!$user || ! $input_fields['password']) {
               return response([
                   'message'=>'Bad Request'
               ],401);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response , 201);
    }

    /**
     * For Logout Session
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return [
            'message' => 'Logged Out!!!'
        ] ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
