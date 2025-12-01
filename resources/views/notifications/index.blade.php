@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-pink-700 mb-6">🔔 Notifications</h2>

<!-- Effacer toutes -->
<form method="POST" action="{{ route('notifications.deleteAll') }}">
    @csrf
    <button class="px-4 py-2 bg-red-100 text-red-500 rounded">
        🗑️ Effacer toutes les notifications
    </button>
</form>


<div class="space-y-4">

    @forelse($notifications as $note)
        <div class="p-4 bg-white rounded-xl border border-pink-200 shadow flex justify-between">

            <div>
                <p class="font-semibold text-pink-700">{{ $note->data['title'] }}</p>
                <p class="text-gray-600">{{ $note->data['message'] }}</p>
                <p class="text-xs text-purple-600 mt-1">
                    Deadline : {{ $note->data['due_date'] }}
                </p>
            </div>

            @if(is_null($note->read_at))
                <form method="POST" action="{{ route('notifications.read', $note->id) }}">
                    @csrf
                    <button class="text-sm text-green-600 hover:underline">
                        ✔️ Marquer comme lue
                    </button>
                </form>
            @else
                <span class="text-sm text-gray-400">✔️ Déjà lue</span>
            @endif

        </div>

    @empty
        <p class="text-gray-500 text-lg">🌸 Aucune notification pour le moment</p>
    @endforelse

</div>

@endsection
