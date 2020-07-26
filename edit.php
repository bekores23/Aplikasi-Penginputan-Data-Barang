







<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
    #apDiv1 {
	position: absolute;
	width: 545px;
	height: 336px;
	z-index: 1;
	left: 429px;
	top: 335px;
}
    body {
	background-image: url(img%20web/WALLPAPER.png);
}
    </style>
    <title>Hello, world!</title>
</head>
  <body>
  <h3 align="center">&nbsp;</h3>
    <br /><br />



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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE barang SET Nama=%s, Jml=%s, Harga=%s, Suplier=%s, Tanggal=%s WHERE ID=%s",
                       GetSQLValueString($_POST['Nama'], "text"),
                       GetSQLValueString($_POST['Jml'], "text"),
                       GetSQLValueString($_POST['Harga'], "text"),
                       GetSQLValueString($_POST['Suplier'], "text"),
                       GetSQLValueString($_POST['Tanggal'], "date"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "tampilkan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE barang SET Nama=%s, Jml=%s, Harga=%s, Suplier=%s, Tanggal=%s WHERE ID=%s",
                       GetSQLValueString($_POST['Nama'], "text"),
                       GetSQLValueString($_POST['Jml'], "text"),
                       GetSQLValueString($_POST['Harga'], "text"),
                       GetSQLValueString($_POST['Suplier'], "text"),
                       GetSQLValueString($_POST['Tanggal'], "date"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM barang WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<div id="apDiv1">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <p align="center"></p>
    <table width="565" align="center">
      <tr valign="baseline">
        <td width="95" align="right" nowrap="nowrap"><div align="left">ID</div></td>
        <td width="458"><?php echo $row_Recordset1['ID']; ?></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Nama</div></td>
        <td><input class="form-control form-control-sm" type="text" name="Nama" value="<?php echo htmlentities($row_Recordset1['Nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Jumlah</div></td>
        <td><input class="form-control form-control-sm" type="text" name="Jml" placeholder="Silahkan Masukan ID"value="<?php echo htmlentities($row_Recordset1['Jml'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Harga</div></td>
        <td><input class="form-control form-control-sm" type="text" name="Harga" placeholder="Silahkan Masukan ID"value="<?php echo htmlentities($row_Recordset1['Harga'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Suplier</div></td>
        <td><input class="form-control form-control-sm" type="text" name="Suplier" placeholder="Silahkan Masukan ID"value="<?php echo htmlentities($row_Recordset1['Suplier'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Tanggal</div></td>
        <td><input type="date" name="Tanggal" value="<?php echo htmlentities($row_Recordset1['Tanggal'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><button type="submit" class="btn btn-secondary btn-sm">Ubah Data</button>
          <button type="reset" class="btn btn-primary btn-sm">Reset</button>
          <a href="tampilkan.php"><img src="img web/clipboard.png" alt="" width="35" height="35" /></a></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="ID" value="<?php echo $row_Recordset1['ID']; ?>" />
  </form>
</div>
<div align="center"></div>
<div align="center">
  <p>&nbsp;</p>
  <p><img src="img web/EDIT GAMBAR.png" alt="" width="1000" height="750" usemap="#Map" border="0" />
    <map name="Map" id="Map">
      <area shape="rect" coords="15,325,153,363" href="tampilkan.php" />
      <area shape="rect" coords="10,273,145,305" href="inputan.php" />
      <area shape="rect" coords="24,218,149,256" href="halaman utama.php" />
    </map>
  </p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>







  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
