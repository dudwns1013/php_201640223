<?php
// 1단계 선언
class foo
{
    // 변수, 함수
    public $name; // 프러퍼티
    public static $daelim="대림대학교";

    public function hello()
    {
        echo self::$daelim.">>";
        echo $this->name."짱이에요<br>";
        return $this;
    }

    public function greeting()
    {
        echo "반가와요<br>";
        return $this;
    }
}

// 2단계 생성
$obj1 = new foo;
$obj1->name="대림이"; // 객체 프러퍼티 값을 저장
$obj1->hello();

$obj2 = new foo;
$obj2->name="대숙이";
$obj2->hello();

foo::$daelim="우주최강";
$obj1->hello();
$obj2->hello();

/**  //3단계 호출
*$result = $obj->hello(); // $this
* // $result == $this == $obj
*$result->hello();
*$result->hello()->greeting();

* // 1단계 선언
*class bar
*{
    *public static $name;

    *public static function username()
   * {
  *      echo self::$name."입니다.";
 *   }
*}

*bar::$name= "고정값";
*bar::username();
*/