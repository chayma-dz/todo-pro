<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // -------------------------------
    // LISTE DES TACHES
    // -------------------------------
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->status == 'done') {
            $query->where('status', 'terminée');
        } elseif ($request->status == 'not_done') {
            $query->where('status', 'en cours');
        }

        if ($request->search) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $tasks = $query->orderByDesc('pinned')
                       ->orderBy('due_date', 'asc')
                       ->get();

        return view('tasks.index', compact('tasks'));
    }

    // -------------------------------
    // AJOUT TACHE
    // -------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'priority'   => 'required',
            'due_date'   => 'nullable|date'
        ]);

        Task::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
            'description' => $request->description,
            'status'      => 'en cours',
            'pinned'      => false,
        ]);

        return back()->with('success', 'Tâche ajoutée 🌸');
    }

    // -------------------------------
    // COMPLETER / DECOMPLETER
    // -------------------------------
    public function toggle(Task $task)
    {
        $this->authorize('update', $task);

        $task->status = $task->status === 'terminée'
                        ? 'en cours'
                        : 'terminée';

        $task->save();

        return back()->with('success', 'Statut mis à jour 🌸');
    }

    // -------------------------------
    // EPINGLER
    // -------------------------------
    public function pin(Task $task)
    {
        $this->authorize('update', $task);

        $task->pinned = !$task->pinned;
        $task->save();

        return back();
    }

    // -------------------------------
    // SUPPRESSION
    // -------------------------------
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return back()->with('success', 'Tâche supprimée 🗑️');
    }

    // -------------------------------
    // CALENDRIER
    // -------------------------------
   public function calendar()
{
    $tasks = Task::where('user_id', auth()->id())
        ->whereNotNull('due_date')
        ->get();

    // تحويل المهام إلى Events باش يستعملهم FullCalendar
    $events = [];

    foreach ($tasks as $task) {
        $events[] = [
            'title' => $task->title,
            'start' => $task->due_date,
            'color' => $task->status === 'terminée' ? '#9CCC65' : '#F06292',
        ];
    }

    return view('calendar.index', compact('events'));
}

    }

