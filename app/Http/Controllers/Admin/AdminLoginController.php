<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\HandleAdminRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    use ResponseTrait;
    public function login(HandleAdminRequest $request)
    {
        // call request validated method
        $requestData = $request->validated();

        // now check $request->email method value is this is a email or this is a string
        $column_type = "username";
        if(filter_var($requestData['email'], FILTER_VALIDATE_EMAIL)) {
            $column_type = "email";
        }

        // Check the request if the valid user email
        $user = User::where($column_type, $requestData['email'])->first();

        if (! $user) {
            return $this->responseError([], 'No user found.');
        }

        // Check the password
        if (Hash::check($requestData['password'], $user->password)) {
            $tokenCreated = $user->createToken('authToken');

            $data = [
                'user'         => $user,
                'access_token' => $tokenCreated->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse($tokenCreated->token->expires_at)->toDateTimeString()
            ];

            return $this->responseSuccess($data, 'Logged in successfully.');
        }
    }
}
