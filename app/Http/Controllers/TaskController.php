<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        // 全てのフォルダを取得
        $folders = Folder::all();

        // 選ばれたフォルダを取得
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }
}
