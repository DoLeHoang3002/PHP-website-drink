<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card w-100 card-cart">
                <div class="card-header bg-success text-white text-center">
                    <h1 class="m-0">
                        <?php
                            if ($_GET["action"]=="add") {
                                echo "THÊM SẢN PHẨM";
                            } else {
                                echo "SỬA SẢN PHẨM";
                            }
                        ?>
                    </h1>
                </div>
                <div class="card-body p-3 text-center">
                    <form method="post" enctype="multipart/form-data">
                        <?php
                            $products = new thucuong();
                            if ($_GET["action"] == "edit") {
                                ?>
                                    <input type="hidden" name="ID_hh" value="<?php echo $_POST["edit"];?>">
                                <?php
                                $product = $products->getHangHoa($_POST['edit']);
                            }
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Name</span>
                            <input type="text" name="Name_hh" class="form-control" placeholder="Tên sản phẩm" value="<?php if(isset($product[0])) {echo $product[0]['Name_hh'];}?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Description</span>
                            <textarea class="form-control" name="Sub_Name_hh" placeholder="Mô tả sản phẩm"><?php if(isset($product[0])) {echo $product[0]['Sub_Name_hh'];}?></textarea>
                        </div>
                        <div class="input-group mb-3 w-50 float-start pe-1">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Type</span>
                            <select class="form-select" name="ID_Type">
                                <?php
                                    $list_type = $products->getListType();
                                    foreach ($list_type as $type) {
                                        echo "<option value=".$type['ID_Type']." ".(isset($product)>0&&$type['ID_Type']==$product[0]['ID_Type']?'selected':'').">".$type['Name_Type']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3 w-50 float-start ps-1">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Group</span>
                            <select class="form-select" name="ID_Group">
                                <?php
                                    $list_group = $products->getListGroup();
                                    foreach ($list_group as $group) {
                                        echo "<option value=".$group['ID_Group']." ".(isset($product[0])&&$group['ID_Group']==$product[0]['ID_Group']?'selected':'').">".$group['Name_Group']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">List Size & Price</span>
                            <div class="input-group-text" style="width: 85%">
                                <?php $first_loop=true; 
                                    $list_size = $products->getSize();
                                    foreach ($list_size as $item) :?>
                                    <div class="input-group pe-1 ps-1">
                                        <span class="input-group-text"><?php if($item["Name_Size"]=="") {echo "\"Not have size name\"";} else {echo $item["Name_Size"];}?>:</span>
                                        <input class="form-control" type="number" name="price_size[<?php echo $item["ID_Size"]?>]" value="<?php if (isset($product)){ foreach($product as $element) { if ($element["ID_Size"]===$item["ID_Size"]) {echo $element["Price"];}}}?>"?>
                                    </div>
                                <?php endforeach?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">List Topping</span>
                            <div class="input-group-text justify-content-evenly" style="width: 85%">
                                <?php $first_loop=true; 
                                    $list_topping = $products->getTopping();
                                    foreach ($list_topping as $item): if ($item["Name_Topping"]!=null) {?>
                                <div class="btn-size ma-1 me-1">
                                    <label for=""><?php echo $item["Name_Topping"]?></label>
                                    <input type="checkbox" name="ID_Topping_List[]" value="<?php echo $item["ID_Topping"]?>" <?php if (isset($product)) {foreach ($products->getListTopping($product[0]["ID_hh"]) as $element) {echo $item["ID_Topping"]===$element["ID_Topping"]?"checked":"";}}?>>
                                </div>
                                <?php } endforeach?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 15%" id="basic-addon1">Image</span>
                            <div class="input-group-text">
                                <?php if ($_GET["action"]!=="edit") {
                                    echo "<input type='file' name='Image' class='form-control' onchange='loadFile(event)'><br>";
                                }?>
                                <img id="image" style="width: 200px" <?php if(isset($product[0])){ echo "src='./Content/Image/".$product[0]["Image"]."'";}?> class="m-2 border border-2 border-success"/>
                            </div>
                            <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('image');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                            </script>
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