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
                                echo "SỬA CHI TIẾT HOÁ ĐƠN";
                            }
                        ?>
                    </h1>
                </div>
                <div class="card-body p-3 text-center">
                    <form method="post">
                        <?php
                            $bill['ID_Size'] = 0;
                            $bills = new bill();
                            $bill = $bills->getDetailBill($_POST['edit'])[0];
                        ?>
                        <input type="hidden" name="ID_Bill" value="<?php echo $_POST['ID_Bill']?>">
                        <input type="hidden" name="ID_detail_hoadon" value="<?php echo $_POST['edit']?>">
                        <div class="input-group mb-3  w-50 p-1 float-start">
                            <span class="input-group-text" style="width: 20%" id="basic-addon1">Size</span>
                            <select class="form-select" name="ID_Size">
                                <?php
                                    $sizes = new thucuong();
                                    $size_list = $sizes->getListSize($bill['ID_hh']);
                                    foreach ( $size_list as $size ) {
                                        echo $size['ID_Size']==$bill['ID_Size']?"<option value='".$size['ID_Size']."' selected>".$size['Name_Size']." ~ ".number_format($size['Price'], 0 , "," , ".")."</option>"
                                        :"<option value='".$size['ID_Size']."'>".$size['Name_Size']." ~ ".number_format($size['Price'], 0 , "," , ".")."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3 w-50 p-1">
                            <span class="input-group-text" style="width: 40%" id="basic-addon1">Amount</span>
                            <input type="number" name="Amount" class="form-control" placeholder="Số lượng" value="<?php echo $bill['Amount']?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Note</span>
                            <textarea class="form-control" name="Note" placeholder="Ghi chú"><?php echo $bill['Note']?></textarea>
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