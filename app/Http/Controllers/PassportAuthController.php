<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'document_number_cpf' => 'required|min:11',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document_number_cpf' => $request->document_number_cpf,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Profile
     */
    public function profile()
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => auth()->user()->toArray()
        ], 200);
    }

    // Update a existing user
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        $updated = $user->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'User can not be updated'
            ], 500);
    }
}
