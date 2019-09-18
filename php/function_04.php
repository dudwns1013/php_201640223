<?php

//선언
function korean(){
    // 함수의 내용
    echo "안녕하세요.";
}

function english(){
    // 함수의 내용
    echo "hello.";
}

$lang = "en";
if($lang=="ko") {
    $fff="korean";
}
else
    $fff="english";

// 가변함수
$fff();