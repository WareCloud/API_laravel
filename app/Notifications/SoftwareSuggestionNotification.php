<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class SoftwareSuggestionNotification extends Notification
{
    use Queueable;

    private $suggestion;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($suggestion, $user)
    {
        $this->suggestion = $suggestion;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        $suggestion = $this->suggestion;
        $user = $this->user;

        return (new SlackMessage())
                    ->from(ENV('SLACK_WEBHOOK_NAME'))
                    ->image(url(ENV('SLACK_WEBHOOK_ICON')))
                    ->to(ENV('SLACK_WEBHOOK_SOFTWARESUGGESTION_CHANNEL'))
                    ->success()
                    ->content('A new software suggestion has been submitted')
                    ->attachment(function ($attachment) use ($suggestion, $user) {
                        $attachment->title('Software Suggestion')
                                   ->fields([
                                        'User'      => $user->login,
                                        'Name'      => $suggestion->name,
                                        'Website'   => $suggestion->website
                    ]);
            });
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
