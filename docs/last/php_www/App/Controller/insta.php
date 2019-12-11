<?php

// 네임스페이스 지정
namespace App\Controller;

// 파일명과 동일하게 클래스를 선언하며 추상클래스인 Controller 를 extends로 상속받음
class Insta extends Controller
{
  // 변수 선언
  private $db;
  private $HttpUri;
  // 생성자에 인자값으로 변수 db를 줌
  public function __construct($db)
  {
    // 선언한 변수$db를 $this로 찾아 인자값인 $db를 넣어줌
    $this->db = $db;
    // 선언한 변수 $HttpUri에 Uri.php를 연결해줌
    $this->HttpUri = new \Module\Http\Uri();
  }
  // 메인 메서드
  public function main()
  {
    // 변수 $second에 체인 메서드를 사용해 Uri.php의 second() 메서드를 가져와 넣어줌
    $second = $this->HttpUri->second();
    // 변수 $third에 체인 메서드를 사용해 Uri.php의 third() 메서드를 가져와 넣어줌
    $third = $this->HttpUri->third();
    // file_get_contents메서드를 사용해 경로에 있는 파일을 읽어와 변수 body에 넣어줌
    $body = file_get_contents("../Resource/instagram.html");
    // 세션에 email 값이 있을 경우
    if($_SESSION["email"]){
      // 두번째 주소 값이 new 인 경우
      if($second == "new"){
        // newInsert() 메서드 실행
        $this->newInsert();
      // 두번째 주소 값이 숫자인 경우
      }else if(is_numeric($second)){
        // 세번째 주소 값이 delete 인 경우
        if($third=="delete"){
          // instagram 테이블에서 아이디 값이 두번째 주소값인 데이터 삭제
          $query = "DELETE FROM instagram WHERE id=".$second;
          // 쿼리 실행
          $result = $this->db->queryExecute($query);
    
          // insta로 페이지 이동
          header("location:"."/insta");
        // 세번째 주소 값이 edit 인 경우
        }else if($third=="edit"){
          echo "데이터를 수정합니다.<br>";
          // 두번째 주소 값을 인자값으로 받는 edit() 메서드 실행
          $this->edit($second);
        // 세번째 주소 값이 delete도 edit도 아닐 경우
        }else{
          // 두번째 주소 값을 인자값으로 받는 detailview() 메서드 실행
          $this->detailView($second);
        }
      // 두번째 주소 값이 숫자도 new도 아닐 경우
      }else{
        // instagram() 메서드 실행
        $this->instagram();
      }
    // email 세션이 없을 경우  
    }else{
      // instagram.html 에 있는 머시태그를 null값으로 바꿔줌
      $body = str_replace("{{content}}","",$body);
      // 변수 loginForm에 login.html 파일내용을 넣어줌
      $loginForm = file_get_contents("../Resource/login.html");
      // instagram.html 에 있는 머시태그를 방금 생성한 $loginForm으로 교체 해줌
      $body = str_replace("{{login}}",$loginForm,$body);
      // $body 출력으로 화면에 내용 출력
      echo $body;
    }
  }
  // 인자값을 갖는 edit() 메서드 생성
  private function edit($id)
  {
      // 포스트 확인
      if ($_POST) {
          // 쿼리에 instagram 테이블의 값을 수정하는 문
          $query = "UPDATE instagram SET ";
          // 포스트의 키와 값을 분리하는 foreach
          foreach ($_POST as $key => $value) {
              // 키값과 id가 같을 경우 계속 진행
              if($key == "id") continue;
              // 쿼리에 구문을 추가하는 .= 사용해 추가로 데이터의 키와 값을 추가해 줌
              $query .= "`$key`= '".$value."',";
          }
          // rtrim을 사용해 마지막 콤마 제거
          $query = rtrim($query, ","); 
          // id 값으로 찾는 조건
          $query .= " WHERE id='".$id."'";
          // 쿼리 실행
          $result = $this->db->queryExecute($query);
          // 인자값의 페이지로 이동
          header("location:"."/insta/".$id);
      }
      // 아이디 값을 통해 instagram 테이블의 모든 데이터를 조회
      $query = "SELECT * from instagram WHERE id = ".$id;
      // 쿼리 실행
      $result = $this->db->queryExecute($query);
      // 변수 data에 쿼리의 결과를 가져옴
      $data = mysqli_fetch_object($result);
      // 변수 content에 html문인 form을 넣어줌
      $content = "<form method=\"post\">";
      // 추가로 input type을 숨김으로 넣어줌
      $content .= "<input type=\"hidden\" name=\"id\" value='$id'>";
      // 쿼리에 instagram 테이블의 정보를 넣어줌
      $query = "DESC instagram ";
      // 쿼리 실행
      $result = $this->db->queryExecute($query);
      // 쿼리 결과를 가져와서 변수 count에 넣어줌
      $count = mysqli_num_rows($result);
      // 0부터 count의 길이만큼 for문을 돌려줌
      for ($i=0;$i<$count;$i++) {
          // 변수 row 에 쿼리 결과값을 한개씩 넣어줌
          $row = mysqli_fetch_object($result);
          // row의 필드명이 id이면 계속 진행
          if($row->Field == "id") continue;
          // 필드명 키에 넣어줌
          $key = $row->Field;
          // content에 필드와 필드를 이름으로 갖고 데이터의 키를 value로 갖는 input type을 텍스트로 넣어줌
          $content .= $row->Field." <input type=\"text\" 
          name=\"".$row->Field."\" 
          value='".$data->$key."'>";
          // 줄 바꿈
          $content .= "<br>";
      }
      // content에 값을 수정으로 갖는 input type=submit을 넣어줌
      $content .= "<input type=\"submit\" value=\"수정\">";
      // a태그를 사용해 취소 라는 문자에 insta/id 즉 id의 페이지 링크를 줌
      $content .= "<a href='./insta/".$id."'>취소</a>";
      // form태그 닫기
      $content .= "</form>";
      // body 변수에 instagram_edit.html 파일내용을 넣어줌
      $body = file_get_contents("../Resource/instagram_edit.html");
      // instagram_edit.html 에 있는 머시태그인 {{edit}} 을 변수 content로 바꿔줌
      $body = str_replace("{{edit}}",$content, $body);
      echo $body;
  }

  // instagram() 메서드 생성
  private function instagram()
  {
    // 쿼리에 instagram 테이블의 데이터를 모두 선택
    $query = "SELECT * from instagram ";
    // 쿼리 실행
    $result = $this->db->queryExecute($query);
    // 쿼리 결과 가져옴
    $count = mysqli_num_rows($result);
    // content 변수 초기화
    $content = "";
    // 0부터 쿼리 결과를 넣어준 count의 길이만큼 for문 동작
    for ($i=0;$i<$count;$i++) {
        // 변수 row 에 쿼리 결과값을 한개씩 넣어줌
        $row = mysqli_fetch_object($result);
        // link 변수에 슈퍼변수 SERVER로 주소값을 받아오고 뒤에 id 값을 붙여줌
        $link = $_SERVER['REQUEST_URI']."/".$row->id;
        // 추가로 content에 가로값이 600px인 카드툴을 갖는 div
        $content .= "<div class=\"card custom-card mt-3\" style=\"width:600px\" id=\"prova\">";
        // 줄의 헤더 부분에서 패딩의 y값은 2 x 값은 3을 col의 크기는 12를 줌
        $content .= " <div class=\"row post-header col-12 py-2 px-3\">";
        $content .= "     <div class=\"col-6 float-left \">";
        // 제목인 title에 변수 link로 경로를 줌
        $content .= "       <h4><a href='$link'>".$row->title."</a></h4>";
        $content .= "     </div>";
        $content .= "   </div>";
        // 이미지 image에 변수 link로 경로를 줌
        $content .= "   <div><a href='$link'><img class=\"card-img\" src='/images/".$row->image."' alt=\"".$row->id."\"></a></div>";
        $content .= "   <div class=\"card-body px-3\">";
        // far fa-heart 는 아이콘을 받아오는 코드, 좋아요인 likes를 보여줌
        $content .= "     <h5 class=\"card-title\"><i class=\"far fa-heart\"></i> ".$row->likes." Likes</h5>";
        $content .= "   </div>";
        $content .= " </div>";
    }
    // div 닫기
    $content .= "</div>";
    // instagram.html 파일의 내용을 가져옴
    $body = file_get_contents("../Resource/instagram.html");
    // {{login}} 머시태그에 문자열과 a 태그로 로그아웃 문자에 경로를 넣어줌
    $body = str_replace("{{login}}","로그인 상태입니다. <a href='logout'>로그아웃</a>",$body);
    // {{content}} 머시태그를 위의 변수 content로 바꿔줌
    $body = str_replace("{{content}}", $content, $body);
    // {{new}} 머시태그를 경로 /insta/new 로바꿔줌
    $body = str_replace("{{new}}","/insta/new", $body);
    echo $body;
  }

  // newInsert() 메서드 생성
  private function newInsert()
  {
    // 포스트 확인
    if ($_POST) {
      // move_uploaded_file을 사용해 불러온 파일을 내가 지정하는 경로로 업로드 해줌
      move_uploaded_file($_FILES['image']['tmp_name'],"images/".$_FILES['image']['name']);
      // 쿼리에 테이블이 instagram을 불러 제목, 이미지, 내용, 좋아요 를 가지는 데이터를 새로 만들어줌 
      $query = "INSERT INTO instagram (title , image, content, likes )
                VALUE ('".$_POST['title']."','".$_FILES['image']['name']."','".$_POST['content']."',0)";
      // 쿼리 실행
      $result = $this->db->queryExecute($query);
      // insta로 가도록 링크
      header("location:"."/insta");
    }else{
      $body = file_get_contents("../Resource/instagram_new.html");
      $body = str_replace("{{content}}", $content, $body);
      $body = str_replace("{{new}}","/instaucfirst/new", $body);
      echo $body;
    }
  }

  // 인자값을 갖는 detailView 메서드 생성
  Private function detailView($uid)
  {
    // 포스트 값이 있는 경우
    if(isset($_POST)){
      // 포스트의 mode가 비어있지 않을 경우
      if($_POST['mode'] != ""){
            // 쿼리에 instagram 테이블에서 아이디 값이 인자값과 같은 데이터를 찾아 likes를 1씩 더하는 수정
            $query = "UPDATE instagram SET `likes`=`likes`+1 where id='$uid'";
            // 쿼리 실행
            $result = $this->db->queryExecute($query);
      }
    }

    // instagram 테이블에서 아이디 값으로 찾아 데이터를 모두 선택
    $query = "SELECT * from instagram WHERE id=".$uid;
    // 쿼리 실행
    $result = $this->db->queryExecute($query);
    // data 변수에 쿼리 결과를 가져옴
    $data = mysqli_fetch_object($result);
    // instagram_view.html 파일을 읽어와 변수 body 에 넣어줌
    $body = file_get_contents("../Resource/instagram_view.html");
    // {{title}} 머시태그를 데이터의 title 값으로 바꿔줌
    $body = str_replace("{{title}}", $data->title, $body);
    // {{likes}} 머시태그를 데이터의 likes 값으로 바꿔줌
    $body = str_replace("{{likes}}", $data->likes, $body);
    // {{image}} 머시태그를 데이터의 이미지로 바꿔주고 가로는 100%로 꽉차게 세로는 가로에 맞게 조절되도록 해줌
    $body = str_replace("{{image}}", "<img src='/images/".$data->image."' width='100%' height='auto'/>", $body);
    // {{content}} 머시태그를 데이터의 content 값으로 바꿔줌
    $body = str_replace("{{content}}", $data->content, $body);
    // {{new}} 머시태그를 데이터의 경로인 /insta/new 로 바꿔줌
    $body = str_replace("{{new}}","/insta/new", $body);
    // {{tablename}} 머시태그를 데이터의 인자값 $uid 값으로 바꿔줌
    $body = str_replace("{{tablename}}", $uid, $body);
    echo $body;
  }
}
