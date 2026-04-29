<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function showlogin()
    {
        return view('login');
    }

    public function register()
    {
        $validated = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'name' => 'required|string|max:255',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        Log :: debug('New user registered: ' . $validated['email']);
        return response()->json([
            'status' => 'success',
            'email' => $validated['email'],
        ]);
    }

    public function login()
    {
        $validated = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = Auth::attempt($validated);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
            ], 401);
        }
        $accessToken = Auth::user()->createToken('access-token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'email' => $validated['email'],
            'access_token' => $accessToken,
        ]);
    }

    public function logout()
    {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login')->with('success', 'Logout successful');

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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
