<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new Users();
    }

    public function index()
    {
        $usersFetch =
            $this
                ->usersRepository
                ->all();

        if ($usersFetch->hasError()) {
            return response()->json($usersFetch->getItems(), 500);
        }

        return response()->json($usersFetch->getItems(), 200);
    }

    public function store(Request $request)
    {
        $usersStore =
            $this
                ->usersRepository
                ->store($request->all());

        if ($usersStore->hasError()) {
            return response()->json($usersStore->getItems(), 500);
        }

        return response()->json($usersStore->getItems(), 201);
    }

    public function show($id)
    {
        $userFetch =
            $this
                ->usersRepository
                ->show($id);

        if ($userFetch->hasError()) {
            return response()->json($userFetch->getItems(), 500);
        }

        return response()->json($userFetch->getItems(), 200);
    }

    public function update($id, Request $request)
    {
        $userUpdate =
            $this
                ->usersRepository
                ->update($id, $request->all());

        if ($userUpdate->hasError()) {
            return response()->json($userUpdate->getItems(), 500);
        }

        return response()->json($userUpdate->getItems(), 200);
    }

    public function delete($id)
    {
        $userDelete =
            $this
                ->usersRepository
                ->delete($id);

        if ($userDelete->hasError()) {
            return response()->json($userDelete->getItems(), 500);
        }

        return response()->json($userDelete->getItems(), 200);
    }
}
