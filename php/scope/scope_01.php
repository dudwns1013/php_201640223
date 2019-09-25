<?php

$a =5;
echo "start = ".$a;

function num()
{
    //$a=2;
    global $a;
    echo "num = ".$a;

    $a = 6;
}

num();
echo "end = ".$a;