<?php

class GamePlatform {
    // Check if a relationship exists
    public static function exists($gameId, $platformId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT COUNT(*) as count
            FROM game_platform
            WHERE game_id = :game_id AND platform_id = :platform_id
        ");
        $stmt->execute([
            'game_id' => $gameId,
            'platform_id' => $platformId
        ]);

        $row = $stmt->fetch();
        return $row['count'] > 0;
    }

    // Create a new game-platform relationship
    public static function create($gameId, $platformId) {
        // Check if relationship already exists
        if (self::exists($gameId, $platformId)) {
            return false;
        }

        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO game_platform (game_id, platform_id)
            VALUES (:game_id, :platform_id)
        ");

        return $stmt->execute([
            'game_id' => $gameId,
            'platform_id' => $platformId
        ]);
    }

    // Delete a specific game-platform relationship
    public static function remove($gameId, $platformId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM game_platform
            WHERE game_id = :game_id AND platform_id = :platform_id
        ");

        return $stmt->execute([
            'game_id' => $gameId,
            'platform_id' => $platformId
        ]);
    }

    // Delete all platform relationships for a specific game
    public static function deleteByGame($gameId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM game_platform
            WHERE game_id = :game_id
        ");
        return $stmt->execute(['game_id' => $gameId]);
    }
}
