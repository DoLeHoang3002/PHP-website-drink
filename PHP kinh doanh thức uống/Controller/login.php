<?php
    if ($_GET["menu"] == "login" && isset($_POST["Username"]) && isset($_POST["Password"])) {
        $db = new database();
        $cookie_value = $db->getList("select * from khachhang where username like '".$_POST['Username']."%' and password like '".md5("DLH".$_POST['Password']."STHK")."%'");
        if (count($cookie_value) !== 0) {
            print_r($cookie_value[0]);
            $_SESSION["Customer"] = $cookie_value[0];
            echo "<meta http-equiv='refresh' content='0; url=./index.php'/>";
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!')</script>";;
        }
    }
    include_once "View/login.php";
?>