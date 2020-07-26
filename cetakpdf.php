

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

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset2 = "SELECT * FROM register";
$Recordset2 = mysql_query($query_Recordset2, $koneksi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
	background-image: url(img%20web/WALLPAPER.png);
	background-color: #89D9B6;
	background-repeat: repeat-y;
}
    </style>
<?php
  header ("Content-type: application/vnd.ms-word");
  header ("Content-disposition: attachment; filename=Hasil-Download/InputanDATA-Barang.doc");
  ?>
<body>
<h3 align="center">DOWNLOAD <em>&quot;HASIL INPUTAN DATA&quot;</em></h3>
<h5><br />
  
  <em>Tercatat Login!</em></h5>
<div align="left">
  <table width="270" border="0">
    <tr>
      <td width="60"><h5><strong>Nama </strong></h5></td>
      <td width="130"><h5><?php echo $row_Recordset2['nama']; ?></h5></td>
    </tr>
    <tr>
      <td><h5><strong>Email </strong></h5></td>
      <td><h5><?php echo $row_Recordset2['email']; ?></h5></td>
    </tr>
  </table>
</div>
<div align="center">
  <table class="table">
  <tr class="table-info">
    <td height="28" colspan="6" bgcolor="#FFFFFF"><p>&nbsp;</p></td>
    </tr>
  <tr class="table-info">
      <td width="105" height="28" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>ID</strong></h5>
      </div></td>
      <td width="191" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>Nama</strong></h5>
      </div></td>
      <td width="185" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>Jumlah</strong></h5>
      </div></td>
      <td width="126" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>Harga</strong></h5>
      </div></td>
      <td width="131" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>Suplier</strong></h5>
      </div></td>
      <td width="136" bgcolor="#FFFFFF"><div align="center">
        <h5><strong>Tanggal</strong></h5>
      </div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td height="46" bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['ID']; ?></h5>
        </div></td>
        <td bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['Nama']; ?></h5>
        </div></td>
        <td bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['Jml']; ?></h5>
        </div></td>
        <td bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['Harga']; ?></h5>
        </div></td>
        <td bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['Suplier']; ?></h5>
        </div></td>
        <td bgcolor="#8CD9B7"><div align="center">
          <h5><?php echo $row_Recordset1['Tanggal']; ?></h5>
        </div></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <p class="table-primary">&nbsp;</p>
  
  
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


