<div class="list-thuc-uong">
    <div class="container">
        
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">DANH SÁCH SẢN PHẨM</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-success m-0" style="line-height: d">
                        <thead>
                            <tr class="align-middle text-center">
                                <th scope="col" style="width: 15%;">Image</th>
                                <th scope="col" style="width: 15%;">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Type</th>
                                <th scope="col">Size</th>
                                <th scope="col">Topping</th>
                                <th scope="col" style="width: 11%;">
                                    <a href="./index.php?menu=admin&action=add" class="btn btn-success w-100">Add</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $product = new thucuong();
                                $isset_product = false;

                                foreach ($product->getListHangHoa_all() as $key => $item) {
                                    if (!$item['Deleted']) {
                            ?>
                            <tr class="align-middle text-center">
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
                                        <?php echo $item["Name_Type"]?>
                                    </td>
                                    <td class="text-start">
                                        <?php
                                            $list_size=$product->getListSize($item['ID_hh']);
                                            foreach ($list_size as $keysize => $itemsize) {
                                                if ($keysize != array_key_first($list_size)) {
                                                    echo nl2br("\n");
                                                }
                                                echo nl2br("-\t");
                                                if ($itemsize["Name_Size"]!=null&&$itemsize["Name_Size"]!=""&&$itemsize["Name_Size"]!=0) {
                                                    echo nl2br($itemsize["Name_Size"]." ~ ");
                                                }
                                                echo number_format($itemsize["Price"], 0 , "," , ".");
                                            }
                                        ?>
                                    </td>
                                    <td class="text-start">
                                        <?php
                                            $list_topping=$product->getListTopping($item['ID_hh']);
                                            foreach ($list_topping as $keytopping => $itemtopping) {
                                                if ($keytopping != array_key_first($list_topping)) {
                                                    echo nl2br("\n");
                                                }
                                                echo nl2br("-\t".$itemtopping["Name_Topping"]." ~ ".number_format($itemtopping["Price"], 0 , "," , "."));
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <form action="./index.php?menu=admin&action=edit" method="post">
                                            <button class="btn btn-danger" name="delete" value="<?php echo $item['ID_hh']?>">Xoá</button>
                                            <button class="btn btn-warning" name="edit" value="<?php echo $item['ID_hh']?>">Sửa</button>
                                        </form>
                                    </td>
                            </tr>
                            <?php
                                $isset_product = true;
                                }}
                                if (!$isset_product) {
                            ?>
                            <tr class="align-middle text-center">
                                <td colspan="7">
                                    <h3>Không có sản phẩm</h3>
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