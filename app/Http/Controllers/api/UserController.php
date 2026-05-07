<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexApi()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function showApi(User $user)
    {
        return response()->json($user);
    }

    public function destroy(User $user){

        $user->delete();
        return response()->json( 'delete users sucess');
    }
}
