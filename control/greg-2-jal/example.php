<?php
require("gregorian2jalali.class.php");

$jalali = new gregorian2jalali;
echo ($jalali->gregorian_to_jalali("yy M dd D"));
?>