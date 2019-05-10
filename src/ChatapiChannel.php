<?php
namespace NotificationChannels\Chatapi;

use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;
use NotificationChannels\Chatapi\Exceptions\CouldNotSendNotification;

class ChatapiChannel
{
    /**
     * @var Chatapi
     */
    protected $chatapi;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * ChatapiChannel constructor.
     *
     * @param Chatapi     $chatapi
     * @param Dispatcher $events
     */
    public function __construct(Chatapi $chatapi, Dispatcher $events)
    {
        $this->chatapi = $chatapi;
        $this->events  = $events;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed                                  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return mixed
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            $to      = $this->getTo($notifiable);
            $message = $notification->toChatapi($notifiable);
            if (is_string($message)) {
                $message = new ChatapiMessage($message);
            }
            if (!$message instanceof ChatapiMessage) {
                throw CouldNotSendNotification::invalidMessageObject($message);
            }

            return $this->chatapi->sendMessage($message, $to);
        } catch (Exception $exception) {
            $this->events->fire(
                new NotificationFailed($notifiable, $notification, 'chatapi', ['message' => $exception->getMessage()])
            );
        }
    }

    /**
     * Get the address to send a notification to.
     *
     * @param mixed $notifiable
     * @return mixed
     * @throws CouldNotSendNotification
     */
    protected function getTo($notifiable)
    {
        if ($notifiable->routeNotificationFor('chatapi')) {
            return $notifiable->routeNotificationFor('chatapi');
        }
        if (isset($notifiable->celular)) {
            return $notifiable->celular;
        }
        throw CouldNotSendNotification::invalidReceiver();
    }

    /**
     * Get the alphanumeric sender.
     *
     * @param $notifiable
     * @return mixed|null
     * @throws CouldNotSendNotification
     */
    protected function canReceiveAlphanumericSender($notifiable)
    {
        return false;
    }
}
