<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $taskId;
    public $title;
    public $description;
    public $deleteConfirm = false;
    public $addNew = false;
    public $updatedTasks = false;

    public function mount()
    {
        $this->tasks = $this->getTasks();
    }

    public function getTasks()
    {
        $user = Auth::user();
        $this->tasks = $user->sharedTasks()->orderBy('created_at', 'desc')->get();
        return $this->tasks;
    }

    public function renderAllTasks()
    {
        $tasks = Cache::remember('user_' . Auth::id() . '_tasks', now()->addSeconds(60), function () {
            return Auth::user()->sharedTasks()->orderBy('created_at', 'desc')->get();
        });
        return $this->getTasks();
    }

    public function updatedTasks()
    {
        $this->getTasks();
        $this->addNew = false;
        $this->deleteConfirm = false;
    }

    public function render()
    {
        return view('livewire.task-component')->layoutData(['listen' => 'updatedTasks']);
    }

    public function clearFields()
    {
        $this->title = '';
        $this->description = '';
    }

    public function addTask()
    {
        $this->addNew = true;
    }

    public function createTask()
    {
        DB::transaction(function () {
            $task = new Task();
            $task->title = $this->title;
            $task->description = $this->description;
            $task->save();
            $task->sharedWith()->attach(Auth::user()->id, ['permission' => 'edit']);
        });
        $this->addNew = false;
        $this->clearFields();
        $this->getTasks();
        $this->reset(['addNew', 'deleteConfirm']);
    }

    public function editTask(int $id): void
    {
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->addNew = false;
        $this->deleteConfirm = false;
        $this->updatedTasks = true;
    }

    public function updateTask()
    {
        $task = Task::find($this->taskId);
        $task->title = $this->title;
        $task->description = $this->description;
        $task->save();
        $this->clearFields();
        $this->getTasks();
        $this->reset(['updatedTasks']);
        $this->addNew = false;
        $this->deleteConfirm = false;
        $this->updatedTasks = false;
    }

    public function deleteTask(int $id): void
    {
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->deleteConfirm = true;
        $this->addNew = false;
    }

    public function confirmDeleteTask()
    {
        $task = Task::find($this->taskId);
        $task->delete();
        $this->getTasks();
        $this->clearFields();
        $this->reset(['deleteConfirm']);
        $this->addNew = false;
        $this->deleteConfirm = false;
        $this->updatedTasks = false;
    }
}
