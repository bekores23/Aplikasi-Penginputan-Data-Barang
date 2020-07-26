
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
	width: 200px;
	height: 190px;
	z-index: 1;
	left: 459px;
	top: 254px;
}
    #apDiv2 {
	position: absolute;
	width: 438px;
	height: 115px;
	z-index: 1;
	left: 1px;
	top: 295px;
}
    body {
	background-image: url(img%20web/WALLPAPER.png);
}
    </style>
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

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM register";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inputan.php";
  $MM_redirectLoginFailed = "LOGIN_GAGAL.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);
  
  $LoginRS__query=sprintf("SELECT email, password FROM register WHERE email=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<div id="apDiv1">
  <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
    <table width="438" border="0">
      <tr>
        <td width="86" height="55"><p>&nbsp;</p>
        <p>Email</p></td>
        <td width="342"><label for="textfield5"></label>
          <input class="form-control form-control-sm" type="text" name="user"placeholder="Periksa Kembali Email"></td>
      </tr>
      <tr>
        <td height="66"><p>&nbsp;</p>
        <p>Password</p></td>
        <td><input class="form-control form-control-sm" type="password" name="pass" placeholder="Periksa Kembali Password "></td>
      </tr>
      <tr>
        <td height="39">&nbsp;</td>
        <td><button type="submit" class="btn btn-secondary btn-sm">Login</button>
          <button type="reset" class="btn btn-info btn-sm">Reset</button>
          <button type="" class="btn btn-light btn-sm"><a href="RG_NEW_Inputan.php">Registrasi</button>
        </td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
  </form>
  <?php
mysql_free_result($Recordset1);
?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</div>
<p>&nbsp;</p>
<p align="center"><img src="img web/LOGIN GAGAL.png" alt="" width="1000" height="750" usemap="#Map">
  <map name="Map">
    <area shape="rect" coords="15,219,157,257" href="halaman utama.php">
  </map>
</p>
</body>
</html>