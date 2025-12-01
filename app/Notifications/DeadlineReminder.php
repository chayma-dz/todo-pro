<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeadlineReminder extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id'  => $this->task->id,
            'title'    => $this->task->title,
            'message'  => "La tâche '{$this->task->title}' approche de sa deadline.",
            'due_date' => $this->task->due_date
        ];
    }
}
