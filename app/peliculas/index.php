<?php
require "../config/database.php";

$sqlPeliculas = "SELECT p.id, p.nombre, p.descripcion, g.nombre AS genero FROM pelicula AS p 
INNER JOIN genero AS g ON p.id_genero = g.id";
$peliculas = $conn->query($sqlPeliculas);
// print_r($peliculas->fetch_assoc());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
</head>

<body>
    <div class="container py-3">

        <h2 class="text-center">Peliculas</h2>

        <div class="row justify-content-end">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</button>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Poster</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row_pelicula = $peliculas->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row_pelicula["id"]; ?></td>
                        <td><?= $row_pelicula["nombre"]; ?></td>
                        <td><?= $row_pelicula["descripcion"]; ?></td>
                        <td><?= $row_pelicula["genero"]; ?></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal" data-bs-id="<?= $row_pelicula['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id="<?= $row_pelicula['id']; ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php
    $sqlGenero = "SELECT id, nombre FROM genero";
    $generos = $conn->query($sqlGenero);
    ?>

    <?php include "nuevoModal.php"; ?>
    <?php $generos->data_seek(0); ?>
    <?php include "editarModal.php"; ?>
    <?php include "eliminarModal.php"; ?>

    <script>
        let editarModal = document.getElementById('editarModal');
        let eliminarModal = document.getElementById('eliminarModal');

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');

            let inputId = editarModal.querySelector('.modal-body #id');
            let inputNombre = editarModal.querySelector('.modal-body #nombre');
            let inputDescripcion = editarModal.querySelector('.modal-body #descripcion');
            let inputGenero = editarModal.querySelector('.modal-body #genero');

            let url = "getPelicula.php";
            let formData = new FormData();
            formData.append('id', id);

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    inputId.value = data.id
                    inputNombre.value = data.nombre
                    inputDescripcion.value = data.descripcion
                    inputGenero.value = data.id_genero
                }).catch(err => console.log(err))
        });

        eliminarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            eliminarModal.querySelector('.modal-footer #id').value = id;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>