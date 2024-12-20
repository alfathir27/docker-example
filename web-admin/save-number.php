<?php

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['rng'])) {
    // insert the random number to the database
    $res = insertRandomNumber($connection, $_GET['rng']);
    // echo json_encode(['message' => 'Number saved!']);
    if ($res) {
        echo json_encode(['message' => 'Number saved!']);
    } else {
        echo json_encode(['message' => 'Failed to save number']);
    }
} else {
    echo json_encode(['message' => 'Invalid request']);
}