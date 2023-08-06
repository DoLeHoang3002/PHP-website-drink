<?php
    session_start();
    include_once "./Model/database.php";
    include_once "./Model/thucuong.php";
    include_once "./Model/cart.php";
    include_once "./Model/register.php";
    include_once "./Model/exit.php";
    include_once "./Model/payment.php";
    include_once "./Model/binhluan.php";
    include_once "./Model/menu.php";
    include_once "./Model/type.php";
    include_once "./Model/class.phpmailer.php";
    include_once "./Model/class.smtp.php";
    include_once "./Model/uploadimage.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9918c75053.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Content/CSS/styles.css">
</head>
<body>
    <?php
        include_once 'Controller/header.php';
        if (isset($_GET['menu'])) {
            switch ($_GET['menu']) {
                case 'thucuong': include_once 'Controller/thucuong.php'; break;
                case 'cart': include_once 'Controller/cart.php'; break;
                case 'login': include_once 'Controller/login.php'; break;
                case 'register': include_once 'Controller/register.php'; break;
                case 'payment': include_once 'Controller/payment.php'; break;
                case 'forgetps': include_once 'Controller/forgetps.php'; break;
                case 'admin': include_once 'Controller/admin.php'; break;
                case 'test': include_once 'View/edithanghoa.php'; break;
            }
        } else {
            echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=thucuong&action=1'/>";
        }
        include_once "Controller/footer.php";
    ?>
</body>
</html>