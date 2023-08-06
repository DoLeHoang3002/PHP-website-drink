<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">DANH SÁCH CHI TIẾT HOÁ ĐƠN</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col" style="width: 15%;">Tên hàng hoá</th>
                                <th scope="col" style="width: 15%;">Size</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Topping</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col" style="width: 11%;">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $bills = new bill();
                                $isset_bill = false;

                                foreach ($bills->getOrderDetail($_GET['id']) as $key => $item) {
                            ?>
                            <tr class="align-middle text-center">
                                    <td>
                                        <?php echo $item["Name_hh"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Name_Size"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Amount"]?>
                                    </td>
                                    <td class="text-start">
                                        <?php
                                            $list_topping=$bills->getToppingDetail($item['ID_detail_hoadon']);
                                            foreach ($list_topping as $keytopping => $itemtopping) {
                                                if ($keytopping != array_key_first($list_topping)) {
                                                echo nl2br("\n");
                                                }
                                            echo nl2br("-\t".$itemtopping["Name_Topping"]." ~ ".number_format($itemtopping["Price"], 0 , "," , "."));
                                        }?>
                                    </td>
                                    <td>
                                        <?php echo $item["Note"]?>
                                    </td>
                                    <td>
                                        <?php echo number_format($item["Total_Price"], 0 , "," , ".")?>
                                    </td>
                                    <td>
                                        <form class="d-inline-block" action="./index.php?menu=admin&action=edit_detail_bill" method="post">
                                            <input type="hidden" name="ID_Bill" value="<?php echo $_GET['id']?>">
                                            <button class="btn btn-danger" name="delete" value="<?php echo $item['ID_detail_hoadon']?>">Xoá</button>
                                            <button class="btn btn-warning" name="edit" value="<?php echo $item['ID_detail_hoadon']?>">Sửa</button>
                                        </form>
                                    </td>
                            </tr>
                            <?php
                                $isset_bill = true;
                                }
                                if (!$isset_bill) {
                            ?>
                            <tr class="align-middle text-center">
                                <td colspan="7">
                                    <h3>Không có hoá đơn</h3>
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