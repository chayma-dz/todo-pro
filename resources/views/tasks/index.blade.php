@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-10">

    <h2 class="text-4xl font-bold text-pink-700 mb-6 text-center">
        🌸 Mes Tâches
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 py-2 px-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM AJOUT TACHE -->
    <div class="bg-white p-6 rounded-2xl shadow-lg mb-10 border border-pink-200">
        <h3 class="text-xl font-semibold mb-4 text-pink-700">Ajouter une tâche</h3>

        <form action="/tasks" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <input type="text" name="title" placeholder="Titre"
                class="p-3 rounded-lg border border-pink-300">

            <input type="text" name="category" placeholder="Catégorie (Travail, Maison...)"
                class="p-3 rounded-lg border border-pink-300">

            <select name="priority"
                class="p-3 rounded-lg border border-pink-300">
                <option value="low">Faible</option>
                <option value="medium">Moyenne</option>
                <option value="high">Haute</option>
            </select>

            <input type="date" name="due_date"
                class="p-3 rounded-lg border border-pink-300">

            <textarea name="description" placeholder="Description (optionnel)"
                class="p-3 rounded-lg border border-pink-300 md:col-span-2"></textarea>

            <button class="md:col-span-2 bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg transition">
                ➕ Ajouter
            </button>
        </form>
    </div>

    <!-- FILTRES -->
    <form method="GET" action="/tasks" class="mb-10 bg-pink-100 p-4 rounded-xl shadow flex flex-wrap gap-4">

        <input type="text" name="search" placeholder="🔍 Recherche..."
            class="p-3 rounded-lg border border-pink-300">

        <select name="priority" class="p-3 rounded-lg border border-pink-300">
            <option value="">Priorité</option>
            <option value="low">Faible</option>
            <option value="medium">Moyenne</option>
            <option value="high">Haute</option>
        </select>

        <select name="status" class="p-3 rounded-lg border border-pink-300">
            <option value="">Statut</option>
            <option value="not_done">Non fait</option>
            <option value="done">Terminé</option>
        </select>

        <select name="category" class="p-3 rounded-lg border border-pink-300">
            <option value="">Catégorie</option>
            <option value="Travail">Travail</option>
            <option value="Maison">Maison</option>
            <option value="École">École</option>
            <option value="Sport">Sport</option>
            <option value="Courses">Courses</option>
            <option value="Personnel">Personnel</option>
        </select>

        <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg">
            Filtrer
        </button>

    </form>

    <!-- LISTE DES TACHES -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($tasks as $task)
            <div class="bg-white p-6 rounded-2xl shadow border border-pink-200 relative">

                @if($task->pinned)
                    <span class="absolute top-3 right-3 text-yellow-500 text-2xl">📌</span>
                @endif

                <h3 class="text-2xl font-semibold 
                        {{ $task->status === 'terminée' ? 'line-through text-gray-400' : 'text-pink-700' }}">
                    {{ $task->title }}
                </h3>

                <p class="mt-2 text-gray-600">
                    {{ $task->description }}
                </p>

                <!-- Infos -->
                <div class="mt-4 flex flex-wrap gap-2">

                    @if($task->priority === 'high')
                        <span class="bg-red-200 text-red-700 px-3 py-1 rounded-full text-sm">Haute</span>
                    @elseif($task->priority === 'medium')
                        <span class="bg-yellow-200 text-yellow-700 px-3 py-1 rounded-full text-sm">Moyenne</span>
                    @else
                        <span class="bg-green-200 text-green-700 px-3 py-1 rounded-full text-sm">Faible</span>
                    @endif

                    @if($task->category)
                        <span class="bg-blue-200 text-blue-700 px-3 py-1 rounded-full text-sm">
                            {{ $task->category }}
                        </span>
                    @endif

                    @if($task->due_date)
                        <span class="bg-purple-200 text-purple-700 px-3 py-1 rounded-full text-sm">
                            ⏳ {{ $task->due_date }}
                        </span>
                    @endif

                </div>

                <div class="mt-6 flex justify-between">

                    <a href="/tasks/toggle/{{ $task->id }}"
                       class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg">
                        {{ $task->status === 'terminée' ? 'Annuler' : 'Terminer' }}
                    </a>

                    <a href="/tasks/pin/{{ $task->id }}"
                       class="text-white bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-lg">
                        📌
                    </a>

                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                            🗑️
                        </button>
                    </form>

                </div>

            </div>

        @empty
            <p class="text-center text-gray-500 w-full">Aucune tâche trouvée 🌸</p>
        @endforelse

    </div>

</div>

@endsection
