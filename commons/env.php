<?php

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS


// duong san vao clients
define('BASE_URL', 'http://localhost/DA1-master/');

// Khai báo các biến môi trường dùng Global
define('PATH_CONTROLLER',   __DIR__ . '/../controllers/');
define('PATH_MODEL',        __DIR__ . '/../models/');
define('PATH_VIEW',         __DIR__ . '/../views/');
// duong san vao admin
define('BASE_URL_ADMIN', 'http://localhost/DA1-master/admin/');


define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'xuong_thu_cung');  // Tên database

define('PATH_ROOT', __DIR__ . '/../');
