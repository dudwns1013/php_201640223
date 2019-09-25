<?php

abstract class greeting
{
    abstract public function hello();

    public function pages()
    {
        echo "페이지출력";
    }
}

class daelim extends greeting
{
    public function hello()
    {
        echo "그냥 해....";
    }
}

$obj = new daelim;
$obj->hello();
$obj->pages();