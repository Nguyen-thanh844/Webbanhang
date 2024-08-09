<?php
class Detail
{
    public $conn; // khai báo phương thức

    public function __construct()
    {
        $this->conn = connectDB();
    }
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
    // viet ham lay  chi tiêt san pham
    public function getbyIDProductDetails($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id 
                    WHERE san_phams.id = :id LIMIT 1';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi " . $e->getMessage();
        }
    }
}