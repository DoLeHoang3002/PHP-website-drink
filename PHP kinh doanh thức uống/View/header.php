    <header class="fixed-top bg-white">
        <div class="h-top">
            <div class="container">
                <div class="row">
                    <div class="h-delivery col-2">
                        <a href="tel:18006779">
                            <img src="./Content/Image/delivery.png" alt="" srcset="">
                        </a>
                    </div>
                    <div class="h-logo text-center col-6">
                        <img src="./Content/Image/logo_3.png" alt="">
                        <img src="./Content/Image/logo_2.png" alt="">
                        <img src="./Content/Image/logo_1.png" alt="">
                    </div>
                    <div class="h-right text-end col-4">
                        <?php
                            if (!isset($_SESSION['Customer'])) {
                        ?>
                        <a href="index.php?menu=login" class="h-login">Đăng nhập</a> 
                        <?php
                            } else {
                        ?>
                        <span class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Chào <?php echo $_SESSION['Customer']['Name_kh']?>!
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="">Thông tin cá nhân</a></li>
                                <li>
                                    <form method="post" class="m-0">
                                        <button class="dropdown-item" type="submit" name="exit">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </span>
                        <?php
                            }
                        ?>
                        <span class="">
                            <a href="" class="active h-language">VN</a> | <a href="" class="h-language">EN</a>
                        </span> 
                        <a href="./index.php?menu=cart" class="btn btn-outline-success">
                            <span>Giỏ hàng</span>
                            <i class="fa fa-cart-shopping position-relative">
                                <?php
                                    if (isset($_SESSION["cart"])&&count($_SESSION["cart"])>0) {
                                ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 7px">
                                        <?php if (count($_SESSION["cart"])<=99) {
                                            $count = 0;
                                            foreach ($_SESSION["cart"] as $key => $item) {
                                                $count += $item["amount"];
                                            }
                                            echo $count;
                                        } else {
                                            echo "99+";
                                        }?>
                                </span>
                                <?php
                                    }
                                ?>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="h-bottom">
                <nav class="navbar navbar-expand-lg p-0">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-around" id="navbarSupportedContent">
                            <ul class="h-menu nav navbar-nav">
                                <?php
                                    $menu = new menu();
                                    $menu_list = $menu->getMenu();
                                    foreach ($menu_list as $menu_parent) {
                                        $menu_child_list = $menu->getMenuChild($menu_parent['ID_Menu']);
                                        if (count($menu_child_list)>0 && ($menu_parent["Access"]==""||(isset($_SESSION["Customer"]) && $_SESSION["Customer"]["ID_Rank"]==$menu_parent["Access"]))) {
                                            ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href=""  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo $menu_parent['Name_Menu']?>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php
                                                        foreach ($menu_child_list as $menu_child): if ($menu_child["Access"]==""||(isset($_SESSION["Customer"]) && $_SESSION["Customer"]["ID_Rank"]==$menu_child["Access"])) {
                                                            ?>
                                                                <li><a class="dropdown-item" href="./index.php?<?php echo $menu_parent['Link']."&".$menu_child['Link']?>"><?php echo $menu_child['Name_Menu']?></a></li>
                                                            <?php
                                                        } endforeach;
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        } else if ($menu_parent["Access"]==""||(isset($_SESSION["Customer"]) && $_SESSION["Customer"]["ID_Rank"]==$menu_parent["Access"])) {
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="./index.php?<?php echo $menu_parent['Link']?>"><?php echo $menu_parent['Name_Menu']?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>
                            <div class="h-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="content">