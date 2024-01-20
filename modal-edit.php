<?php
include_once 'metro.php';
// recibimos el id que le pasamos por parametros en la url
$id = $_GET['id'];
$estacion = Metro::getOneEstacion($id);
function isSelected($value, $estatus){
    if ($estatus == $value) {
        return 'selected';
    }
}

?>
<form id="form-editEstacion">
    <div class="mb-3">
        <label for="nombreEstacion" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombreEstacion" aria-describedby="emailHelp" value="<?= $estacion['Nombre_E'] ?>" name="nombre">
        <input type="text" class="form-control" id="idEstacion" aria-describedby="emailHelp" value="<?= $estacion['ID_E'] ?>" name="idEstacion" hidden>
    </div>
    <div class="mb-3">
        <label for="descripcionEstacion" class="form-label">Descripcion</label>
        <input type="text" class="form-control" id="descripcionEstacion" value="<?= $estacion['Descripcion_E'] ?>" name="descripcion">
    </div>
    <div class="mb-3">
        <label for="estatus" class="form-label">Estatus</label>
        <select class="form-select" aria-label="Default select example" id="estatus" name="status">
            <option value="ok" <?= isSelected('ok', $estacion['Status_E']) ?>>OK</option>
            <option value="bad" <?= isSelected('bad', $estacion['Status_E']) ?>>BAD</option>
        </select>
    </div>
</form>