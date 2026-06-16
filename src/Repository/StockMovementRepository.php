<?php

require_once __DIR__ . '/../Repository/BaseRepository.php';

class StockMovementRepository extends BaseRepository
{

    public static function getAll(): array
    {
        $stmt = self::getConnection()->query("
            SELECT 
                sm.*,
                b.batch_number
            FROM stock_movements sm
            LEFT JOIN batches b ON sm.batch_id = b.id
            ORDER BY sm.movement_date DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function getById(int $id): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT * 
            FROM stock_movements
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ?: null;
    }


    public static function create(
        ?int $batchId,
        int $userId,
        string $type,
        int $quantity,
        ?string $note = null,
        ?string $movementDate = null
    ): bool {

        $stmt = self::getConnection()->prepare("
        INSERT INTO stock_movements (
            batch_id,
            user_id,
            type,
            quantity,
            movement_date,
            note
        )
        VALUES (?, ?, ?, ?, ?, ?)
    ");

        return $stmt->execute([
            $batchId,
            $userId,
            $type,
            $quantity,
            $movementDate ?? date('Y-m-d H:i:s'),
            $note
        ]);
    }


    public static function findByBatchId(int $batchId): array
    {
        $stmt = self::getConnection()->prepare("
            SELECT * 
            FROM stock_movements
            WHERE batch_id = ?
            ORDER BY movement_date DESC
        ");

        $stmt->execute([$batchId]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function findByType(string $type): array
    {
        $stmt = self::getConnection()->prepare("
            SELECT 
                sm.*,
                b.batch_number
            FROM stock_movements sm
            LEFT JOIN batches b ON sm.batch_id = b.id
            WHERE sm.type = ?
            ORDER BY sm.movement_date DESC
        ");

        $stmt->execute([$type]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function getTotalOutByBatch(int $batchId): int
    {
        $stmt = self::getConnection()->prepare("
            SELECT COALESCE(SUM(quantity), 0)
            FROM stock_movements
            WHERE batch_id = ?
              AND type = 'OUT'
        ");

        $stmt->execute([$batchId]);

        return (int) $stmt->fetchColumn();
    }


    public static function getTotalInByBatch(int $batchId): int
    {
        $stmt = self::getConnection()->prepare("
            SELECT COALESCE(SUM(quantity), 0)
            FROM stock_movements
            WHERE batch_id = ?
              AND type = 'IN'
        ");

        $stmt->execute([$batchId]);

        return (int) $stmt->fetchColumn();
    }
}
