<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = $this->model->where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $this->sendError('Имя или пароль пользователя были введны неверно.', 401, []);
        } else {
            $token = $user->createToken('admin')->plainTextToken;
            $this->sendResponse(["token" => $token], 'Авторизация прошла успешно.', 200);
        }
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 1
            ];

            $this->model->fill($data)->push();

            return $this->sendResponse($validated, 'Пользователь успешно зарегистрирован.', 201);
        }

        return $this->sendResponse([], 'Регистрация временно недоступна.', 403);
    }
}