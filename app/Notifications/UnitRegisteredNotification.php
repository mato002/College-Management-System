<?php

namespace App\Notifications;

use App\Models\Unit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnitRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Unit $unit,
        public string $semester
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "You have been successfully enrolled in {$this->unit->code} — {$this->unit->name}.",
            'unit_id' => $this->unit->id,
            'unit_code' => $this->unit->code,
            'semester' => $this->semester,
            'action_url' => route('student.my-units.index'),
        ];
    }
}
