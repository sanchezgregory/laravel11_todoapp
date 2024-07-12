<?php

namespace Database\Seeders;

use App\Models\Task;
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
        $task->user_id = 1;
        $task->title = 'Task 1';
        $task->description = 'Description 1';
        $task->save();

    }
}
