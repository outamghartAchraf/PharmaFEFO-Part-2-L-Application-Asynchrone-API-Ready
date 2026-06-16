<?php
require_once __DIR__ . "/../repository/BaseRepository.php";

class BatchRepository extends BaseRepository
{


    public static function getAll(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                b.*,
                p.designation AS product_name,
                p.cip_code
            FROM batches b
            INNER JOIN products p
                ON b.product_id = p.id
            ORDER BY b.expiration_date ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function getById(int $id): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT *
            FROM batches
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        $batch = $stmt->fetch(PDO::FETCH_OBJ);

        return $batch ?: null;
    }

    public static function create(
        int $productId,
        string $batchNumber,
        string $expirationDate,
        int $quantity
    ): bool {
        $stmt = self::getConnection()->prepare("
            INSERT INTO batches (
                product_id,
                batch_number,
                expiration_date,
                qty_received,
                qty_available,
                status
            )
            VALUES (?, ?, ?, ?, ?, 'ACTIVE')
        ");

        return $stmt->execute([
            $productId,
            $batchNumber,
            $expirationDate,
            $quantity,
            $quantity
        ]);
    }


    public static function update(
        int $id,
        int $productId,
        string $batchNumber,
        string $expirationDate,
        int $qtyReceived,
        int $qtyAvailable,
        string $status
    ): bool {
        $stmt = self::getConnection()->prepare("
            UPDATE batches
            SET
                product_id = ?,
                batch_number = ?,
                expiration_date = ?,
                qty_received = ?,
                qty_available = ?,
                status = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $productId,
            $batchNumber,
            $expirationDate,
            $qtyReceived,
            $qtyAvailable,
            $status,
            $id
        ]);
    }


    public static function delete(int $id): bool
    {
        $stmt = self::getConnection()->prepare("
            DELETE FROM batches
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }


    public static function findByProductId(int $productId): array
    {
        $stmt = self::getConnection()->prepare("
            SELECT *
            FROM batches
            WHERE product_id = ?
            ORDER BY expiration_date ASC
        ");

        $stmt->execute([$productId]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function getNextBatchFEFO(int $productId): ?object
    {
        $stmt = self::getConnection()->prepare("
            SELECT *
            FROM batches
            WHERE product_id = ?
              AND qty_available > 0
              AND status = 'ACTIVE'
            ORDER BY expiration_date ASC
            LIMIT 1
        ");

        $stmt->execute([$productId]);

        $batch = $stmt->fetch(PDO::FETCH_OBJ);

        return $batch ?: null;
    }


    public static function updateQuantity(
        int $batchId,
        int $newQuantity
    ): bool {
        $stmt = self::getConnection()->prepare(
            "UPDATE batches
             SET qty_available = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $newQuantity,
            $batchId
        ]);
    }


    public static function getExpiredBatches(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                b.*,
                p.designation AS product_name
            FROM batches b
            INNER JOIN products p
                ON p.id = b.product_id
            WHERE b.expiration_date < CURDATE()
            ORDER BY b.expiration_date ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public static function getExpiringBatches(int $days): array
    {
        $stmt = self::getConnection()->prepare("
            SELECT
                b.*,
                p.designation AS product_name
            FROM batches b
            INNER JOIN products p
                ON p.id = b.product_id
            WHERE b.status = 'ACTIVE'
              AND b.expiration_date BETWEEN CURDATE()
              AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
            ORDER BY b.expiration_date ASC
        ");

        $stmt->execute([$days]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getFEFOWarnings()
{
    $stmt = self::getConnection()->query("
        SELECT 
            b.id,
            b.batch_number,
            b.expiration_date,
            b.qty_available,
            p.designation AS product_name
        FROM batches b
        INNER JOIN products p ON p.id = b.product_id
        WHERE b.qty_available > 0
        ORDER BY b.expiration_date ASC
    ");

    $batches = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($batches as $b) {

        $today = new DateTime();
        $expiry = new DateTime($b->expiration_date);
        $diff = $today->diff($expiry)->days;

        if ($expiry < $today) {
            $b->status = 'EXPIRED';
        } elseif ($diff <= 30) {
            $b->status = 'CRITICAL';
        } elseif ($diff <= 90) {
            $b->status = 'WARNING';
        } else {
            $b->status = 'OK';
        }
    }

    return $batches;
}
}
