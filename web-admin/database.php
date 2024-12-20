<?php

$connection = mysqli_connect('dbsiakad', 'siakad_db', 'siakad_db', 'siakad_db', 3306);

if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}

function createRandomHistoryTable($connection) {
    $tableName = 'random_history';
    $sql = "CREATE TABLE $tableName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        random_number INT(6) UNSIGNED
    )";

    if (mysqli_query($connection, $sql)) {
        echo "Table $tableName created successfully";
    } else {
        // echo "Error creating table: " . mysqli_error($connection);
    }
}

function insertRandomNumber($connection, $randomNumber) {
    $tableName = 'random_history';
    $sql = "INSERT INTO $tableName (random_number) VALUES ($randomNumber)";

    if (mysqli_query($connection, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getRandomNumber($connection) {
    $tableName = 'random_history';
    $sql = "SELECT * FROM $tableName ORDER BY id DESC";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    } else {
        return null;
    }
}