<?php
session_start();

$_SESSION["username"]="대남이";

setcookie("mynum","",time()+(86400*30),"/");