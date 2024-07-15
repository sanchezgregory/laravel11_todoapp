<div>
    <h1>Tareas de {{ Auth::user()->name }} Cantidad de tareas: {{ Auth::user()->sharedTasks()->count() }} </h1>

    <div x-data="{ open: false }">
        <div class="block w-full overflow-x-auto">

            {{-- Modal--}}
            <div class="flex justify-center items-center">


                <!-- Open modal button -->
                <div class="bg-gray-100 rounded ">
                    <button x-on:click="open = true" wire:click="addTask"
                            class="px-4 py-2 bg-indigo-500 text-white rounded-md"> New Task
                    </button>
                </div>
                <!-- Modal Overlay -->
                <div x-show="open" class="fixed inset-0 px-2 z-10 overflow-hidden flex items-center justify-center">
                    <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300"
                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition-opacity ease-in duration-300"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <!-- Modal Content -->
                    <div x-show="open" x-transition:enter="transition-transform ease-out duration-300"
                         x-transition:enter-start="transform scale-75" x-transition:enter-end="transform scale-100"
                         x-transition:leave="transition-transform ease-in duration-300"
                         x-transition:leave-start="transform scale-100" x-transition:leave-end="transform scale-75"
                         class="bg-white rounded-md shadow-xl overflow-hidden max-w-md w-full sm:w-96 md:w-1/2 lg:w-2/3 xl:w-1/3 z-50">
                        <!-- Modal Header -->
                        <div class="bg-indigo-500 text-white px-4 py-2 flex justify-between">
                            <h2 class="text-lg font-semibold">Nueva tarea</h2>
                        </div>
                        <!-- Modal Body -->
                        <div class="p-4">
                            <from>
                                <div class="mb-4">
                                    <label for="title">Title</label><br>
                                    <input id='title' wire:model='title'
                                           class="bg-gray-100 border border-gray-50 dark:text-gray-900" type="text"
                                           name="title" placeholder="Title task" @updated="updatedTasks">
                                </div>
                                <div class="mb-4">
                                    <label for="descript">Description</label><br>
                                    <input id="descript" wire:model="description"
                                           class="bg-gray-100 border border-gray-50 dark:text-gray-900" type="text"
                                           name="title" placeholder="Description task" @updated="updatedTasks">
                                </div>
                            </from>
                        </div>
                        <!-- Modal Footer -->
                        <div class="border-t px-4 py-2 flex justify-end">
                            @if($addNew)
                                <button x-on:click="open = false"
                                        class="px-3 py-1 bg-indigo-500 text-white  rounded-md w-full sm:w-auto"
                                        wire:click.prevent="createTask">Create task
                                </button>
                            @endif
                            @if($deleteConfirm)
                                <button x-on:click="open = false"
                                        class="px-3 py-1 bg-indigo-500 text-white  rounded-md w-full sm:w-auto"
                                        wire:click.prevent="confirmDeleteTask"> Delete task
                                </button>
                            @endif
                            @if($updatedTasks)
                                <button x-on:click="open = false"
                                        class="px-3 py-1 bg-indigo-500 text-white  rounded-md w-full sm:w-auto"
                                        wire:click.prevent="updateTask"> Update task
                                </button>
                            @endif
                            <button x-on:click="open = false"
                                    class="px-3 py-1 bg-red-500 text-white  rounded-md w-full sm:w-auto"
                                    wire:click.prevent="clearFields">Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="items-center bg-transparent w-full border-collapse mt-5">
                <thead>
                <tr>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Tasks name
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Description
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Date creation
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                            {{ $task->title }}
                        </th>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                            {{ $task->description }}
                        </td>
                        <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ $task->created_at }}
                        </td>
                        <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <button class="text-blue-500 hover:text-blue-800 mr-2" x-on:click="open = true"
                                    wire:click="editTask({{ $task->id }})">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="text-red-500 hover:text-red-800" x-on:click="open = true" wire:confirm="Do you really want to delete this task?"
                                    wire:click="deleteTask({{ $task->id }})">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
    </div>

</div>
