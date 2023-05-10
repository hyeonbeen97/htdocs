

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 완료 페이지</title>

    <?php include "../include/head.php" ?>

</head>
<body>
<?php include "../include/skip.php" ?>
    <!-- skip -->


    <?php include "../include/header.php" ?>
    <!-- header -->


    <main id="main" class="container">
        <div class="intro__inner center container bmStyle">
            <picture class="intro__images">
                <source srcset="../assets/img/joinend01.png, ../assets/img/joinend01@2x 2x, ../assets/img/joinend01@3x.png 3x" />
                <img src="../assets/img/joinend01.png" alt="회원가입 이미지">
            </picture>
            <p class="intro__text">
                <?php
    include "../connect/connect.php";



    $youEmail = $_POST['youEmail']; 
    $youName = $_POST['youName']; 
    $youPass = $_POST['youPass']; 
    $youPassC = $_POST['youPassC']; 
    $youPhone = $_POST['youPhone']; 
    $regTime = time();

    // echo $youEmail, $youName, $youPass, $youPhone;



    //메세지 출력
    function msg($alert){
        echo "<p class='intro__text'>$alert</p>";
    }

    // 이메일 유효성 검사
    $check_mail = preg_match("/^[a-z0-9_+.-]+@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/",$youEmail);

    if($check_mail == false){
        msg("이메일 잘못되었습니다. 올바른 이메일을 작성해주세요!");
        exit;
    }
    //이메일 중복검사
    $isEmailCheck = false;

    $sql = "SELECT youEmail FROM members WHERE youEmail ='$youEmail'";
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count == 0){
            $isEmailCheck = true;
        } else {
            msg("이미 회원가입이 되어있는 이메일 입니다. 로그인 해주세요!");
            exit;
        }
    } else {
        msg("에러발생1 : 관리자에게 문의하세요");
        exit;
    }

    // 이름 유효성 검사
    $check_name = preg_match("/[가-힣]{9,15}$/", $youName);
    if($check_name == false){
        msg("이름은 한글만 가능합니다. 또는 3~5글자만 가능합니다.");
        exit;
    }

    // 비밀번호 유효성 검사
    if($youPass !== $youPassC){
        msg("비밀번호가 일치하지 않습니다. 다시 한번 입력해주세요.");
        exit;
    }
    // $youPass = sha1($youPass);  
    // 휴대폰번호 유효성 검사
    $check_number = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/",$youPhone);
    if($check_number == false){
        msg("번호가 정확하지 않습니다. 올바른 번호(000-0000-0000)형식으로 작성해주세요");
        exit;
    }
    
        //휴대폰 중복검사
        $isPhoneCheck = false;

        $sql = "SELECT youPhone FROM members WHERE youPhone ='$youPhone'";
        $result = $connect -> query($sql);
    
        if($result){
            $count = $result -> num_rows;
    
            if($count == 0){
                $isEmailCheck = true;
            } else {
                msg("이미 회원가입이 되어있는 번호입니다.. 로그인 해주세요!");
                exit;
            }
        } else {
            msg("에러발생2 : 관리자에게 문의하세요");
            exit;
        }

        //회원가입
        if($isEmailCheck == true && $isPhoneCheck = true){
            //데이터 입력하기
            $sql = "INSERT INTO members(youEmail, youName, youPass, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime')";
            $connect -> query($sql);

            if($result){
                msg("회원가입을 축하합니다! 로그인 해주세요! <br> <div class='intro__btn'><a href='../login/login.php'>로그인</a></div>");
                exit;
            } else {
                msg("에러발생3: 관리자에게 문의하세요!");
                exit;
            };
            
        } else {
            msg("이미 회원가입이 되어 있습니다. 로그인 해주세요!");
            exit;
        };
    




    //사용자가 데이터 입력--> 유효성 검사(o) --> 통과 --> 회원가입(쿼리문 전송)
    //사용자가 데이터 입력--> 유효성 검사(o) --> 통과(이메일주소/핸드폰)--> 통과 --> 회원가입(쿼리문 전송)
    //사용자가 데이터 입력--> 유효성 검사(x) --> 통과 --> 회원가입(쿼리문 전송)

    
?>

        </div>
    </main>

</body>
</html>