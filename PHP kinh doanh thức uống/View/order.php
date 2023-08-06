<?php
    if (isset($_GET['id'])) {
        $ID_hh=$_GET['id'];
        $product = new thucuong();
        $list=$product->getHangHoa($ID_hh);
        $list_topping=$product->getListTopping($ID_hh);
        $order_size = $list[array_search(min(array_column($list, 'Price')), array_column($list, "Price"))]["ID_Size"];
        $Price = $list[array_search($order_size, array_column($list, "ID_Size"))]["Price"];
    }
?>
<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card card-order" style="width: 956px; min-height: 550px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <img class="w-100" src="./Content/Image/<?php echo $list[0]['Image'];?>">
                            <div class="product-price text-center" style="font-size: 30px; font-weight: 900;">
                                <?php echo number_format($Price,0, ',', '.');?>
                                đ
                            </div>
                        </div>
                        <div class="col-7">
                            <form action="./index.php?<?php echo "menu=".$_GET["menu"]."&action=".$list[0]["ID_Type"];?>" method="post">
                                <input type="hidden" name="ID_hh" value="<?php echo $ID_hh?>">
                                <div class="product-name"><?php echo $list[0]["Name_hh"]?></div>
                                <div class="product-sub-name"><?php echo $list[0]["Sub_Name_hh"]?></div>
                                <?php if (!in_array(0,array_column($list, "ID_Size"))) {?>
                                <div class="product-info">
                                    <label for="">Kích cỡ</label>
                                    <div class="product-size">
                                        <?php $first_loop=true; foreach ($list as $item):?>
                                        <button type="button" class="btn-size">
                                            <label for=""><?php echo $item["Name_Size"]?></label>
                                            <input type="radio" name="size" onclick="updatePrice()" value="<?php echo $item["ID_Size"]?>" <?php if($order_size===$item["ID_Size"]){echo "checked";}?>>
                                        </button>
                                        <?php endforeach?>
                                    </div>
                                </div>
                                <?php }?>
                                <?php foreach ($list_topping as $key => $item):?>
                                <?php if($key === array_key_first($list_topping)) {?>
                                <div class="product-info">
                                    <label for="">Thêm</label>
                                    <div class="product-topping">
                                <?php }?>
                                        <button type="button" class="btn-size">
                                            <label for="">
                                                <?php echo $item["Name_Topping"]?> + <?php echo number_format($item["Price"],0, ',', '.')?> đ
                                            </label>
                                            <input type="checkbox" name="topping[]" onclick="updatePrice()" value="<?php echo $item["ID_Topping"]?>" <?php if(isset($order_topping)&&in_array($item["ID_Topping"],$order_topping)) {echo "checked";}?>>
                                        </button>
                                <?php if($key === array_key_last($list_topping)) {?>
                                    </div>
                                </div>
                                <?php }?>
                                <?php endforeach?>
                                <div class="product-info">
                                    <label for="">Số lượng</label>
                                    <div class="product-amount">
                                        <span class="product-amount-prepend" onclick="minus_amount()">-</span><span>
                                            <input type="text" id="amount" name="amount" value="1">
                                        </span><span class="product-amount-append" onclick="plus_amount()">+</span>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <label for="">Ghi chú</label>
                                    <div class="product-note">
                                        <textarea name="note" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <label for="">Giá</label>
                                    <input type="hidden" name="Total_Price" id="Total_Price" value="<?php echo $Price?>">
                                    <div class="product-price" id="Price">
                                        <?php echo number_format($Price,0, ',', '.');?>
                                        đ
                                    </div>
                                </div>
                                <button class="btn btn-outline-success" type="submit" name="order" value="cart">ĐẶT HÀNG</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <section>
            <div class="border border-success p-1 rounded">
                <?php
                    if(isset($_SESSION['Customer'])):
                ?>
                <div class="w-100">
                <p class="text-left"><b>BÌnh luận </b></p>
                <hr>
                </div>
                <div class="text-end">
                    <form method="post">
                        <div class="row text-start">
                            <div class="text-success">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span><?php echo $_SESSION['Customer']['Name_kh']?></span><br>
                                <textarea class="input-field w-75" type="text" name="comment" rows="2" cols="70" id="comment" placeholder="Thêm bình luận"></textarea>
                                <input type="submit" class="btn btn-primary float-end" id="submitButton" value="Bình Luận" />
                            </div>
                        </div>
                    </form>
                </div><br>
                <?php
                    endif;
                ?>   
                <div class="w-100">
                    <p class="float-left"><b>Các bình luận</b></p>
                    <hr>
                </div>
                <div class="w-100">
                    <?php
                        $bl1=new binhluan();
                        $count=$bl1->getCountComment($ID_hh);
                        $result = $bl1->getNoidungComment($ID_hh);
                        foreach ($result as $key => $set):
                    ?>
                    <div class="col-12">
                        <div class="w-100">
                            <p><?php echo '<b>'.$set['Name_kh'].': </b>'.$set['noidung']; ?></p><br>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                    <br />
                </div>
            </div>
        </section>
  
        </div>
    </div>
</div>
<script>
    function plus_amount() {
        document.getElementById("amount").value = parseInt(document.getElementById("amount").value)+1;
        updatePrice();
    }
    function minus_amount() {
        if (parseInt(document.getElementById("amount").value)!==1){
            document.getElementById("amount").value -=1;
            updatePrice();
        }
    }
    function updatePrice() {
        var data = "";
        var size=0;
        var amount=0;
        var topping=[];
        document.getElementsByName('size').forEach(element => {
            if (element.checked) {
                size = element.value
            }
        });
        document.getElementsByName('topping[]').forEach(element => {
            if (element.checked) {
                topping.push(element.value);
            }
        });
        document.getElementsByName('amount').forEach(element => {
            amount = element.value;
        });
        if (size !== 0) {
            if (data !== "") {
                data +="&";
            }
            data+="size=" + size;
        }
        if (topping.length !== 0) {
            topping.forEach(element => {
                if (data !== "") {
                    data +="&";
                }
                data+="topping%5B%5D=" + element;
            });
            
        }
        if (amount !== 0) {
            if (data !== "") {
                data +="&";
            }
            data+="amount=" + amount;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "Model/methods.php"+window.location.search);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8")
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Total_Price").value = JSON.parse(this.responseText).Price
                document.getElementById("Price").innerHTML = JSON.parse(this.responseText).Price.toLocaleString("de-DE")+" đ";
            }
        };
        xmlhttp.send(data);
    }
</script>