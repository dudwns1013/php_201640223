<?php

class aaa
{
    use abcd;
}

trait abcd
{
    public function join()
    {
        echo "나도 끼워줘...";
    }
}

$obj=new aaa;
$obj->join();