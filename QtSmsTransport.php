<?php

namespace Bankiru\Sms\QtSms;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ScayTrase\SmsDeliveryBundle\Exception\DeliveryFailedException;
use ScayTrase\SmsDeliveryBundle\Service\ShortMessageInterface;
use ScayTrase\SmsDeliveryBundle\Transport\TransportInterface;

final class QtSmsTransport implements TransportInterface
{
    /** @var  QtSms */
    private $client;
    /** @var  string */
    private $sender;

    /**
     * QtSmsTransport constructor.
     *
     * @param QtSms           $client
     * @param string          $sender
     */
    public function __construct(QtSms $client, $sender)
    {
        $this->client = $client;
        $this->sender = $sender;
    }

    /** {@inheritdoc} */
    public function send(ShortMessageInterface $message)
    {
        try {
            $this->client->post_message($message->getBody(), $message->getRecipient(), $this->sender);
        } catch (\Exception $e) {
            throw new DeliveryFailedException($e->getMessage(), $e->getCode(), $e);
        }

        return true;
    }
}
