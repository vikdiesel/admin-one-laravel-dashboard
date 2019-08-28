<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrentUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get current user's profile
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( Request $request ) {
        $user = $request->user();

        $user->load('file');
        $user->append('avatar');

        return response()->json([
            'data' => $request->user()
        ]);
    }

    /**
     * Update current user's profile
     *
     * @param ProfileUpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( ProfileUpdateRequest $request ) {
        $user = $request->user();

        $user->fill($request->only(['name','email']));

        if (filled($request->file_id)) {
            $user->file_id = $request->file_id;
        }

        $user->save();

        $user->load('file');
        $user->append('avatar');

        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update current user's password
     *
     * @param PasswordUpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword( PasswordUpdateRequest $request ) {
        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => true
        ]);
    }
}
