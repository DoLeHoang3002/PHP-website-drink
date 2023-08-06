<?php
    $hd = new bill();
    $bill = $hd->getOrder($_SESSION["ID_Bill"][0]);
    $Date_Create = new DateTime($bill[0]["Date_Create"]);
?>
<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">GIỎ HÀNG</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0  float-start"" style="line-height: d; width: 40%">
                        <thead>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Tên khách hàng</th>
                                <td><?php echo $bill[0]["Name_kh"]?></td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Số điện thoại</th>
                                <td><?php echo $bill[0]["phonenumber"]?></td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Địa chỉ</th>
                                <td><?php echo $bill[0]["address"]?></td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Rank</th>
                                <td><?php echo $bill[0]["Name_Rank"]?></td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Mã số hoá đơn</th>
                                <td><?php echo $bill[0]["ID_Bill"]?></td>
                            </tr>
                            <tr class="align-middle">
                                <th scope="col" style="width: 30%;">Ngày lập</th>
                                <td><?php echo $Date_Create->format('d/m/Y')?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <table class="table table-striped table-bordered border-success m-0 float-start" style="line-height: d; width: 60%">
                        <thead>
                            <tr>
                                <th>
                                    Mã Voucher:
                                </th>
                                <th>
                                    <input type="text">
                                </th>
                            </tr>
                            <tr>
                                <th>Tên Voucher</th>
                                <th>Hạn sử dụng</th>
                                <th>Giảm giá</th>
                                <th>
                                    <button>Huỷ hết</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table> -->
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col" style="width: 11%;">Image</th>
                                <th scope="col" style="width: 11%;">Name</th>
                                <th scope="col" style="width: 11%;">Description</th>
                                <th scope="col" style="width: 11%;">Size</th>
                                <th scope="col" style="width: 20%;">Topping</th>
                                <th scope="col" style="width: 5%;">Amount</th>
                                <th scope="col" style="width: 20%;">Note</th>
                                <th scope="col" style="width: 11%;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $billdetail = $hd->getOrderDetail($_SESSION["ID_Bill"][0]);
                                $product = new thucuong();
                                foreach ($billdetail as $key => $item) :
                                    $list_size = $product->getListSize($item["ID_hh"]);
                                    $list_topping = $product->getListTopping($item["ID_hh"]);
                            ?>
                            <tr class="align-middle text-center">
                                <form method="post">
                                    <input type="hidden" name="edit-item" value="<?php echo $key?>">
                                    <td>
                                        <img src="./Content/Image/<?php echo $item["Image"]?>" alt="" style="object-fit: cover;width: 100%;">
                                    </td>
                                    <td>
                                        <?php echo $item["Name_hh"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Sub_Name_hh"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Name_Size"]?>
                                    </td>
                                    <td>
                                        <?php
                                            foreach($list_topping = $hd->getToppingDetail($item["ID_detail_hoadon"]) as $keytopping => $topping) {
                                                if ($keytopping != array_key_first($list_topping)) {
                                                    echo " - ";
                                                }
                                                echo $topping[0];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $item["Amount"]?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $item["Note"]
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo number_format($item["Total_Price"], 0 , "," , ".")." đ";
                                        ?>
                                    </td>
                                </form>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                            <tr class="align-middle text-center">
                                <th colspan="7">
                                    Tổng tiền:
                                </th>
                                <th colspan="2">
                                    <?php echo number_format($bill[0]["Total_Money"], 0 , "," , ".")." đ"; ?>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>