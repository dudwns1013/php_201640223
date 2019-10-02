<?php

echo "파일 목록을 출력합니다.";

$path="./";
files($path);

function files($path){
    $files = scandir($path);
    // print_r($files);
    for($i=0;$i<count($files);$i++){
        if($files[$i]==".." || $files[$i]==".git"){
            continue;
        }
        if(is_dir($files[$i])){
            echo "<b>".$files[$i]."</b><br>";
            files($path.DIRECTORY_SEPARATOR.$files[$i]);
        }else{
            echo $files[$i]."<br>";
        }
        
    }
}
