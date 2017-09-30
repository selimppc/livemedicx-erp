<?php
$link = mysql_connect("localhost","root","HEDrc@2017");
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET NAMES UTF8");
mysql_query("SET SESSION collation_connection =’utf8_general_ci’");
mysql_select_db("ur2", $link);
//echo mysql_errno($link) . ": " . mysql_error($link). "\n";
?>