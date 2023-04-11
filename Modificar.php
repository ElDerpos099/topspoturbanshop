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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE cliente SET Nombre=%s, Apellido_Paterno=%s, Apellido_Materno=%s, Numero_Telefonico=%s, Numero_Celular=%s, Direccion=%s, Correo_Electronico=%s, Contrasena=%s WHERE Nom_Usuario=%s",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Apellido_Paterno'], "text"),
                       GetSQLValueString($_POST['Apellido_Materno'], "text"),
                       GetSQLValueString($_POST['Numero_Telefonico'], "int"),
                       GetSQLValueString($_POST['Numero_Celular'], "int"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Correo_Electronico'], "text"),
                       GetSQLValueString($_POST['Contrasena'], "text"),
                       GetSQLValueString($_POST['Modificar'], "text"));

  mysql_select_db($database_Topspot, $Topspot);
  $Result1 = mysql_query($updateSQL, $Topspot) or die(mysql_error());

  $updateGoTo = "Consulta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['A'])) {
  $colname_Recordset1 = $_GET['A'];
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
<p>Actualizar registro de clientes</p>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>
    <label for="Nom_Usuario">Usuario</label>
    <input name="Nom_Usuario" type="text" id="Nom_Usuario" value="<?php echo $row_Recordset1['Nom_Usuario']; ?>" />
  </p>
  <p>
    <label for="Nombre">Nombre</label>
    <input name="Nombre" type="text" id="Nombre" value="<?php echo $row_Recordset1['Nombre']; ?>" />
  </p>
  <p>
    <label for="Apellido_Paterno">Apellido Paterno</label>
    <input name="Apellido_Paterno" type="text" id="Apellido_Paterno" value="<?php echo $row_Recordset1['Apellido_Paterno']; ?>" />
  </p>
  <p>
    <label for="Apellido_Materno">Apellido Materno</label>
    <input name="Apellido_Materno" type="text" id="Apellido_Materno" value="<?php echo $row_Recordset1['Apellido_Materno']; ?>" />
  </p>
  <p>
    <label for="Direccion">Direccion</label>
    <input name="Direccion" type="text" id="Direccion" value="<?php echo $row_Recordset1['Direccion']; ?>" />
  </p>
  <p>
    <label for="Numero_Celular">Celular</label>
    <input name="Numero_Celular" type="text" id="Numero_Celular" value="<?php echo $row_Recordset1['Numero_Celular']; ?>" />
  </p>
  <p>
    <label for="Numero_Telefonico">Telefono</label>
    <input name="Numero_Telefonico" type="text" id="Numero_Telefonico" value="<?php echo $row_Recordset1['Numero_Telefonico']; ?>" />
  </p>
  <p>
    <label for="Correo_Electronico">Correo Electronico</label>
    <input name="Correo_Electronico" type="text" id="Correo_Electronico" value="<?php echo $row_Recordset1['Correo_Electronico']; ?>" />
  </p>
  <p>
    <label for="Contrasena">contraseña</label>
    <input name="Contrasena" type="text" id="Contrasena" value="<?php echo $row_Recordset1['Contrasena']; ?>" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Actualizar" />
    <input name="Modificar" type="hidden" id="Modificar" value="<?php echo $row_Recordset1['Nom_Usuario']; ?>" />
  </p>
  <input type="hidden" name="MM_update" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
