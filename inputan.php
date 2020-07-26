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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO barang (ID, Nama, Jml, Harga, Suplier, Tanggal) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ID'], "int"),
                       GetSQLValueString($_POST['Nama'], "text"),
                       GetSQLValueString($_POST['Jml'], "text"),
                       GetSQLValueString($_POST['Harga'], "text"),
                       GetSQLValueString($_POST['Suplier'], "text"),
                       GetSQLValueString($_POST['Tanggal'], "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "tampilkan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM barang";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_register = 10;
$pageNum_register = 0;
if (isset($_GET['pageNum_register'])) {
  $pageNum_register = $_GET['pageNum_register'];
}
$startRow_register = $pageNum_register * $maxRows_register;

mysql_select_db($database_koneksi, $koneksi);
$query_register = "SELECT * FROM register";
$query_limit_register = sprintf("%s LIMIT %d, %d", $query_register, $startRow_register, $maxRows_register);
$register = mysql_query($query_limit_register, $koneksi) or die(mysql_error());
$row_register = mysql_fetch_assoc($register);

if (isset($_GET['totalRows_register'])) {
  $totalRows_register = $_GET['totalRows_register'];
} else {
  $all_register = mysql_query($query_register);
  $totalRows_register = mysql_num_rows($all_register);
}
$totalPages_register = ceil($totalRows_register/$maxRows_register)-1;
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
    body {
	background-image: url();
	background-color: #FFF;
}
    #apDiv1 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;
}
    #apDiv2 {
	position: absolute;
	width: 200px;
	height: 115px;
	z-index: 1;
}
    #apDiv3 {
	position: absolute;
	width: 526px;
	height: 418px;
	z-index: 2;
	left: 430px;
	top: 213px;
}
    #apDiv4 {
	position: absolute;
	width: 200px;
	height: 38px;
	z-index: 3;
	left: 196px;
	top: 189px;
}
    #apDiv5 {
	position: absolute;
	width: 166px;
	height: 93px;
	z-index: 3;
	left: 177px;
	top: 173px;
	font-style: italic;
	font-weight: bold;
}
    #apDiv5 table tr td br {
	font-size: 18px;
}
    #apDiv5 table tr td table tr td h6 marquee {
	color: #2D97C1;
}
    #apDiv5 table tr td table tr td h6 marquee {
	font-weight: bold;
}
    #apDiv5 table tr td table tr td h6 marquee {
	font-size: 12px;
}
    #apDiv5 table tr td table tr td h6 marquee {
	font-size: 36px;
}
    #apDiv5 table tr td table tr td h6 marquee {
	font-size: 16px;
	color: #000;
}
    #apDiv5 table tr td table tr td {
	color: #F00;
}
    </style>
    <title>Aplikasi Inputan Barang</title>
</head>
  <body>
  <div id="apDiv5">
    <table width="208" border="0">
      <?php do { ?>
        <tr>
          <td><h9 align="right"><br>
          </h9>
            <table width="164" border="0">
              <tr>
                <td><font size="5">
                  <h6>
                    <marquee blink>
                    telah login&quot;<?php echo $row_register['nama']; ?>&quot;
                    </marquee>
                </h6>                  
                <h6><marquee blink></marquee></h6></td>
              </tr>
            </table>
            <p>              <br>
            </p>
</td>
        </tr>
        <?php } while ($row_register = mysql_fetch_assoc($register)); ?>
    </table>
  </div>
  
  
  <h3 align="center"><a href="LOGIN.php"></a></h3>
  <p align="center">&nbsp;</p>
  <p align="center"><a href="LOGIN.php"><img src="img web/DESAIGNWEB.png" alt="" width="1000" height="750" usemap="#Map"></a>
    <map name="Map">
      <area shape="rect" coords="8,172,80,200" href="LOGIN.php">
      <area shape="rect" coords="92,172,156,200" href="halaman utama.php">
      <area shape="rect" coords="16,219,150,256" href="halaman utama.php">
      <area shape="rect" coords="18,273,151,309" href="inputan.php">
      <area shape="rect" coords="8,327,161,365" href="tampilkan.php">
      <area shape="rect" coords="92,176,130,190" href="#">
    </map>
  </p>
  <div id="apDiv3">
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <p align="center">&nbsp;</p>
      <table width="598" height="283" align="center">
        <tr valign="baseline">
          <td width="91" align="right" nowrap><div align="left">ID</div></td>
          <td width="495"><input class="form-control form-control-sm" type="text" name="ID" placeholder="Silahkan Masukan ID"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Nama</div></td>
          <td><input class="form-control form-control-sm" type="text" name="Nama" placeholder="Silahkan Masukan Nama"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Jumlah</div></td>
          <td><input class="form-control form-control-sm" type="text" name="Jml" placeholder="Silahkan Masukan Jumlah"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Harga</div></td>
          <td><input class="form-control form-control-sm" type="text" name="Harga" placeholder="Silahkan Masukan Harga"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Suplier</div></td>
          <td><select name="Suplier">
            <option value="Toko 1" >Toko 1</option>
            <option value="Toko 2" selected="selected" >Toko 2</option>
            <option value="Toko 3" >Toko 3</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Tanggal </div></td>
          <td><input type="date" name="Tanggal" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><button type="submit" class="btn btn-secondary btn-sm" onClick="Apakah anda yakin data ini sudah benarr">Tambahan Data</button>
            <button type="reset" class="btn btn-primary btn-sm">Reset</button>
            <a href="tampilkan.php"><img src="img web/clipboard.png" alt="" width="35" height="35"></a></td>
        </tr>
      </table>
      <h6><input type="hidden" name="MM_insert" value="form1">
    </h6></form>
    <h6><br />
  </h6></div>
  <div align="center">
    <h6><!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </h6><p>&nbsp;</p>
    <p>&nbsp;</p>
  
      
  </div>
  </body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($register);
?>
