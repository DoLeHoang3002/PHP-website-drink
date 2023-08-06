<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">DANH SÁCH LOẠI SẢN PHẨM</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col">Mã loại</th>
                                <th scope="col">Tên loại</th>
                                <th scope="col" style="width: 11%;">
                                    <a href="./index.php?menu=admin&action=add_type" class="btn btn-success w-100">Add</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $type = new type();
                                $isset_type = false;
                                foreach ($type->getListType() as $item) {
                            ?>
                            <tr class="align-middle text-center">
                                <form method="post">
                                    <input type="hidden" name="edit-item" value="<?php echo $item["ID_Type"]?>">
                                    <td>
                                        <?php echo $item["ID_Type"]?>
                                    </td>
                                    <td>
                                        <?php echo $item["Name_Type"]?>
                                    </td>
                                </form>
                                    <td>
                                        <form action="./index.php?menu=admin&action=edit_type" method="post">
                                            <button class="btn btn-danger" name="delete" value="<?php echo $item['ID_Type']?>">Xoá</button>
                                            <button class="btn btn-warning" name="edit" value="<?php echo $item['ID_Type']?>">Sửa</button>
                                        </form>
                                    </td>
                            </tr>
                            <?php
                                $isset_type = true;
                                }
                                if (!$isset_type) {
                            ?>
                            <tr class="align-middle text-center">
                                <td colspan="7">
                                    <h3>Không có loại sản phẩm</h3>
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