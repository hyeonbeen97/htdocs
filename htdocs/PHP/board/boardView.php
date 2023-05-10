<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <?php include "../include/head.php" ?>
</head>
<body class="gray">
    
    <?php include "../include/skip.php" ?>
    <!-- skip -->


    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" class="container">
        <div class="intro__inner center container ">
            <picture class="intro__images small">
                <source srcset="../assets/img/join01.png, assets/img/join01@2x.png 2x, assets/img/join01@3x.png 3x" />
                <img src="../assets/img/join01.png" alt="회원가입 이미지">
            </picture>
            <h2>게시글 작성하기</h2>
            <p class="intro__text">
                웹디자이너,웹퍼블리셔,프론트앤드 개발자를 위한 게시판입니다.<br>
                관련된 문의사항은 여기서 확인하세요!
            </p>
        </div>
                <!-- board__inner -->

        <div class="board__inner">
            <div class="board__view">
                <table>
                    <colgroup>
                        <col style="width:20%">
                        <col style="width:80%">
                    </colgroup>
                    <tbody>
                        <!-- <tr>
                            <th>제목</th>
                            <td>게시판 제목입니다.</td>
                        </tr>
                        <tr>
                            <th>등록자</th>
                            <td>김현빈</td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td>2024-04-24</td>
                        </tr>
                        <tr>
                            <th>조회수</th>
                            <td>100</td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>
                                프론트 앤드 개발자 취업 노하우<br><br>
    
                                프론트 앤드 개발자로 취업하고자 한다면, 다음과 같은 노하우를 참고해 보세요.
                                학습과 경험: 프론트 앤드 개발자로 취업하기 위해서는 HTML, CSS, JavaScript 등의 프로그래밍 언어와 웹 기술들에 대한 깊은 이해와 경험이 필요합니다. 이를 위해서는 관련 학과나 강의를 수강하거나, 온라인 강의나 서적 등으로 스스로 학습하며, 실제 프로젝트에 참여하는 등의 경험을 쌓아나가는 것이 중요합니다.
                                포트폴리오: 포트폴리오는 취업 시 중요한 역할을 합니다. 스스로 만든 프로젝트를 포트폴리오로 제출하거나, 개인 웹사이트나 GitHub 등을 통해 자신의 실력을 어필할 수 있습니다. 이때, 만들어진 프로젝트가 기업과 관련이 있는 것이 좋으며, 퀄리티 높은 UI/UX가 반영되어야 합니다.
                                자기소개서와 면접: 이력서와 자기소개서를 작성할 때에는 구체적인 개발 경험과 프로젝트에 대한 내용을 자세하게 작성하고, 어떤 기술과 도구를 사용해왔는지 명확하게 기술하여야 합니다. 면접 시에는 기본적인 개발 기술과 경험에 대한 질문을 기본으로, 실무에서 발생할 수 있는 문제에 대한 해결능력과 협업 능력을 어필하는 것이 좋습니다.
                            </td>
                        </tr> -->

<?php
            $boardID = $_GET['boardID'];

            //보드뷰 +1 
            $sql = "UPDATE board SET boardview = boardView + 1 WHERE boardID = {$boardID}";
            $connect -> query($sql);

            if (isset($_GET['boardID'])) {
                $boardID = $_GET['boardID'];
                //echo $boardID;
                $sql = "SELECT b.boardContents, b.boardTitle, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(m.memberID = b.memberID) WHERE b.boardID = {$boardID}";
                $result = $connect -> query($sql);
                if($result){
                    $info = $result -> num_rows;
                    if($info > 0){
                        $info = $result -> fetch_array(MYSQLI_ASSOC);
                        echo "<tr><th>".'제목'."</th>";
                        echo "<td>".$info['boardTitle']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>".'등록자'."</th>";
                        echo "<td>".$info['youName']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>".'등록일'."</th>";
                        echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>".'조회수'."</th>";
                        echo "<td>".$info['boardView']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>".'내용'."</th>";
                        echo "<td>".$info['boardContents']."</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
            }
?>
                    </tbody>
                </table>
            </div>
            <div class="board__btn mb100">
                <a href="boardModify.php?boardID=<?=$_GET['boardID']?>" class="btnstyle3">수정하기</a>
                <a href="boardRemove.php?boardID=<?=$_GET['boardID']?>" class="btnstyle3" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                <a href="board.php" class="btnstyle3">목록보기</a>
            </div>
        </div>
    </main>

    <?php include "../include/footer.php" ?>
</body>
</html>