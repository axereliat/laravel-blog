<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Livewire\Component;

class NotificationsList extends Component
{
    public function render()
    {
        $notifications = Notification::where('owner_id', auth()->id())->get();

        return view('livewire.notifications-list', [
            'notifications' => $notifications
        ]);
    }

    public function markSeen(Notification $notification) {
        $notification->is_seen = 1;

        $notification->save();

        $this->redirect($notification->link);
    }
}
