<?php

$a =5;
echo "start = ".$a;

function num()
{
    //$a=2;
    
    echo "num = ".$GLOBALS['a'];

    $GLOBALS['a'] = 6;
}

num();
echo "end = ".$a;

echo "<br>";
echo $_SERVER['REQUEST_URI'];