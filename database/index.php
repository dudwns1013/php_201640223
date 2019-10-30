<?php

$config = include "dbconf.php";

require "database.php";
require "table.php";

$db = new Database($config);
echo "<br>";

$query = "SHOW TABLES";
$result = $db->queryExecute($query);
$count = mysqli_num_rows($result);

for($i=0;$i<$count;$i++){
    $row = mysqli_fetch_object($result);
    echo $row->Tables_in_php."<br>";
}