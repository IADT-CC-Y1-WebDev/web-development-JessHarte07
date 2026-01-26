<?php

namespace Account;

class Status {
    public const ACTIVE = 'active';
    public const FROZEN = 'frozen';
    public const CLOSED = 'closed';
    public const OVERDRAWN = 'overdrawn';

    public static function getAll() {
        return [
            self::ACTIVE,
            self::FROZEN,
            self::CLOSED,
            self::OVERDRAWN
        ];
    }

    public static function getDescription($status) {
        $descriptions = [
            self::ACTIVE => 'Account is active and in good standing',
            self::FROZEN => 'Account is temporarily frozen',
            self::CLOSED => 'Account has been closed',
            self::OVERDRAWN => 'Account balance is negative'
        ];
        return $descriptions[$status] ?? 'Unknown status';
    }
}
