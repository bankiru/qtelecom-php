<?php

namespace Bankiru\Sms\QtSms\DependencyInjection;

use Bankiru\Sms\QtSms\QtSms;
use Bankiru\Sms\QtSms\QtSmsTransport;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class QtSmsExtension extends Extension
{
    /** {@inheritdoc} */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $client = $container->register('qt_sms.client', QtSms::class);
        $client->setArguments(
            [
                $config['login'],
                $config['password'],
                $config['url'],
            ]
        );

        $transport = $container->register('qt_sms.transport', QtSmsTransport::class);
        $transport->setArguments(
            [
                $client,
                $config['sender'],
            ]
        );
    }
}
