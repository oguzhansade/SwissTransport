<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WhatsApp\Component;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTemplate;

class MovieTicketPaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsapp()
    {
        return WhatsAppTemplate::create()
            ->name('sample_movie_ticket_confirmation') // Name of your configured template
            ->header(Component::image('https://lumiere-a.akamaihd.net/v1/images/image_c671e2ee.jpeg'))
            ->body(Component::text('Star Wars'))
            ->body(Component::dateTime(new \DateTimeImmutable))
            ->body(Component::text('Star Wars'))
            ->body(Component::text('5'))
            ->to('905449757797');
    }
}
