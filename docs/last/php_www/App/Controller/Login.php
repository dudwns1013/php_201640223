<?php

namespace App\Controller;

class Login extends Controller{
    private $db;
    public function __construct($db){
        // 초기화
        $this->db = $db;
    }

    public function main(){

        if($_SESSION["email"]){
            //alert("로그인 상태입니다.");
            header("location:"."/insta");
        }else{
            // 로그인 체크 및 저장
            if($_POST){
                if($_POST['email'] && $_POST['password']){

                    // 잘못된 형식의 이메일 필터
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
                        echo "잘못된 이메일 주소 입니다.";
                        exit;
                    }

                    $query = "SELECT * FROM insta_login where email='".$_POST['email']."';";
                    $result = $this->db->queryExecute($query);
                    if($row = mysqli_fetch_object($result)){
                        // 데이터베이스 조회 성공
                        if($_POST['password'] == $row->password){
                            // 로그인 성공
                            echo "로그인 성공";

                            // 세션 슈퍼변수, 값 저장
                            $_SESSION["email"] = $_POST['email'];
                            echo "세션 저장 성공";

                            // 페이지 이동
                            
                            header("location:"."/insta");
                        }else{
                            // 비밀번호가 맞지 않습니다.
                            echo "비밀번호가 맞지 않습니다.";
                            exit;
                        }
                    }else{
                        // 데이터베이스 조회 실패
                        echo $_POST['email']."는 등록된 회원이 아닙니다.";
                        exit;
                    }
                }else{
                    echo "로그인 실패";
                    echo "이메일과 비밀번호를 입력해 주세요.";
                    exit;
                    
                    // 페이지 이동
                    header("location:"."/");
                }
            }
        }
    }
}