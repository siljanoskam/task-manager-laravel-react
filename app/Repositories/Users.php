<?php

namespace App\Repositories;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Log;

class Users extends Repository
{
    public function all(): Repository
    {
        try {
            $users = User::all();
            $usersList = UserResource::collection($users);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the users from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($usersList ?? []);
    }

    public function store($data): Repository
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['email'])
            ]);
            $singleItem = new UserResource($user);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while storing the user into the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($singleItem ?? []);
    }

    public function show($id): Repository
    {
        try {
            $user = User::find($id);
            $singleItem = new UserResource($user);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the user into the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($singleItem ?? []);
    }

    public function update($id, $data): Repository
    {
        try {
            $user =
                $this
                    ->show($id)
                    ->getItems();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $singleItem = new UserResource($user);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while updating the user into the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($singleItem ?? []);
    }

    public function delete($id): Repository
    {
        try {
            $user =
                $this
                    ->show($id)
                    ->getItems();
            $user->delete();
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the user into the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false);
    }
}
