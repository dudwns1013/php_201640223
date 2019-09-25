<?php
/**
 * 변수 + 함수 = 캡슐화
 * 함수 => 메소드
 * 변수 => 프로퍼티
 */
class left
{
    public $name;
    // 상수 2가지.
    const ENGLISH = "en";

    // 메소드
    function greeting()
    {
        echo "left hello<br>";
    }

    function daelim()
    {
        echo "대림대학교<br>";
    }
}
