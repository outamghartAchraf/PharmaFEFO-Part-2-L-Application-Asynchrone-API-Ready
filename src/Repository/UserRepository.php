<?php
include_once __DIR__ . "/../../config/DB.php";
include_once __DIR__ . "/BaseRepository.php";

class UserRepository extends BaseRepository
{
   
    public static function login($email, $password)
    {
        $stmt = self::getConnection()->prepare("
        SELECT
            users.*,
            roles.label AS role
        FROM users
        INNER JOIN roles
            ON users.role_id = roles.id
        WHERE users.email = ?
    ");

        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        return $user;
    }


    public static function getAll(): array
    {
        $stmt = self::getConnection()->query("
            SELECT 
                u.*,
                r.label AS role_name
            FROM users u
            INNER JOIN roles r ON u.role_id = r.id
            ORDER BY u.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById(int $id): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT * FROM users WHERE id = ?
        ");

        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user ?: null;
    }

    public static function create(string $name, string $email, string $password, int $roleId): bool
    {
        $stmt = self::getConnection()->prepare("
            INSERT INTO users (name, email, password, role_id)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_BCRYPT),
            $roleId
        ]);
    }

    public static function update(int $id, string $name, string $email, int $roleId): bool
    {
        $stmt = self::getConnection()->prepare("
            UPDATE users
            SET name = ?, email = ?, role_id = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $name,
            $email,
            $roleId,
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $stmt = self::getConnection()->prepare("
            DELETE FROM users WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
   
}