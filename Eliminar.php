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

if ((isset($_GET['Eliminar'])) && ($_GET['Eliminar'] != "")) {
  $deleteSQL = sprintf("DELETE FROM cliente WHERE Nom_Usuario=%s",
                       GetSQLValueString($_GET['Eliminar'], "text"));

  mysql_select_db($database_Topspot, $Topspot);
  $Result1 = mysql_query($deleteSQL, $Topspot) or die(mysql_error());

  $deleteGoTo = "Consulta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['B'])) {
  $colname_Recordset1 = $_GET['B'];
}
mysql_select_db($database_Topspot, $Topspot);
$query_Recordset1 = sprintf("SELECT * FROM cliente WHERE Nom_Usuario = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $Topspot) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>Eliminar registros </p>
<table width="418" height="489" border="1">
  <tr>
    <td width="168">Nombre</td>
    <td width="262"><?php echo $row_Recordset1['Nombre']; ?></td>
  </tr>
  <tr>
    <td>Apellido paterno</td>
    <td><?php echo $row_Recordset1['Apellido_Paterno']; ?></td>
  </tr>
  <tr>
    <td>Apellido materno </td>
    <td><?php echo $row_Recordset1['Apellido_Materno']; ?></td>
  </tr>
  <tr>
    <td>Dirección</td>
    <td><?php echo $row_Recordset1['Direccion']; ?></td>
  </tr>
  <tr>
    <td>Correo</td>
    <td><?php echo $row_Recordset1['Correo_Electronico']; ?></td>
  </tr>
  <tr>
    <td>Celular</td>
    <td><?php echo $row_Recordset1['Numero_Celular']; ?></td>
  </tr>
  <tr>
    <td>telefono </td>
    <td><?php echo $row_Recordset1['Numero_Telefonico']; ?></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><?php echo $row_Recordset1['Nom_Usuario']; ?></td>
  </tr>
  <tr>
    <td>Contraseña</td>
    <td><?php echo $row_Recordset1['Contrasena']; ?></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="Consulta.php">
      <input type="submit" name="button" id="button" value="Cancelar" />
    </form></td>
    <td><form id="form2" name="form2" method="get" action="">
      <input type="submit" name="button2" id="button2" value="Borrar" />
      <input name="Eliminar" type="hidden" id="Eliminar" value="<?php echo $row_Recordset1['Nom_Usuario']; ?>" />
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
