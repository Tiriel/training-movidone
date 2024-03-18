<?php

namespace App\Strategy\Formatter;

class HtmlFormatter implements Interface\FormatterInterface
{

    public function format(string $message): string
    {
        return <<<EOD
<html>
    <body>
        <strong>$message</strong>
    </body>
</html>
EOD;
    }

    public function getFormat(): string
    {
        return 'html';
    }
}
