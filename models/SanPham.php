<?php

class SanPham
{
    public $conn; // khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // viet ham lay toan bo san pham

    public function getAllProduct()
    {
        try {
            $sql = 'SELECT * FROM san_phams';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage() . "Lỗi";
        }
    }
    public function get3Product()
    {
        try {
            $sql = 'SELECT * 
            FROM san_phams 
            ORDER BY ngay_nhap DESC 
            LIMIT 3;
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage() . "Lỗi";
        }
    }
    public function get3ViewProduct()
    {
        try {
            $sql = 'SELECT * 
            FROM san_phams 
            ORDER BY luot_xem DESC 
            LIMIT 3;
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage() . "Lỗi";
        }
    }
    public function get3CommentProduct()
    {
        try {
            $sql = 'SELECT DISTINCT san_phams.* 
            FROM san_phams
            JOIN binh_luans bl ON san_phams.id = bl.san_pham_id
            LIMIT 3;
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage() . "Lỗi";
        }
    }
    public function getAllCategory()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage() . "Lỗi";
        }
    }
}
