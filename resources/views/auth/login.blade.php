@extends('layouts.app')

@section('content')

    <div class="max-w-md mx-auto bg-pink-100 p-8 rounded-2xl shadow-lg">

        <h2 class="text-3xl text-center font-bold text-pink-700 mb-6">Connexion 🌸</h2>

        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email" placeholder="Email"
                class="w-full mb-4 p-3 rounded-lg border border-pink-300 focus:ring focus:ring-pink-300">

            <input type="password" name="password" placeholder="Mot de passe"
                class="w-full mb-6 p-3 rounded-lg border border-pink-300 focus:ring focus:ring-pink-300">

            <button class="w-full bg-pink-500 text-white py-3 rounded-lg hover:bg-pink-600 transition">
                Se connecter
            </button>
        </form>

        <p class="mt-4 text-center">
            Pas encore inscrit ? <a href="/register" class="text-pink-600 font-bold">Créer un compte</a>
        </p>

    </div>
@endsection

