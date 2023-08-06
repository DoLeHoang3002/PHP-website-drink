<?php
    if (isset($_GET['action'])&&$_GET['action']=='order') {
        if (isset($_POST['comment'])&&$_GET['id']) {
            $bl = new binhluan();
            $bl->insertComment($_GET['id'], $_SESSION['Customer']['ID_kh'], $_POST['comment']);
        }
        include_once "./View/order.php";
    } else {
        include_once "./View/thucuong.php";
    }
?>