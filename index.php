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
                        <!-- acordeon -->
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
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?= $estacion['nombre'] ?>
                                                        <span class="badge bg-<?= $estacion['color'] ?> rounded-pill"><?= $estacion['status'] ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>