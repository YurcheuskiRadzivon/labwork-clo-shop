<?php

define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'makki_shop');
define('DB_USER', 'postgres');
define('DB_PASS', '94508443r');

function getDbConnection() {
    $connection_string = sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        DB_HOST,
        DB_PORT,
        DB_NAME,
        DB_USER,
        DB_PASS
    );

    $conn = pg_connect($connection_string);

    if (!$conn) {
        die("Ошибка подключения к базе данных");
    }

    return $conn;
}

function dbQuery($conn, $query, $params = []) {
    if (empty($params)) {
        $result = pg_query($conn, $query);
    } else {
        $result = pg_query_params($conn, $query, $params);
    }

    if (!$result) {
        error_log("Database query error: " . pg_last_error($conn));
        return false;
    }

    return $result;
}

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
