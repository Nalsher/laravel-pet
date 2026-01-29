<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index_id(Request $request, $id)
    {
        try {
            $user = $request->user();
            $tasks = Task::where("users_id", $user->id)->where("id", $id)->firstOrFail();
            $this->authorize('view', $tasks);
            return new TaskResource($tasks);

        } catch (Exception $ex) {
            return response(["error" => "somethin went wrong while getting tasks"], 400);
        }
    }

    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Task::class);
            $user = $request->user();
            $tasks = Task::where("users_id", $user->id)->paginate(10);
            return TaskResource::collection($tasks);

        } catch (Exception $ex) {
            return response(["error" => "somethin went wrong while getting tasks"], 400);
        }
    }

    public function update(Request $request, $id)
    {

        $tasks = Task::where("id", $id)->first();

        $this->authorize('update', $tasks);


        $tasks->text = $request->text;
        $tasks->img_url = $request->img_url;

        $tasks->save();

    }

    public function store(Request $request)
    {

        try {
            $task = new Task();

            $task->text = $request->text;
            $task->img_url = $request->img_url;

            $user = $request->user();

            $task->users_id = $user->id;

            $task->save();

            return $task->id;

        } catch (Exception $ex) {
            return response(["error" => "somethin went wrong while creating task"], 400);
        }
    }
}
