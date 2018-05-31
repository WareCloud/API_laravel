<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use Notifiable;

    private $webhookURL;

    public function setWebhookURL($webhookURL)
    {
        $this->webhookURL = $webhookURL;
    }

    // Specify Slack Webhook URL to route notifications to
    public function routeNotificationForSlack()
    {
        return $this->webhookURL;
    }
}
