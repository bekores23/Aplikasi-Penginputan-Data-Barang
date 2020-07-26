

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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM barang ORDER BY ID ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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
	background-color: #FFFFFF;
	background-repeat: repeat-y;
}
    </style>

  <title>Halaman Inputan Data</title>

<body>
<h3 align="center">HASIL INPUTAN DATA<br />
</h3>
<div align="center">
  <table width="81%" class="table">
  <tr class="table-info">
      <td width="107" bgcolor="#FFFFFF"><div align="center">
        <h5>ID</h5>
      </div></td>
      <td width="133" bgcolor="#FFFFFF"><div align="center">
        <h5>Nama</h5>
      </div></td>
      <td width="138" bgcolor="#FFFFFF"><div align="center">
        <h5>Jumlah</h5>
      </div></td>
      <td width="155" bgcolor="#FFFFFF"><div align="center">
        <h5>Harga</h5>
      </div></td>
      <td width="168" bgcolor="#FFFFFF"><div align="center">
        <h5>Suplier</h5>
      </div></td>
      <td width="171" bgcolor="#FFFFFF"><div align="center">
        <h5>Tanggal</h5>
      </div></td>
      <td width="152" bgcolor="#FFFFFF"><div align="center">
        <h5>
          <button type="" class="btn btn-light btn-sm">
          <a href="cetakpdf.php"> Download</h5>
         
      </div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td bgcolor="#8CD9B7"><div align="center"><?php echo $row_Recordset1['ID']; ?>.</div></td>
        <td bgcolor="#8CD9B7"><div align="center"><?php echo $row_Recordset1['Nama']; ?></div></td>
        <td bgcolor="#8CD9B7"><div align="center"><?php echo $row_Recordset1['Jml']; ?> Stok</div></td>
        <td bgcolor="#8CD9B7"><div align="center">Rp.<em><?php echo $row_Recordset1['Harga']; ?></em></div></td>
        <td bgcolor="#8CD9B7"><div align="center">Dari - <?php echo $row_Recordset1['Suplier']; ?></div></td>
        <td bgcolor="#8CD9B7"><div align="center">Pada <?php echo $row_Recordset1['Tanggal']; ?></div></td>
        <td bgcolor="#8CD9B7"><div align="center"><a href="delete.php?ID=<?php echo $row_Recordset1['ID']; ?>"><img src="img web/icon (1).png" width="28" height="28" /></a><a href="edit.php?ID=<?php echo $row_Recordset1['ID']; ?>"><img src="img web/icon (2).png" width="28" height="28" /></a><a href="inputan.php"><img src="img web/add-file.png" width="30" height="30"></a></div></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <p align="right" class="table-primary">&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


