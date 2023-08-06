<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">DANH SÁCH HOÁ ĐƠN</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col" style="width: 15%;">ID Hoá đơn</th>
                                <th scope="col" style="width: 15%;">ID Khách hàng</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Ngày mua</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col" style="width: 17%;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $bills = new bill();
                                $isset_bill = false;

                                foreach ($bills->getListBill() as $key => $item) {
                            ?>
                            <tr class="align-middle text-center">
                                    <td>
                                        <?php echo $item["ID_Bill"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["ID_kh"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Name_kh"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Date_Create"]?>
                                    </td>
                                    <td>
                                        <?php echo number_format($item["Total_Money"], 0 , "," , ".")?>
                                    </td>
                                    <td>
                                        <form class="d-inline-block" action="./index.php?menu=admin&action=edit_bill" method="post">
                                            <button class="btn btn-danger" name="delete" value="<?php echo $item['ID_Bill']?>">Xoá</button>
                                            <button class="btn btn-warning" name="edit" value="<?php echo $item['ID_Bill']?>">Sửa</button>
                                        </form>
                                        <a class="btn btn-success"  href="./index.php?menu=admin&action=detail_bill&id=<?php echo $item['ID_Bill']?>">Chi tiết</a>
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