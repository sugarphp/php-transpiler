#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';
use Cliph\Command;
use Symfony\Component\Console\Application;
$application = new Application('Cliph', '0.1-dev');
$application->add(new Command\HelloCommand());
$application->run();