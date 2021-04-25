<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

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
        $this->validate($request, [
            'name' => 'required|min:4'
        ]);

        // The critical data can't be modified
        unset($request['password'], $request['remember_token'], $request['email'], $request['document_number_cpf']);

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
            ], 201);
        else
            return response()->json([
                'success' => false,
                'message' => 'User can not be updated'
            ], 500);
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmNewPassword' => 'required|same:newPassword'
        ]);

        $user = User::find(auth()->user()->id);

        // echo auth()->user()->password."\n";

        // Validate if old password was correct
        if (!(Hash::check(request('oldPassword'), auth()->user()->password)) ) {
            return response()->json([
                'success' => false,
                'error' => 'Check your old password'
            ], 400);
        }

        // Validate if new password was modified
        if ((Hash::check(request('newPassword'), auth()->user()->password)) ) {
            return response()->json([
                'success' => false,
                'error' => 'Please enter a new password that not used before'
            ], 400);
        }

        // Validate if new and confirm password are the same, and validate the store new password
        if (request('newPassword') == request('confirmNewPassword')) {
            $updated = $user->fill(['password' => bcrypt(request('newPassword'))])->save();

            if ($updated)
                return response()->json([
                    'success' => true
                ], 200);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'User passoword can not be modified'
                ], 400);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'The new and confirm password are not the same'
            ], 400);
        }
    }

    public function logout() {
        $user = auth()->user()->token();

        if ($user) {
            $user->revoke();
        }
    }
}
