<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Bienvenido al gestor de tareas</h1>
                    {{ Auth::user()->name }}

                    <div class="bg-amber-950 p-4 rounded text-white mb-6 text-center">
                        <h1>Componente de contador</h1>
                        @livewire('counter-component', ['tasks' => $tasks], key(time()))
                    </div>
                    @livewire('task-component', ['tasks' => $tasks], key(time()))

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
