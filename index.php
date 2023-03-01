<?php

use PsdParse\PsdParse;

require __DIR__ . '/vendor/autoload.php';

// download PSD from cli
if (isset($argc) && is_string($argv[1])) {
    $p = new PsdParse($argv[1]);
    $p->replace('/NAME/i', 'KYRYLO');
    echo "\nProgram work fine\n";
} else {
    die('Error, add psd file');
}
