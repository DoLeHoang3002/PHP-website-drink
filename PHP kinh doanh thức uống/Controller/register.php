<?php
    if ($_GET["menu"] === "register" && isset($_POST["Name_kh"]) && isset($_POST["Username"]) && isset($_POST["Password"])
    && isset($_POST["Re_Password"]) && isset($_POST["Email"]) && isset($_POST["Address"]) && isset($_POST["Phonenumber"])){
        $success = true;
        $regis = new register();
        if (!preg_match('/^[a-z0-9]+.+$/i', $_POST["Username"])) {
            $regis->alert_str("Tên tài khoản không hợp lệ!");
            $success = false;
        }
        if (count($regis->getUsername($_POST["Username"])) !== 0) {
            $regis->alert_str("Tên tài khoản đã tồn tại!");
            $success = false;
        }
        if ($_POST["Password"] !== $_POST["Re_Password"]) {
            $regis->alert_str("Mật khẩu nhập lại không đúng!");
            $success = false;
        }
        if (!preg_match('/^[0-9]{10}$/', $_POST["Phonenumber"])) {
            $regis->alert_str("Số điện thoại không hợp lệ!");
            $success = false;
        }
        if ($success) {
            $regis->addCustomer($_POST["Name_kh"],$_POST["Username"],md5("DLH".$_POST["Password"]."STHK"),$_POST["Email"],$_POST["Address"],$_POST["Phonenumber"]);
            echo "<meta http-equiv='refresh' content='0; url=./index.php'/>";
        } else {
            echo "<script>alert(`".$alert_str."`)</script>";
        }
    }
    include_once "View/register.php";
?>