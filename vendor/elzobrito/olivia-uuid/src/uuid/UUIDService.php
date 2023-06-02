<?php

namespace OliviaUuid\uuid;
class UUIDService {
    private $generator;

    public function __construct(UUIDGeneratorInterface $generator) {
        $this->generator = $generator;
    }

    public function generateUUID(): string {
        return $this->generator->generate();
    }
}