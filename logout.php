<?php (!isset($_SEESION))? session_start():"";?>
<?php 
$_SEESION['login']=null;
$_SEESION['emailid']=null;
$_SEESION['email']=null;
$_SEESION['cname']=null;
unset($_SESSION['login']);
unset($_SESSION['emailid']);
unset($_SESSION['email']);
unset($_SESSION['cname']);
$sPath="index.php";
header(sprintf("Location: %s", $sPath));
?>