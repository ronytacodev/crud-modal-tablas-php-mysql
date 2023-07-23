<?php
$conn = new mysqli("localhost:33065", "root", "", "crud-cinema-modal");
mysqli_set_charset($conn, "utf8mb4");

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
} else {
    // echo "conexion ok";
}
