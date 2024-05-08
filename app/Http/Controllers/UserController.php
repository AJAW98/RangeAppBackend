<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request) : User
    {
        return $request->user();
    }

    public function update(UserRequest $request, User $user) : User
    {
        $user->update($request->validated());

        return $user;
    }

}
