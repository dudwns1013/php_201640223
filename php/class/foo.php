<?php

class foo
{
    public static $aaa="foo hahaha";

    public static function hello(){
        echo self::$aaa;
    }
}