<?php

session_start();
//Si existe la sesión "cliente"..., la guardamos en una variable.
/*  if (isset($_SESSION['usuarios'])) {
    $cliente = $_SESSION['usuarios'];
    session_destroy();
} else {
    header('Location: ../index.php'); //Aqui lo redireccionas al lugar que quieras.
    die();
}  */
$conexion = mysqli_connect('localhost', 'yespoint_Ef', 'salav1234@', 'yespoint_salavrefac');
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitacora de aplicacion</title>
    <link rel="stylesheet" href="../estilos/header.css">
    <link rel="stylesheet" href="style.css">

    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
</head>

<header>
    <!-- aquí comienza nuestro menu -->
    <div class="ancho">
        <div class="logo">
            <a href="../Menu.php"><img src="../estilos/imagenes/logo.png" class="imaa"></a>
        </div>
    </div>
</header>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <table>
            <tr>
                <td>
                    <?php
                    if (empty($_POST['IdDispositivo'])) {
                    ?>
                        <label>IdDispositivo:</label>
                        <input type="text" name="IdDispositivo">
                        <?php
                    } else {
                        if (!empty($_POST['IdDispositivo'])) {
                        ?>
                            <label>IdDispositivo:</label>
                            <input type="text" name="IdDispositivo" value="<?= $_POST['IdDispositivo'] ?>">
                    <?php
                        }
                    }
                    ?>

                </td>
                <td>
                    <?php
                    if (empty($_POST['date1'])) {
                    ?>
                        <label>Fecha Inicio:</label>
                        <input type="date" placeholder="Inicio" id="date1" name="date1">
                        <?php
                    } else {
                        if (!empty($_POST['date1'])) {
                        ?>
                            <label>Fecha Inicio:</label>
                            <input type="date" placeholder="Inicio" id="date1" name="date1" value="<?= $_POST['date1'] ?>">
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (empty($_POST['date2'])) {
                    ?>
                        <label>Fecha Final:</label>
                        <input type="date" placeholder="Final" id="date2" name="date2">
                        <?php
                    } else {
                        if (!empty($_POST['date2'])) {
                        ?>
                            <label>Fecha Final:</label>
                            <input type="date" placeholder="Final" id="date2" name="date2" value="<?= $_POST['date2'] ?>">
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
                    <input type="submit" name="enviar" value="Buscar" style="background-color: #db2323; color: white; padding: 5px 15px; border-radius: 5px; border-color: #db2323;">
                </td>
                <td>
                    <a href="bitacora_apk.php" style="background-color: #db2323; color: WHITE; padding: 9px 7px; text-decoration: none; border-radius: 10px;">Mostrar todos los datos de bitacora</a>
                </td>
            </tr>
        </table>
    </form>

    <table id="tabla">
        <thead>
            <tr>
                <th>id</th>
                <th>IdDispositivo</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Accion</th>
                <th>ValoresDatos</th>
                <th>Usuario</th>
                <th>Exportado</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['enviar'])) {
                //si esta establecido el boton de enviar mostrar resultado de filtro
                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                $IdDispositivo = $_POST['IdDispositivo'];
                //$fechahora = $_POST['fechahora'];

                if (empty($_POST['IdDispositivo']) && (empty($_POST['date1']) || empty($_POST['date2']))) {
                    echo "<script language='JavaScript'>
                            alert('Ingresa el IdDispositivo o la fecha de bitacora');
                            location.assign('bitacora_apk.php');
                            </script>
                        ";
                } else {

                    if (empty($_POST['IdDispositivo'])) {

                        $sql = "select * from bitacora_apk INNER JOIN `acciones` ON bitacora_apk.accion = acciones.id_descripcion where  STR_TO_DATE(fechahora,'%d/%m/%Y, %H:%i:%s') between '$date1 00:00:00' AND '$date2 23:59:59' ";
                    }

                    if (empty($_POST['date1']) && empty($_POST['date2'])) {
                        $sql = "select * from bitacora_apk INNER JOIN `acciones` ON bitacora_apk.accion = acciones.id_descripcion where IdDispositivo like '%" . $IdDispositivo . "%'";
                    }

                    if (!empty($_POST['date1']) and  !empty($_POST['date2']) && !empty($_POST['IdDispositivo'])) {

                        $sql = "select * from bitacora_apk INNER JOIN `acciones` ON bitacora_apk.accion = acciones.id_descripcion where IdDispositivo like '%" . $IdDispositivo . "%' AND STR_TO_DATE(fechahora,'%d/%m/%Y, %H:%i:%s') between '$date1 00:00:00' AND '$date2 23:59:59' ";
                    }
                }

                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
                    $fecha = $filas['fechahora'];
                    $fecha_explode = explode("/", $fecha);

                    $anioF = substr($fecha_explode[2], 0, 4); //anio sin comas

                    //validacion: si dia es menor o igual a 9, agregar 0. si no, pasarlo.
                    if ($fecha_explode[0] <= 9) {
                        $dia = '0' . $fecha_explode[0];
                    } else {
                        $dia = $fecha_explode[0];
                    }

                    $fecha_arreglada = $dia . '/' . $fecha_explode[1] . '/' . $anioF;
            ?>

                    <tr>
                        <td><?php echo $filas['id'] ?></td>
                        <td><?php echo $filas['IdDispositivo'] ?></td>
                        <td><?php echo $fecha_arreglada ?></td>
                        <td><?php echo substr($filas['fechahora'], 10, 19) ?></td>
                        <td><?php echo $filas['accion'] ?></td>
                        <td><?php echo $filas['valoresDatos'] ?></td>
                        <td><?php echo $filas['usuario'] ?></td>
                        <td><?php echo $filas['exportado'] ?></td>
                        <td><?php echo $filas['Descripcion'] ?></td>
                    </tr>

                <?php
                }
            } else {
                //mostrar todo
                $sql = "select * from bitacora_apk INNER JOIN `acciones` ON bitacora_apk.accion = acciones.id_descripcion";
                $resultado = mysqli_query($conexion, $sql);

                while ($filas = mysqli_fetch_assoc($resultado)) {

                    $fecha = $filas['fechahora'];
                    $fecha_explode = explode("/", $fecha);

                    $anioF = substr($fecha_explode[2], 0, 4); //anio sin comas

                    //validacion: si dia es menor o igual a 9, agregar 0. si no, pasarlo.
                    if ($fecha_explode[0] <= 9) {
                        $dia = '0' . $fecha_explode[0];
                    } else {
                        $dia = $fecha_explode[0];
                    }

                    $fecha_arreglada = $dia . '/' . $fecha_explode[1] . '/' . $anioF;
                ?>

                    <tr>
                        <td><?php echo $filas['id'] ?></td>
                        <td><?php echo $filas['IdDispositivo'] ?></td>
                        <td><?php echo $fecha_arreglada ?></td>
                        <td><?php echo substr($filas['fechahora'], 10, 19) ?></td>
                        <td><?php echo $filas['accion'] ?></td>
                        <td><?php echo $filas['valoresDatos'] ?></td>
                        <td><?php echo $filas['usuario'] ?></td>
                        <td><?php echo $filas['exportado'] ?></td>
                        <td><?php echo $filas['Descripcion'] ?></td>
                    </tr>

            <?php
                }
            }

            ?>

        </tbody>
    </table>

</body>

</html>
<script>
    ////Pagination with DataTable
    var tabla = document.querySelector('#tabla');

    var dataTable = new DataTable(tabla);
</script>