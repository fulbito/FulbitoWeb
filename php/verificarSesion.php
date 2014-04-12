<?
 if(!isset($_SESSION['id'])) // si no esta setiado el id
 {
   $locationIndex = "./index.php";
   $tiempo =0;
   print "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"$tiempo; URL=$locationIndex\">";
 }
?>