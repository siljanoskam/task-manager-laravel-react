<?php

namespace App\Repositories;

use App\Task;
use App\Http\Resources\Task as TaskResource;
use Illuminate\Support\Facades\Log;

class Tasks extends Repository
{
    public function all(): Repository
    {
        try {
            $tasks = Task::all();
            $tasksList = TaskResource::collection($tasks);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tasks from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($tasksList ?? []);
    }

    public function store($data): Repository
    {
        try {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'date' => $data['date']
            ]);
            $singleItem = new TaskResource($task);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while storing the task into the database',
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
            $task = Task::find($id);
            $singleItem = new TaskResource($task);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the task into the database',
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
            $task =
                $this
                    ->show($id)
                    ->getItems();
            $task->title = $data['title'];
            $task->description = $data['description'];
            $task->date = bcrypt($data['date']);
            $task->save();

            $singleItem = new TaskResource($task);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while updating the task into the database',
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
            $task =
                $this
                    ->show($id)
                    ->getItems();
            $task->delete();
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the task into the database',
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
