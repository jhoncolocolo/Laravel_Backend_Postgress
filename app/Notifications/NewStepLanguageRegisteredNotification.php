<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\StepByLanguageOrFramework;

class NewStepLanguageRegisteredNotification extends Notification
{
    use Queueable;

    private $stepByLanguageOrFramework;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(StepByLanguageOrFramework $stepByLanguageOrFramework)
    {
        $this->stepByLanguageOrFramework = $stepByLanguageOrFramework;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Hi a new Language Or Framework Step had been registered.')
                    ->action('You Can see in this link', route('step_by_language_or_framework', $this->stepByLanguageOrFramework));
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
