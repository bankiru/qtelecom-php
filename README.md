# Quick-Telecom SMS 
PHP bindings for QuickTelecom SMS gateway

## Installation

```sh
composer require bankiru/qtelecom-sms
```

## Usage

### Standalone

```php
<?php

use Bankiru\Sms\QtSms\QtSms;
use Bankiru\Sms\QtSms\QtSmsTransport;
use ScayTrase\SmsDeliveryBundle\Service\ShortMessageInterface;

class MySms implements  ShortMessageInterface {
    /* ... */
}

$transport = new QtSmsTransport(
    new QtSms('user', 'pass', 'http://qtsms/'),
    'friendly_man'
);
$transport->send(new MySms('1234567890', 'message body'));
```

### Symfony

Register bundle to the kernel

```php
class AppKernel extends Kernel {
    public function registerBundles() {
        return [
            //...
            new \ScayTrase\SmsDeliveryBundle\SmsDeliveryBundle();
            new \Bankiru\Sms\QtSms\QtSmsBundle(),
            //...
        ];
    }
}
```

Configure the sender

```yaml
sms_delivery:
  transport: qt_sms.transport

qt_sms:
    login: user
    password: pass
    url: http://qtsms
    sender: friendly_man
```

Send SMS

```php
class MyController extends Controller {
    public function sendAction() {
        $this->get('sms_delivery.sender')->spoolMessage(new MySms('1234567890', 'message body'));
    }
}
```
