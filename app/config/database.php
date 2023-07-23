<?php
$conn = new mysqli("localhost:33065", "root", "", "crud-cinema-modal");

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
} else {
    echo "conexion ok";
}
