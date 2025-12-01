
@extends('layouts.app')

@section('content')


    <div class="max-w-5xl mx-auto mt-10 space-y-8">

        <h2 class="text-4xl font-bold text-pink-700 text-center mb-4">
            🌸 Tableau de bord
        </h2>

        <!-- Ligne de stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="bg-white rounded-2xl shadow p-4 border border-pink-200 text-center">
                <p class="text-sm text-gray-500">Total des tâches</p>
                <p class="text-3xl font-bold text-pink-700">{{ $total }}</p>
            </div>

            <div class="bg-green-50 rounded-2xl shadow p-4 border border-green-200 text-center">
                <p class="text-sm text-gray-500">Terminées</p>
                <p class="text-3xl font-bold text-green-600">{{ $completed }}</p>
            </div>

            <div class="bg-yellow-50 rounded-2xl shadow p-4 border border-yellow-200 text-center">
                <p class="text-sm text-gray-500">Non terminées</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
            </div>

            <div class="bg-red-50 rounded-2xl shadow p-4 border border-red-200 text-center">
                <p class="text-sm text-gray-500">En retard</p>
                <p class="text-3xl font-bold text-red-600">{{ $overdue ?? 0 }}</p>
            </div>

        </div>

        <!-- Milieu : chart + progression -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Donut chart -->
            <div class="bg-white rounded-2xl shadow p-6 border border-pink-200">
                <h3 class="text-xl font-semibold text-pink-700 mb-4">
                    Répartition des tâches
                </h3>
                <div id="tasksChart"></div>
            </div>

            <!-- Progression -->
            <div class="bg-white rounded-2xl shadow p-6 border border-pink-200 flex flex-col justify-center">
                <h3 class="text-xl font-semibold text-pink-700 mb-4">
                    Progression globale
                </h3>

                @php
                    $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;
                @endphp

                <p class="mb-2 text-gray-600">
                    {{ $completionRate }}% des tâches sont terminées.
                </p>

                <div class="w-full bg-pink-100 rounded-full h-4 overflow-hidden">
                    <div class="bg-pink-500 h-4 rounded-full"
                         style="width: {{ $completionRate }}%;"></div>
                </div>

                <div class="mt-4 flex gap-2 flex-wrap text-sm">
                    <span class="px-3 py-1 rounded-full bg-pink-100 text-pink-700">
                        Total : {{ $total }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                        Terminées : {{ $completed }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                        Non terminées : {{ $pending }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                        En retard : {{ $overdue ?? 0 }}
                    </span>
                </div>
            </div>

        </div>

        <!-- Bouton pour aller vers les tâches -->
        <div class="text-center">
            <a href="{{ route('tasks') }}"
               class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-full shadow">
                Voir mes tâches ✨
            </a>
        </div>

    </div>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [
                    {{ $completed }},
                    {{ $pending }},
                    {{ $overdue ?? 0 }}
                ],
                chart: {
                    type: 'donut',
                    height: 320
                },
                labels: ['Terminées', 'Non terminées', 'En retard'],
                colors: ['#ec4899', '#f97316', '#ef4444'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#tasksChart"), options);
            chart.render();
        });
    </script>

@endsection
