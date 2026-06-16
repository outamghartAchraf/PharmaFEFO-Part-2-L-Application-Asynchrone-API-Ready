<?php

require_once __DIR__ . '/BaseRepository.php';

class RoleRepository extends BaseRepository
{
    public static function getAll(): array
    {
        $stmt = self::getConnection()->query("
            SELECT *
            FROM roles
            ORDER BY id ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById(int $id): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT *
            FROM roles
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        $role = $stmt->fetch(PDO::FETCH_OBJ);

        return $role ?: null;
    }
}