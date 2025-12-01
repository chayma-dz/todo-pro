<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyTodo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-pink-50">

<div class="flex">

    <!-- 🌸 SIDEBAR — يظهر فقط بعد تسجيل الدخول -->
    @auth
    <aside class="w-64 h-screen bg-white shadow-md border-r border-pink-200 fixed top-0 left-0 flex flex-col">

        <!-- Logo -->
        <div class="px-6 py-6 text-3xl font-bold text-pink-600 flex items-center gap-2 border-b border-pink-100">
            🌸 MyTodo
        </div>

        <!-- Links -->
        <nav class="flex-1 px-4 py-6 space-y-4 text-pink-700 font-medium text-lg">

            <a href="/dashboard"
               class="block px-4 py-2 rounded-lg hover:bg-pink-100 hover:text-pink-600">
               📊 Dashboard
            </a>

            <a href="/tasks"
               class="block px-4 py-2 rounded-lg hover:bg-pink-100 hover:text-pink-600">
               🗂️ Mes Tâches
            </a>
            <a href="/calendar"
   class="block px-4 py-2 rounded-lg hover:bg-pink-100 hover:text-pink-600">
   📅 Calendrier
</a>

            <a href="/notifications"
   class="block px-4 py-2 rounded-lg hover:bg-pink-100 hover:text-pink-600 flex justify-between items-center">

   🔔 Notifications

   @if(Auth::user()->unreadNotifications->count() > 0)
       <span class="text-white bg-pink-500 px-2 py-1 rounded-full text-xs">
           {{ Auth::user()->unreadNotifications->count() }}
       </span>
   @endif
</a>


            <a href="/profile"
               class="block px-4 py-2 rounded-lg hover:bg-pink-100 hover:text-pink-600">
               👤 Profil
            </a>
        </nav>

        <!-- User info -->
        <div class="px-4 py-4 border-t border-pink-100">
            <p class="font-semibold text-pink-700 text-sm">{{ Auth::user()->name }}</p>
            <p class="text-gray-500 text-xs mb-3">{{ Auth::user()->email }}</p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100">
                    🚪 Logout
                </button>
            </form>
             

        </div>

    </aside>
    @endauth

    <!-- 🌸 PAGE CONTENT -->
    <main class="@auth ml-64 @endauth w-full p-10">
        @yield('content')
    </main>

</div>

</body>
</html>
