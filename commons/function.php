<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

// thêm file
if (!function_exists('require_file')) {
    function require_file($pathFolder)
    {

        $files = array_diff(scandir($pathFolder), ['.', '..']);
        foreach ($files as $file) {
            require_once $pathFolder . $file;
        }
    }
}
if (!function_exists('debug')) {
    function debug($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }
}
function uploadFile($file, $folderUpload){
    $pathStorage = $folderUpload .time() . $file['name'];

    $from = $file['tmp_name'];
    $to = PATH_ROOT .$pathStorage;
    if(move_uploaded_file($from, $to)){
        return $pathStorage;

    }
    return null;
}

// xóa file

function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;

    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

//xóa sesion sau khi load trang

function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
        // huỷ sesion sau khi đã tải trang
        unset($_SESSION['flash']);
        session_unset();
        // session_destroy();
    }
}

// upload - update ablum ảnh
function uploadFileAlbum($file, $folderUpload , $key){
    $pathStorage = $folderUpload .time() . $file['name'][$key];

    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT .$pathStorage;
    if(move_uploaded_file($from, $to)){
        return $pathStorage;

    }
    return null;
}
// format date

function formatDate($date){
    // $originalDate = $date['ngay_dat'];
    return date("d-m-Y", strtotime($date));
}
// chekc login admin
function checkLoginAdmin(){
    if(!isset($_SESSION['user_admin'])){ // không có session thì redict về trang admin
        require_once './views/auth/formLogin.php';
        exit();
    }
}

