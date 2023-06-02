<?php

namespace OliviaUuid;

use OliviaUuid\uuid\RandomUUIDGenerator;
use OliviaUuid\uuid\UUIDService;

require_once  __DIR__ . '/vendor/autoload.php';

class Index
{
    public function __construct()
    {
        $generator = new RandomUUIDGenerator();
        $service = new UUIDService($generator);
        $uuid = $service->generateUUID();
        echo $uuid;
    }
}
new Index();
