<?php require_once "metro.php"; ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container justify-content-center" style="height: 100vh;">
        <div class="row align-items-center justify-content-center" style="height: 100%;">
            <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Reporte</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Estacion</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Linea</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <!-- acordeon de estaciones-->
                        <div class="accordion" id="accordionExample">
                            <?php foreach (Metro::getLineas() as $metro) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $metro['idLinea'] ?>" aria-expanded="true" aria-controls="<?= $metro['idLinea'] ?>">
                                            <?= $metro['nombre'] ?>
                                        </button>
                                    </h2>
                                    <div id="<?= $metro['idLinea'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <h6>Estacion</h6>
                                                    <h6>Status</h6>
                                                </li>
                                                <?php foreach (Metro::getEstacionesXLineas($metro['idLinea']) as $estacion) : ?>
                                                    <?php if (!is_null($estacion)) : ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <?= $estacion['nombre'] ?>
                                                            <span class="badge bg-<?= $estacion['color'] ?> rounded-pill"><?= $estacion['status'] ?></span>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="d-flex gap-3">
                            <div class="col col-4">
                                <div class="alert alert-success d-none" role="alert" id='alert-estacion'>
                                    Se a gaurdado la estacion
                                </div>
                                <p>Dar de alta una estacion nueva</p>
                                <form action="metro.php" method="POST" id="altaEstaciones">
                                    <div class="mb-3">
                                        <label for="nombreEstacion" class="form-label">Nombre de la estacion</label>
                                        <input type="text" class="form-control" id="nombreEstacion" name="nombreEstacion">
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcionEstacion" class="form-label">Descripcion de la estacion</label>
                                        <input type="text" class="form-control" id="descEstacion" name="descEstacion">
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Crear Estacion</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col col-8 ml-4 table-responsive overflow-y-auto" style="max-height: 250px;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Estacion</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php foreach (Metro::getEstaciones() as $estacion) : ?>
                                            <tr>
                                                <th><?= $estacion['id'] ?></th>
                                                <td><?= $estacion['nombre'] ?></td>
                                                <td><?= $estacion['descripcion'] ?></td>
                                                <td><?= $estacion['status'] ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary" id="editar" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</button>
                                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <div class="alert alert-success d-none" role="alert" id='alert-estacion'>
                            Se a gaurdado la estacion
                        </div>
                        <p>Dar de alta una Linea nueva</p>
                        <form action="metro.php" method="POST" id="altaLinea">
                            <div class="mb-3">
                                <label for="nombreEstacion" class="form-label">Nombre de la estacion</label>
                                <input type="text" class="form-control" id="nombreLinea" name="nombreLinea">
                            </div>
                            <div class="mb-3">
                                <label for="descripcionEstacion" class="form-label">Descripcion de la estacion</label>
                                <input type="text" class="form-control" id="descLinea" name="descLinea">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>