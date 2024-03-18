<?php

use App\Strategy\Formatter\HtmlFormatter;
use App\Strategy\Formatter\JsonFormatter;
use App\Strategy\MessageSender;
use App\User\Admin;
use App\User\Enum\AdminLevel;
use App\Strategy\Formatter\PlaintextFormatter;

require_once __DIR__.'/vendor/autoload.php';

$admin = new Admin('Ben', 'ben', 'admin1234', 35, AdminLevel::SuperAdmin);

echo $admin->auth('ben', 'foo') ? 'Logged in!' : 'Error';
echo "\n";

$formatters = [];
foreach ([new HtmlFormatter(), new PlaintextFormatter, new JsonFormatter()] as $formatter) {
    $formatters[$formatter->getFormat()] = $formatter;
}

$send = new MessageSender($formatters);
$send->send($admin, 'Hello awesome!');
