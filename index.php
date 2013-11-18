<?php
use \avatarnewyork\pagerdutysayswebhook;
include("classes/pagerdutysays.php");

$pds = new pagerdutysayswebhook\PagerDutySays($HTTP_RAW_POST_DATA);
$pds->say();

?>