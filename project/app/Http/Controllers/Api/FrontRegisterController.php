<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Http\Requests\Auth\Front\RegisterRequest;
use Illuminate\Http\JsonResponse;

class FrontRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * 会員 登録
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return response()->json(['message' => '成功'], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'self_pr' => $data['self_pr'],
            'tel' => $data['tel'],
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
