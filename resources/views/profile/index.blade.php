@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow border border-pink-200">

    <h2 class="text-center text-3xl font-bold text-pink-600 mb-6">
        💖 Mon Profil
    </h2>

  

    <!-- Form informations -->
    <form method="POST" action="/profile/update">
        @csrf

        <label>Nom</label>
        <input type="text" name="name" value="{{ $user->name }}"
               class="p-3 w-full border mb-4 border-pink-300 rounded-lg">

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}"
               class="p-3 w-full border border-pink-300 rounded-lg mb-4">

        <button class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg">
            ✨ Mettre à jour
        </button>
    </form>
    <hr class="my-6">

    <h3 class="text-pink-600 font-semibold mb-3">Changer le mot de passe</h3>

    <form method="POST" action="/profile/password">
        @csrf

        <input type="password" name="current_password" placeholder="Mot de passe actuel"
               class="p-3 w-full border border-pink-300 rounded-lg mb-4">

        <input type="password" name="new_password" placeholder="Nouveau mot de passe"
               class="p-3 w-full border border-pink-300 rounded-lg mb-4">

        <input type="password" name="new_password_confirmation"
               placeholder="Confirmer mot de passe"
               class="p-3 w-full border border-pink-300 rounded-lg mb-4">

        <button class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg">
            🔒 Changer mot de passe
        </button>
    </form>

</div>

@endsection
