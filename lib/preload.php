<?php

echo "Preload started." . PHP_EOL;

$files = require __DIR__ . '/vendor/composer/autoload_classmap.php';

foreach ($files as $file) {
    @opcache_compile_file($file);
}

echo "Finished preloading" . PHP_EOL;