<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_all_users()
    {
        try {
            $users = User::all();

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $users,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

    public function add_user(AddUserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            return ResponseHelper::Success(
                message: 'loaded Successfully',
                data: $user,
                statusCode: 200
            );

        } catch (Exception $e) {
            return ResponseHelper::Error(
                message: $e->getMessage(),
                statusCode: 500
            );
        }
    }

}
