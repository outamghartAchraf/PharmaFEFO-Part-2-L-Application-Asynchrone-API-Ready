<?php

 require_once __DIR__ . "/../repository/BaseRepository.php";

class MedicalRepository extends BaseRepository
{
   
    public static function getAll(): array
    {
        $stmt = self::getConnection()->query("
            SELECT *
            FROM products
            ORDER BY id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getById(int $id): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT *
            FROM products
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        $product = $stmt->fetch(PDO::FETCH_OBJ);

        return $product ?: null;
    }

    public static function create(
        string $cipCode,
        string $designation,
        float $price,
        int $minStockAlert
    ): bool {
        $stmt = self::getConnection()->prepare("
            INSERT INTO products (
                cip_code,
                designation,
                price,
                min_stock_alert
            )
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $cipCode,
            $designation,
            $price,
            $minStockAlert
        ]);
    }

    public static function update(
        int $id,
        string $cipCode,
        string $designation,
        float $price,
        int $minStockAlert
    ): bool {
        $stmt = self::getConnection()->prepare("
            UPDATE products
            SET
                cip_code = ?,
                designation = ?,
                price = ?,
                min_stock_alert = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $cipCode,
            $designation,
            $price,
            $minStockAlert,
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $stmt = self::getConnection()->prepare("
            DELETE FROM products
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
}