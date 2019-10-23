<?php

include "test.php";
$obj1 = Test::make();
$obj2 = Test::make();
$obj3 = Test::make();

// new Table1
$obj1 -> factory("Table1");

// 예로 게임 : ""
$obj1->strage("칼");
$obj1->strage("총");