<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = User::query()->orderByDesc('id')->get();
        return Responder::success($user, 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (preg_match('/[^0-9]/', $id)) {
            return Responder::fail($id, 'id must be number');
        }
        if (!User::query()->where('id', $id)->exists()) {
            return Responder::fail($id, 'Not exist');
        }
        $user = User::query()
            ->where('id', $id)
            ->first();
        return Responder::success($user, 'Get successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUser $request)
    {
        $user = '';
        try {
            $user = User::create($request->all());
        } catch (Exception $e) {
            return Responder::fail($user, $e->getMessage());
        }
        return Responder::success($user, 'Store successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUser $request, $id)
    {
        $user = '';
        if (preg_match('/[^0-9]/', $id)) {
            return Responder::fail($id, 'id must be number');
        }
        if (!User::query()->where('id', $id)->exists()) {
            return Responder::fail($id, 'Not exist');
        }
        try {
            User::where('id', $id)
                ->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'phone_number' => $request->phone_number,
                    'gender' => $request->gender,
                ]);
        } catch (Exception $e) {
            return Responder::fail($user, $e->getMessage());
        }
        return Responder::success($user, 'Edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        if (preg_match('/[^0-9]/', $id)) {
            return Responder::fail($id, 'id is not number');
        }
        if (!User::query()->where('id', $id)->exists()) {
            return Responder::fail($id, 'Not exist');
        }
        $deleteUser = User::where('id', $id)->delete();
        return Responder::success($deleteUser, 'delete successfully');
    }
}
