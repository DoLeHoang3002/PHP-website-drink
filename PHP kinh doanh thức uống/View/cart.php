<?php
    $product = new thucuong();
?>
<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">GIỎ HÀNG</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col" style="width: 10%;">Image</th>
                                <th scope="col" style="width: 10%;">Name</th>
                                <th scope="col" style="width: 10%;">Description</th>
                                <th scope="col" style="width: 10%;">Size</th>
                                <th scope="col" style="width: 19%;">Topping</th>
                                <th scope="col" style="width: 5%;">Amount</th>
                                <th scope="col" style="width: 15%;">Note</th>
                                <th scope="col" style="width: 11%;">Price</th>
                                <th scope="col" style="width: 10%;">
                                    <form method="post">
                                        <button class="btn btn-danger" name="delete_all">Xoá hết</button>
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $isset_order = false;
                                foreach ($_SESSION["cart"] as $key => $item) :
                                    $list_size = $product->getListSize($item["idhh"]);
                                    $list_topping = $product->getListTopping($item["idhh"]);
                            ?>
                            <tr class="align-middle text-center">
                                <form method="post">
                                    <input type="hidden" name="edit-item" value="<?php echo $key?>">
                                    <td>
                                        <img src="./Content/Image/<?php echo $item["image"]?>" alt="" style="object-fit: cover;width: 100%;">
                                    </td>
                                    <td>
                                        <?php echo $item["name"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["subname"]?>
                                    </td>
                                    <td>
                                        <?php echo $list_size[array_search($item["idsize"],array_column($list_size,'ID_Size'))]["Name_Size"]?>
                                    </td>
                                    <td>
                                        <?php
                                            foreach($item["idtopping"] as $keytopping => $idtopping) {
                                                if ($keytopping != array_key_first($item["idtopping"])) {
                                                    echo " - ";
                                                }
                                                echo $list_topping[array_search($idtopping,array_column($list_topping,'ID_Topping'))]["Name_Topping"];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <input type="number" name="edit-amount" value="<?php echo $item["amount"]?>" min="0" style="width: 50px">
                                    </td>
                                    <td>
                                        <?php
                                            echo $item["note"]
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo number_format($item["totalprice"], 0 , "," , ".")." đ";
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" name="edit-cart" value="edit">
                                            <i class="fa fa-wrench" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-danger" name="edit-cart" value="delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            <?php
                                $isset_order = true;
                                endforeach;
                                if (!$isset_order) {
                            ?>
                            <tr class="align-middle text-center">
                                <td colspan="9">
                                    <h3>Không có sản phẩm nào trong giỏ hàng</h3>
                                </td>
                            </tr>
                            <?php
                                } else {
                            ?>
                            <tr class="align-middle text-center">
                                <th colspan="7">
                                    Tổng tiền:
                                </th>
                                <th>
                                    <?php echo number_format(array_sum(array_column($_SESSION["cart"], 'totalprice')), 0 , "," , ".")." đ"; ?>
                                </th>
                                <td>
                                    <form action="./index.php?menu=payment" method="post">
                                        <input type="hidden" name="totalmoney" value="<?php echo array_sum(array_column($_SESSION["cart"], 'totalprice'))?>">
                                        <button class="btn btn-outline-success">Thanh toán</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>