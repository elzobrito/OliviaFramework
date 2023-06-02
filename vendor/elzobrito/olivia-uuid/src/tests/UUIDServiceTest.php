<?php

namespace OliviaUuid\tests;

use OliviaUuid\uuid\UUIDService;
use OliviaUuid\uuid\RandomUUIDGenerator;

class UUIDServiceTest {
    private $service;

    public function __construct() {
        $generator = new RandomUUIDGenerator();
        $this->service = new UUIDService($generator);
    }

    public function testGenerateUUID() {
        $uuid = $this->service->generateUUID();

        if ($this->isValidUUID($uuid)) {
            echo "Test passed: UUID generated successfully: $uuid\n";
        } else {
            echo "Test failed: Invalid UUID generated: $uuid\n";
        }
    }

    private function isValidUUID($uuid) {
        // Implement your own validation logic here
        // This is a basic example of UUID validation
        $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';
        return preg_match($pattern, $uuid) === 1;
    }
}
