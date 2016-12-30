<?php
// after command  'composer install'

require __DIR__."/../src/FizzMarkdown.php";

use Fizzday\FizzMarkdown\FizzMarkdown;

$md = <<<EOT
## 222
- ASFD
- ASDF

EOT;

$md = '1483076395.html';

$res = FizzMarkdown::run($md, true);

echo $res;
//print_r($res); // 5

