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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Topspotus = 3;
$pageNum_Topspotus = 0;
if (isset($_GET['pageNum_Topspotus'])) {
  $pageNum_Topspotus = $_GET['pageNum_Topspotus'];
}
$startRow_Topspotus = $pageNum_Topspotus * $maxRows_Topspotus;

mysql_select_db($database_Topspot, $Topspot);
$query_Topspotus = "SELECT * FROM cliente ORDER BY Nombre ASC";
$query_limit_Topspotus = sprintf("%s LIMIT %d, %d", $query_Topspotus, $startRow_Topspotus, $maxRows_Topspotus);
$Topspotus = mysql_query($query_limit_Topspotus, $Topspot) or die(mysql_error());
$row_Topspotus = mysql_fetch_assoc($Topspotus);

if (isset($_GET['totalRows_Topspotus'])) {
  $totalRows_Topspotus = $_GET['totalRows_Topspotus'];
} else {
  $all_Topspotus = mysql_query($query_Topspotus);
  $totalRows_Topspotus = mysql_num_rows($all_Topspotus);
}
$totalPages_Topspotus = ceil($totalRows_Topspotus/$maxRows_Topspotus)-1;

$queryString_Topspotus = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Topspotus") == false && 
        stristr($param, "totalRows_Topspotus") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Topspotus = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Topspotus = sprintf("&totalRows_Topspotus=%d%s", $totalRows_Topspotus, $queryString_Topspotus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>CONSULTA GENERAL DE CLIENTES!</p>
<table width="1887" height="231" border="1">
  <tr>
    <td width="111">Apellido Materno</td>
    <td width="107">Apellido Paterno</td>
    <td width="83">Contraseña</td>
    <td width="67">Correo</td>
    <td width="77">Direccion</td>
    <td width="53">Ususario</td>
    <td width="17">Nombre</td>
    <td width="10">Celular</td>
    <td width="20">Telefono</td>
    <td width="20">Modificar</td>
    <td width="20">Eliminar</td>
  </tr>
  <?php do { ?>
    <tr>
      <td height="200"><?php echo $row_Topspotus['Apellido_Materno']; ?></td>
      <td><?php echo $row_Topspotus['Apellido_Paterno']; ?></td>
      <td><?php echo $row_Topspotus['Contrasena']; ?></td>
      <td><?php echo $row_Topspotus['Correo_Electronico']; ?></td>
      <td><?php echo $row_Topspotus['Direccion']; ?></td>
      <td><?php echo $row_Topspotus['Nom_Usuario']; ?></td>
      <td><?php echo $row_Topspotus['Nombre']; ?></td>
      <td><?php echo $row_Topspotus['Numero_Celular']; ?></td>
      <td><?php echo $row_Topspotus['Numero_Telefonico']; ?></td>
      <td><a href="Modificar.php?A=<?php echo $row_Topspotus['Nom_Usuario']; ?>">Modificar</a></td>
      <td><a href="Eliminar.php?B=<?php echo $row_Topspotus['Nom_Usuario']; ?>"><img src="icono.jpg" width="108" height="95" /></a></td>
    </tr>
    <?php } while ($row_Topspotus = mysql_fetch_assoc($Topspotus)); ?>
</table>
<p>&nbsp;
<table width="124" height="54" border="0">
  <tr>
    <td><?php if ($pageNum_Topspotus > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Topspotus=%d%s", $currentPage, 0, $queryString_Topspotus); ?>"><img src="First.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Topspotus > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Topspotus=%d%s", $currentPage, max(0, $pageNum_Topspotus - 1), $queryString_Topspotus); ?>"><img src="Previous.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Topspotus < $totalPages_Topspotus) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Topspotus=%d%s", $currentPage, min($totalPages_Topspotus, $pageNum_Topspotus + 1), $queryString_Topspotus); ?>"><img src="Next.gif" /></a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Topspotus < $totalPages_Topspotus) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Topspotus=%d%s", $currentPage, $totalPages_Topspotus, $queryString_Topspotus); ?>"><img src="Last.gif" /></a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Topspotus);
?>
