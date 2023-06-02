<?php

namespace OliviaUuid\uuid;

class RandomUUIDGenerator implements UUIDGeneratorInterface
{
    public function generate(): string
    {
        $data = random_bytes(16);

        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // Set the version (bits 4-7) to 4
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // Set the variant (bits 6-7) to 10

        $time_low = unpack('N', substr($data, 0, 4))[1];
        $time_mid = unpack('n', substr($data, 4, 2))[1];
        $time_hi_version = unpack('n', substr($data, 6, 2))[1];
        $clock_seq_hi_variant = unpack('C', substr($data, 8, 1))[1];
        $clock_seq_low = unpack('C', substr($data, 9, 1))[1];
        $node = unpack('N', substr($data, 10, 6))[1];

        return sprintf(
            '%08x-%04x-%04x-%02x%02x-%012x',
            $time_low,
            $time_mid,
            $time_hi_version,
            $clock_seq_hi_variant,
            $clock_seq_low,
            $node
        );
    }
}