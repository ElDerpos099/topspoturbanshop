<?php require_once('Connections/Topspot.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['Buscar'])) {
  $colname_Recordset1 = $_GET['Buscar'];
}
mysql_select_db($database_Topspot, $Topspot);
$query_Recordset1 = sprintf("SELECT * FROM cliente WHERE Nombre = %s", GetSQLValueString($colname_Recordset1, "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Topspot) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>Resultados de la busqueda</p>
<p>&nbsp;</p>
<table border="1">
  <tr>
    <td>Nombre</td>
    <td>Apellido Paterno</td>
    <td>Apellido Materno</td>
    <td>Telefono</td>
    <td>Celular</td>
    <td>Direccion</td>
    <td>Correo Electronico</td>
    <td>Usuario</td>
    <td>Contraseña</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['Nombre']; ?></td>
      <td><?php echo $row_Recordset1['Apellido_Paterno']; ?></td>
      <td><?php echo $row_Recordset1['Apellido_Materno']; ?></td>
      <td><?php echo $row_Recordset1['Numero_Telefonico']; ?></td>
      <td><?php echo $row_Recordset1['Numero_Celular']; ?></td>
      <td><?php echo $row_Recordset1['Direccion']; ?></td>
      <td><?php echo $row_Recordset1['Correo_Electronico']; ?></td>
      <td><?php echo $row_Recordset1['Nom_Usuario']; ?></td>
      <td><?php echo $row_Recordset1['Contrasena']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
