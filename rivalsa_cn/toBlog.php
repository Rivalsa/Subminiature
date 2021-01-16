<?php
$articleid = (isset($_GET["articleid"]) && is_numeric($_GET["articleid"])) ? $_GET["articleid"] : "";
if($articleid)
    $goto = "https://www.rivalsa.net/blog/index.php?a=".$_GET["articleid"];
else
    $goto = "https://www.rivalsa.net/blog/index.php";
header("location:$goto", true, 301);
?>