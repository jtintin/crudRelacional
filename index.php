<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Relacional PHP-MYSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/47f8ee7277.js" crossorigin="anonymous"></script>
</head>

<body>
        <script>
            function confirmar() {
                return confirm("Desea eliminar el producto");

            }
        </script>
    <div class="alert alert-primary text-center p-4">CRUD EN PHP MYSQL</div>
    <div class="row col-12">
        <!--formulario-->
        <form action="" class="col-6" method="POST" enctype="multipart/form-data">
            <div class="alert alert-success">Registro de Productos</div>
            <?php
            include("modelo/conexion.php");
            include("controlador/productoControlador.php");
            ?>
            <div class="mb-3">
                <label for="">Categorías</label>
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="txtcategoria">
                    <option selected>Seleccionar...</option>
                    <?php
                    $categorias = $conexion->query("SELECT * FROM categorias");
                    while ($datos = $categorias->fetch_object()) {
                    ?>
                        <option value="<?= $datos->id ?>"><?= $datos->nombre ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>
            <div class="mb-3">
                <label for="">Nombre producto</label>
                <input type="text" class="form-control" name="txtnombre">
            </div>
            <div class="mb-3">
                <label for="">Precio</label>
                <input type="number" class="form-control" name="txtprecio" step="0.01">
            </div>
            <div class="mb-3">
                <label for="">Foto </label>
                <input type="file" class="form-control" name="imagen">
            </div>
            <div class="mb-3">
                <button type="submit" name="btnRegistrar" value="ok" class="btn btn-primary">Registrar</button>
            </div>
        </form>
        <!--fin formulario-->
        <!--tabla-->
        <table class="col-6">
            <thead>
                <tr>
                    <th scope="col">CÓDIGO</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">FOTOs</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $productos = $conexion->query("SELECT a.id, a.nombre AS producto, 
                a.precio, foto, a.categoria_id, b.nombre AS categoria 
                FROM productos a INNER JOIN categorias b ON a.categoria_id = b.id");
                while ($datos = $productos->fetch_object()) {
                ?>
                    <tr>
                        <td><?= $datos->id ?></td>
                        <td><?= $datos->categoria ?></td>
                        <td><?= $datos->producto ?></td>
                        <td><?= $datos->precio ?></td>
                        <td><?php if (!empty($datos->foto)) { ?> <img src="uploads/<?= $datos->foto ?>" alt="Foto producto" width="100"> <?php } else { ?> <span class="text-muted">Sin foto</span> <?php } ?></td>
                        <td>
                            <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $datos->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?id=<?= $datos->id ?>" onclick="return confirmar();" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $datos->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Productos</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!--formulario-->
                                    <form action="" class="col-6" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input type="hidden" class="form-control" name="txtid" value="<?= $datos->id ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Categorías</label>
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="txtcategoria">
                                                <option selected>Seleccionar...</option>
                                                <?php
                                                $datosCategoria = $conexion->query("select * from categorias");
                                                while ($datosC = $datosCategoria->fetch_object()) {
                                                ?>
                                                    <option <?= $datos->categoria_id == $datosC->id ?  "selected" : "" ?> value="<?= $datosC->id ?>"><?= $datosC->nombre ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="mb-3">
                                            <label for="">Nombre producto</label>
                                            <input type="text" class="form-control" name="txtnombre" value="<?= $datos->producto ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Precio</label>
                                            <input type="number" class="form-control" name="txtprecio" step="0.01" value="<?= $datos->precio ?>">
                                        </div>
                                        <!--foto -->
                                        <div class="mb-3">
                                            <label for="">Foto actual</label><br>
                                            <?php if (!empty($datos->foto)) { ?>
                                                <img src="uploads/<?= $datos->foto ?>" alt="Foto producto" width="100">
                                            <?php } else { ?>
                                                <span class="text-muted">Sin foto</span>
                                            <?php } ?>
                                        </div>

                                        <!-- Campo oculto para enviar la foto actual -->
                                        <input type="hidden" name="foto_actual" value="<?= $datos->foto ?>">

                                        <div class="mb-3">
                                            <label for="imagen">Nueva foto (opcional)</label>
                                            <input type="file" name="imagen" id="imagen" class="form-control">
                                        </div>


                                        <!--fin foto -->
                                        <div class="mb-3">
                                            <button type="submit" name="btnModificar" value="ok" class="btn btn-primary"> Modificar</button>
                                        </div>
                                    </form>
                                    <!--fin formulario-->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fin modal-->


                <?php
                }
                ?>
            </tbody>
        </table>
        <!--fin tabla-->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>