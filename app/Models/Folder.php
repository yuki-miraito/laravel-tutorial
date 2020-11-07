<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public function tasks()
    {
        /**
         * return $this->hasMany('App\Models\Task, 'folder_id', 'id');
         * 第一引数：関連数モデル名
         * 第二引数：関連するテーブルが持つ外部キーカラム名
         * 第三引数：モデルにhasManyが定義されている側のテーブルが持つ外部キーに紐づけられたカラム名
         *
         * 二引数が「テーブル名単数形_id」で第三引数が「id」であれば省略が可能
         */

        return $this->hasMany('App\Models\Task');
    }
}
