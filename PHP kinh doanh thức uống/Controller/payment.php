<?php
    if (isset($_SESSION["Customer"])&&isset($_POST["totalmoney"])) {
        $bill = new bill();
        $ID_Bill = $bill->insertOrder($_SESSION["Customer"]['ID_kh'],$_POST["totalmoney"]);
        $_SESSION["ID_Bill"] = $ID_Bill;
        foreach ($_SESSION["cart"] as $key => $item) {
            $ID_Detail_Bill = $bill->insertOrderDetail($item["idhh"], $item["idsize"], $ID_Bill[0], $item["amount"], $item["note"], $item["totalprice"]);
            foreach ($item["idtopping"] as $i => $topping) {
                $bill->insertToppingDetail($ID_Detail_Bill[0], $topping);
            }
        }
        $_SESSION["cart"]=[];
        include_once "./View/payment.php";
    } elseif (isset($_POST["totalmoney"])) {
        echo "<script>alert('Bạn chưa đăng nhập')</script>";
        include_once "View/login.php";
        echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=login'/>";
    } else {
        echo "<script>alert('Bạn chưa có giỏ hàng')</script>";
        echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=thucuong&action=1'/>";
    }
?>