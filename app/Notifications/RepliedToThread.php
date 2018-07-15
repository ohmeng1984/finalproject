<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RepliedToThread extends Notification
{
    use Queueable;

    public $thread;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread)
    {
        $this->thread=$thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return database
     */
    public function toDatabase($notifiable)
    {
        if (!auth()->user()) {
            return[
            'thread'=>$this->thread,
            'user'=>all()
            ];
        } else {
            return[
            'thread'=>$this->thread,
            'user'=>auth()->user()
            ];
        }

/*        return[
            'repliedTime'=>Carbon::now()

            if (!auth()->user()) {
            'thread'=>$this->thread,
            'user'=>all()
            } else {
            'thread'=>$this->thread,
            'user'=>auth()->user()
            }
        ];*/
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}
