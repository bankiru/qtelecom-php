<?php

namespace Bankiru\Sms\QtSms\Tests;

use Bankiru\Sms\QtSms\QtSms;

final class QtSmsTest extends \PHPUnit_Framework_TestCase
{
    public function testQtSmsInstantiation()
    {
        new QtSms('user', 'pass', 'http://localhost/');
    }
}
