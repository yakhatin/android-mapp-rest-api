<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function auth(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = $this->model->where('user_name', $request->name)->first();

        if ($user == null) {
            $this->sendError('Пользователь не найден', 401, []);
        } else if (!Hash::check($request->password, $user->user_password)) {
            $this->sendError('Имя или пароль пользователя были введны неверно', 401, []);
        } else {
            $token = $user->createToken('admin')->plainTextToken;
            $this->sendResponse(["token" => $token], 'Авторизация прошла успешно', 200);
        }
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [
                'user_name' => $request->name,
                'user_email' => $request->email,
                'user_password' => Hash::make($request->password),
                'user_type_id' => 1
            ];

            $this->model->fill($data)->push();

            return $this->sendResponse($validated, 'Пользователь успешно зарегистрирован', 201);
        }

        return $this->sendResponse([], 'Регистрация временно недоступна', 403);
    }
}