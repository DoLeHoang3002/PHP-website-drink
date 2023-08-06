<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-50 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">
                        <?php
                            if ($_GET["action"]=="add") {
                                echo "THÊM SẢN PHẨM";
                            } else {
                                echo "SỬA HOÁ ĐƠN";
                            }
                        ?>
                    </h1>
                </div>
                <div class="card-body p-3 text-center">
                    <form method="post">
                        <?php
                            if (isset($_POST['edit'])) {
                                $bills = new bill();
                                $bill=$bills->getBill($_POST['edit'])[0];
                                ?>
                                    <input type="hidden" name="ID_Bill" value="<?php echo $_POST["edit"];?>">
                                <?php
                            }
                        ?>
                        <div class="input-group mb-3 w-100 p-1 float-start">
                            <span class="input-group-text" style="width: 25%" id="basic-addon1">Tên khách hàng</span>
                            <select class="form-select" name="ID_kh">
                                <?php
                                    $users = new Register();
                                    $user_list = $users->getListUser();
                                    foreach ( $user_list as $user ) {
                                        echo $user['ID_kh']==$bill['ID_kh']?"<option value='".$user['ID_kh']."' selected>".$user['Name_kh']."</option>":"<option value='".$user['ID_kh']."'>".$user['Name_kh']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-success" name="add_edit">
                            <?php
                                if ($_GET["action"]=="add") {
                                    echo "THÊM";
                                } else {
                                    echo "SỬA";
                                }
                            ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>