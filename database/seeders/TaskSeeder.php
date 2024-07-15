<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task = new Task();
        $task->user_id = User::find(1)->id;
        $task->title = 'Task 1';
        $task->description = 'Description 1';
        $task->save();
        $task = new Task();
        $task->user_id = User::find(1)->id;
        $task->title = 'Task 2';
        $task->description = 'Description adad';
        $task->save();
        $task = new Task();
        $task->user_id = User::find(1)->id;
        $task->title = 'Task 3';
        $task->description = 'Description retvdss';
        $task->save();
        $task = new Task();
        $task->user_id = User::find(1)->id;
        $task->title = 'Task 4';
        $task->description = 'Description gjghjhg';
        $task->save();

    }
}
