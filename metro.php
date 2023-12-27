<?php 
require_once 'config.php';

define('BANDERAS', array('ok'=>'primary', 'bad'=>'danger'));

class Metro{

    public static function getReportes(){
        $conexion = Connect::conexion();
        $sql = "SELECT e.Nombre_E, Descripcion_E, Status_E, l.Nombre_L, Descripcion_L FROM `del` AS reporte LEFT JOIN estación AS e ON reporte.ID_E = e.ID_E LEFT JOIN linea AS l ON reporte.ID_L = l.ID_L;";       
        $result = $conexion->query($sql);
        while($row = $result->fetch_assoc()){
            $datos[] = array(
                'nombreEstacion'=>$row['Nombre_E'],
                'descripcionEstacion'=>$row['Descripcion_E'],
                'estadoEstacion'=>$row['Status_E'],
                'nombreLinea'=>$row['Nombre_L'],
                'descripcionLinea'=>$row['Descripcion_L'],
            );
        }
        header("Content-Type: application/json");
        echo json_encode($datos);
    }

    public static function getLineas(){
        $conexion = Connect::conexion();
        $sql = "SELECT * FROM `linea`";       
        $result = $conexion->query($sql);
        while($row = $result->fetch_assoc()){
            $datos[] = array(
                'idLinea'=>$row['ID_L'],
                'nombre'=>$row['Nombre_L'],
                'descripcion'=>$row['Descripcion_L']
            );
        }
        return $datos;
    }

    public static function getEstacionesXLineas($idLinea){
        $conexion = Connect::conexion();
        $sql = "SELECT * FROM `del` LEFT JOIN estación AS e ON del.ID_E = e.ID_E WHERE ID_L = $idLinea;";
        $result = $conexion->query($sql);
        while($row = $result->fetch_assoc()){
            $datos[] = array(
                'nombre' => $row['Nombre_E'],
                'status' => $row['Status_E'],
                'color' => BANDERAS[$row['Status_E']],
            );
        }
        return $datos;
    }

    public static function guardarEstacion(){
        $nombre = $_POST['nombreEstacion'];
        $descripcion = $_POST['descripcion'];
        $conexion = Connect::conexion();
        $sql = "INSERT INTO `estación`(`Nombre_E`, `Descripcion_E`) VALUES ('$nombre', '$descripcion')";
        $result = $conexion->query($sql);
        $datos = array('status'=>$result);
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    public static function guardarLinea(){
        $nombre = $_POST['nombreLinea'];
        $descripcion = $_POST['descripcion'];
        $conexion = Connect::conexion();
        $sql = "INSERT INTO `linea`(`Nombre_L`, `Descripcion_L`) VALUES ('$nombre', '$descripcion')";
        $result = $conexion->query($sql);
        $datos = array('status'=>$result);
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

}