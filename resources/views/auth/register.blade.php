@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-pink-100 p-8 rounded-2xl shadow-lg">

    <h2 class="text-3xl text-center font-bold text-pink-700 mb-6">Créer un compte 🌸</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="/register" method="POST" enctype="multipart/form-data">
    @csrf


        <input type="text" name="name" placeholder="Nom complet"
               value="{{ old('name') }}"
               class="w-full mb-4 p-3 rounded-lg border border-pink-300">

        <input type="email" name="email" placeholder="Email"
               value="{{ old('email') }}"
               class="w-full mb-4 p-3 rounded-lg border border-pink-300">

        <input type="password" name="password" placeholder="Mot de passe"
               class="w-full mb-4 p-3 rounded-lg border border-pink-300">

        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe"
               class="w-full mb-4 p-3 rounded-lg border border-pink-300">

        <button class="w-full bg-pink-500 text-white py-3 rounded-lg hover:bg-pink-600 transition">
            S'inscrire
        </button>
    </form>

    <p class="mt-4 text-center">
        Déjà un compte ? <a href="/login" class="text-pink-600 font-bold">Se connecter</a>
    </p>

</div>

@endsection
