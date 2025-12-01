<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use App\Notifications\DeadlineReminder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // --- CHECK DEADLINES ---
        $tasks = Task::where('user_id', $userId)
                     ->whereNotNull('due_date')
                     ->where('status', 'en cours')
                     ->get();

        foreach ($tasks as $task) {
            $due = Carbon::parse($task->due_date);
            $now = Carbon::now();

            if (!$task->is_notified && $due->diffInDays($now) <= 1 && $now->lessThanOrEqualTo($due)) {
                $user->notify(new DeadlineReminder($task));

                $task->is_notified = true;
                $task->save();
            }
        }

        // STATS
        $total = Task::where('user_id', $userId)->count();
        $completed = Task::where('user_id', $userId)->where('status', 'terminée')->count();
        $pending = Task::where('user_id', $userId)->where('status', 'en cours')->count();

        // LOAD NOTIFICATIONS
        $notifications = $user->notifications()->take(5)->get();

        return view('dashboard.index', compact('total', 'completed', 'pending', 'notifications'));
    }
}
