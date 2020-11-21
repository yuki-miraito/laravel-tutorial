<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧
     *
     * GET /folders/{folder}/tasks
     *
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダに紐づくタスクを取得
        $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成ページ
     *
     * GET /folders/{folder}/tasks/create
     *
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id
        ]);
    }

    /**
     * タスク作成
     *
     * POST /folders/{folder}/tasks/create
     *
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\View\View
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     * タスク編集ページ
     *
     * GET /folders/{folder}/tasks/{task}/edit
     *
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task
        ]);
    }

    /**
     * タスク編集
     *
     * POST /folders/{folder}/tasks/{task}/edit
     *
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\View\View
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
