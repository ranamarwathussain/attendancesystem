<?php
if (!isset($_SESSION["userId"]))
{
  echo "<script type = \"text/javascript\">
  window.location = (\"../index.php\");
  </script>";

}
?>