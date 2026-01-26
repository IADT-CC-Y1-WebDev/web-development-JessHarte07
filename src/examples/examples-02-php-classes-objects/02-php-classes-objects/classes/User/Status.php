<?php

namespace User;

class Status {
    public const ACTIVE = 'active';
    public const SUSPENDED = 'suspended';
    public const PENDING = 'pending';
    public const VERIFIED = 'verified';

    public static function getAll() {
        return [
            self::ACTIVE,
            self::SUSPENDED,
            self::PENDING,
            self::VERIFIED
        ];
    }

    public static function getDescription($status) {
        $descriptions = [
            self::ACTIVE => 'User account is active',
            self::SUSPENDED => 'User account has been suspended',
            self::PENDING => 'User account is awaiting verification',
            self::VERIFIED => 'User identity has been verified'
        ];
        return $descriptions[$status] ?? 'Unknown status';
    }
}
