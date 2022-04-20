<?php

$conn = new mysqli("localhost", "root", "", "delivery");


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


mysqli_set_charset($conn, 'utf8mb4');


?>