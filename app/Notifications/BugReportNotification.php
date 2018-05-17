<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class BugReportNotification extends Notification
{
    use Queueable;

    private $bugReport;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bugReport, $user)
    {
        $this->bugReport = $bugReport;
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
        $bugReport = $this->bugReport;
        $user = $this->user;

        return (new SlackMessage())
                    ->from(ENV('SLACK_WEBHOOK_NAME'))
                    ->image(url(ENV('SLACK_WEBHOOK_ICON')))
                    ->to(ENV('SLACK_WEBHOOK_BUGREPORT_CHANNEL'))
                    ->error()
                    ->content('A new bug has been submitted')
                    ->attachment(function ($attachment) use ($bugReport, $user) {
                        $attachment->title('Bug Report')
                                   ->fields([
                                        'User'          => $user->login,
                                        'Title'         => $bugReport->title,
                                        'Description'   => $bugReport->description
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
