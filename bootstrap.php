<?php

use Symfony\Component\Dotenv\Dotenv;

/////////////////////
// bootstrap services

// dotenv
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
