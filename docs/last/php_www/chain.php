<?php

class test{
    public function __construct(){
        // 생성자
        echo "1";
    }

    public function a(){
        echo "a";
        return $this;
    }

    public function b(){
        echo "b";
    }
}



$obj = new test;
$obj->a()->b(); //메소드체인

