<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-50 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">
                        <?php
                            if ($_GET["action"]=="add_type") {
                                echo "THÊM LOẠI SẢN PHẨM";
                            } else {
                                echo "SỬA LOẠI SẢN PHẨM";
                            }
                        ?>
                    </h1>
                </div>
                <div class="card-body p-3 text-center">
                    <?php
                        if ($_GET["action"] == "add_type") {
                            ?>
                            <form method="post" class="text-start" enctype="multipart/form-data">
                                <div class="input-group mb-3 w-75 p-2 d-inline-block">
                                    <input type='file' name='file' class="form-control w-100">
                                </div>
                                <button class="btn btn-outline-success d-inline mb-1" name="submit_file">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </button>
                            </form>
                            <?php
                        }
                    ?>

                    <form method="post">
                        <?php
                            $types = new type();
                            if ($_GET["action"] == "edit_type") {
                                ?>
                                <div class="input-group mb-3 w-50 p-2 float-start">
                                    <input type="hidden" name="ID_Type" value="<?php echo $_POST["edit"];?>">
                                    <span class="input-group-text" style="width: 40%" id="basic-addon1">ID Type</span>
                                    <input type="text" class="form-control" disabled value="<?php echo $_POST["edit"];?>">
                                </div>
                                <?php
                                $type = $types->getType($_POST['edit']);
                            }
                        ?>
                        <div class="input-group mb-3 w-50 p-2">
                            <span class="input-group-text" style="width: 40%" id="basic-addon1">Name Type</span>
                            <input type="text" name="Name_Type" class="form-control" placeholder="Tên loại sản phẩm" value="<?php if(isset($type[0])) {echo $type[0]['Name_Type'];}?>">
                        </div>
                        <div class="input-group mb-3 w-50 p-2">
                            <span class="input-group-text" style="width: 40%" id="basic-addon1">Menu</span>
                            <select class="form-select w-25 d-inline" name="ID_Menu" id="">
                                <?php
                                $menus = new menu();
                                $listmenu = $menus->getMenu();
                                foreach ($listmenu as $key => $value) {
                                    echo "<option value='".$value['ID_Menu']."' ".
                                    (isset($type[0])&&$value['ID_Menu']==$type[0]['ID_Menu']?"selected":"")
                                    .">".$value['Name_Menu']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-success" name="add_edit">
                            <?php
                                if ($_GET["action"]=="add_type") {
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