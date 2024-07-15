<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
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
        return $this->tasks = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
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
        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->save();
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
    }







    public function asdadss()  {
        if ($a === true)
        {

        }

    }


}