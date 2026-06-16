<?php

require_once __DIR__ . '/../Repository/BaseRepository.php';

class ReportRepository extends BaseRepository
{
 
    public static function getCurrentStockReport(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                p.designation AS product_name,
                p.cip_code,
                b.batch_number,
                b.expiration_date,
                b.qty_received,
                b.qty_available,
                b.status
            FROM batches b
            INNER JOIN products p
                ON p.id = b.product_id
            WHERE b.qty_available > 0
            ORDER BY p.designation ASC,
                     b.expiration_date ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public static function getExpiredReport(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                p.designation AS product_name,
                p.cip_code,
                b.batch_number,
                b.expiration_date,
                b.qty_available,
                b.status
            FROM batches b
            INNER JOIN products p
                ON p.id = b.product_id
            WHERE b.expiration_date < CURDATE()
            ORDER BY b.expiration_date ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public static function getExpiringSoonReport(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                p.designation AS product_name,
                p.cip_code,
                b.batch_number,
                b.expiration_date,
                b.qty_available,
                DATEDIFF(
                    b.expiration_date,
                    CURDATE()
                ) AS days_remaining
            FROM batches b
            INNER JOIN products p
                ON p.id = b.product_id
            WHERE b.expiration_date BETWEEN CURDATE()
                AND DATE_ADD(CURDATE(), INTERVAL 90 DAY)
            ORDER BY b.expiration_date ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public static function getMovementsReport(): array
    {
        $stmt = self::getConnection()->query("
            SELECT
                sm.id,
                sm.type,
                sm.quantity,
                sm.movement_date,
                sm.note,

                b.batch_number,

                p.designation AS product_name,

                u.name
            FROM stock_movements sm

            INNER JOIN batches b
                ON b.id = sm.batch_id

            INNER JOIN products p
                ON p.id = b.product_id

            INNER JOIN users u
                ON u.id = sm.user_id

            ORDER BY sm.movement_date DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public static function getStatistics(): object
    {
        $stmt = self::getConnection()->query("
            SELECT
                (SELECT COUNT(*) FROM products) AS total_products,

                (SELECT COUNT(*) FROM batches) AS total_batches,

                (SELECT COUNT(*)
                 FROM batches
                 WHERE expiration_date < CURDATE()) AS expired_batches,

                (SELECT COUNT(*)
                 FROM batches
                 WHERE expiration_date BETWEEN CURDATE()
                 AND DATE_ADD(CURDATE(), INTERVAL 90 DAY)
                ) AS expiring_soon
        ");

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}