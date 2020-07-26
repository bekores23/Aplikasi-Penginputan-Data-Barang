<?php require_once('Connections/koneksi.php'); ?>
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

$maxRows_cari_barang = 10;
$pageNum_cari_barang = 0;
if (isset($_GET['pageNum_cari_barang'])) {
  $pageNum_cari_barang = $_GET['pageNum_cari_barang'];
}
$startRow_cari_barang = $pageNum_cari_barang * $maxRows_cari_barang;

$colname_cari_barang = "-1";
if (isset($_GET['Nama'])) {
  $colname_cari_barang = $_GET['Nama'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_cari_barang = sprintf("SELECT * FROM barang WHERE Nama = %s", GetSQLValueString($colname_cari_barang, "text"));
$query_limit_cari_barang = sprintf("%s LIMIT %d, %d", $query_cari_barang, $startRow_cari_barang, $maxRows_cari_barang);
$cari_barang = mysql_query($query_limit_cari_barang, $koneksi) or die(mysql_error());
$row_cari_barang = mysql_fetch_assoc($cari_barang);

if (isset($_GET['totalRows_cari_barang'])) {
  $totalRows_cari_barang = $_GET['totalRows_cari_barang'];
} else {
  $all_cari_barang = mysql_query($query_cari_barang);
  $totalRows_cari_barang = mysql_num_rows($all_cari_barang);
}
$totalPages_cari_barang = ceil($totalRows_cari_barang/$maxRows_cari_barang)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
Cari Nama Barang
  <label for="cari"></label>
  <input type="text" name="cari" id="cari" />
  <input type="submit" name="Cari" id="button" value="Cari" />
</form>
</body>
</html>
<?php
mysql_free_result($cari_barang);
?>
