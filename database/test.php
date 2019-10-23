<?php

// 싱글턴 패턴
class Test{
    private function __construct(){
        echo "테스트 객체";
    }

    public static $instance;
    public static function make(){

        // 재사용 = 공유
        // 플라이웨이트 패턴
        // 플라이웨이트 패턴 = 배열(다중공유)
        // 레지스터리 패턴, 컨테이너...
        if(!self::$instance){
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    // 팩토리 패턴
    // 객체를 생성해 주는 역할.
    public function factory($name){
        return new $name;
    }

    // 전략 패턴
    public function strage(object $algorism){
        $this->A = $algorism;
    }

    //24개....
}