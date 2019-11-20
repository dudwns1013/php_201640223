# 수업 2019.11.06
## 수업내용 정리

![capture](./images/1.PNG)
##### Controller 폴더의 Tables.php를 복사해 Databases.php 라는 파일을 만들어주고 클래스명을 파일명과 같게 해준다.
##### 여기서 database의 목록을 가져와야 하므로 변수 row를 Tables_in_php가 아닌 Database로 연결 해준다.
#####   

![capture](./images/2.PNG)
##### Resource 폴더에서 table.html 파일을 복사 후 database.html로 이름을 바꿔주고 바디부분에 h1태그로 글을 넣어주고
##### Databases.php에서 파일 경로를 table.html이 아닌 database.php로 연결해준다.
#####   

![capture](./images/3.PNG)
##### select * from members; 로 값이 있는지 확인하고, desc로 테이블의 정보를 확인 후
##### insert 를 사용해 데이터를 넣어준다.
#####   

![capture](./images/4.PNG)
##### Controller폴더의 TableInfo.php 파일을 복사해 Select.php를 만들어주고 메인문에서 content줄까지 주석처리 후 클래스명과 파일 경로 바꿔줌
##### Resource폴더의 database.html 복사 후 select.html로 바꿔주고 h1태그 내의 문자 수정
#####   

![capture](./images/5.PNG)
##### main메서드 주석 내용중 일부분을 빼서 $query에 SELECT * from members를 넣어줌
##### 쿼리 객체로 받아오는 내용
#####   

![capture](./images/6.PNG)
##### 데이터가 있는지 없는지를 $count에 0이 있는지 다른수가 있는지로 판별하고
##### isset을 사용해 $uris 2번째 값이 있고 $uris에 값이 있는지를 이용해 테이블이 있는지 없는지 확인한다.
#####   

![capture](./images/7.PNG)
##### Module 폴더에 Http폴더 생성 후 Uri.php 파일 생성후 클래스와 생성자 코딩
#####    

![capture](./images/8.PNG)
##### Select.php에서 Uri.php 파일의 생성자 내용을 연결
#####    

![capture](./images/9.PNG)
##### Select.php에서 직접 선언하고 사용하던 uri, uris 변수 부분과 if에 들어갈 uri 조건부분을 전에 만들어준 Uri.php 파일에서 구현
#####   

![capture](./images/10.PNG)
##### 만든 Uri.php 를 Select.php에서 연결해 필요한 메서드를 가져와 사용
#####    

![capture](./images/11.PNG)
![capture](./images/12.PNG)

##### 접근제한자가 private 이며 전역변수로 $Html을 선언

##### 새로운 변수 $tableName에 $this->HttpUri->second()를 넣어주고

##### list 메서드를 새로 생성하여 메인문의 내용을 $tableName을 빼고 전부 옮겨준다.

##### 그리고 조건에 $tableName 을 넣어 단순화 시킨다. 단 변수를 한개 더 선언으로 메모리를 더 잡아먹는 방식

#####    

![capture](./images/13.PNG)
##### 조건으로 3번째 주소값이 new이면 echo 로 문자열을 출력하고 아니면 그냥 list 메소드 연결
#####    

![](./images/14.PNG)

##### select.html을 복사해서 insert.html 파일을 만들어줌

##### list 에 있던 $body 부분 코드를 newInsert로 옮겨주고 경로를 insert.html로 바꿔줌

#####    

![capture](./images/15.PNG)
##### 
#####    

![capture](./images/16.PNG)

##### insert.html에서 form태그와 input을 이용해 텍스트칸과 삽입 버튼을 넣어줌

#####    

![capture](./images/17.PNG)

##### from 태그에 이미 존재하는 메서드인 POST를 메서드로 준다.

##### POST 메서드를 주지 않으면 창이 자동으로 넘어간다.

#####    

![capture](./images/18.PNG)

##### print_r로 html에서 작성한 text칸을 배열로 보여준다.

#####    

![capture](./images/19.PNG)
##### $_POST를 작동시키면 db에 값을 바로 넣어주고 header를 이용해 창을 이동시킨다.

#####    

![capture](./images/20.PNG)

##### remote add 로 교수님 주소 연결 후 확인 후 fetch

#####    

![capture](./images/21.PNG)
##### merge로 파일을 받고 add commit push로 내 git에 올림

#####    

![capture](./images/22.PNG)

##### 받은 파일 확인

#####    

![capture](./images/23.PNG)
![capture](./images/24.PNG)

##### 변수 field와 data를 이용해 데이터를 넣는 코드

##### foreach를 이용해 키와 값을 구분 연결해주고 rtrim을 이용해 콤마 제거

##### html 의 form태그를 content변수에 넣어 텍스트입력창 구현

#####    

![capture](./images/25.PNG)
![capture](./images/26.PNG)

##### select.html에서 데이터삽입창으로 가는 버튼을 생성

##### body변수에서 만들어준 데이터삽입버튼의 이동이 작동하도록 설정

#####    