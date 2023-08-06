<?php
$product = new thucuong();
            if (isset($_GET["menu"])&&isset($_GET["action"])) {
                if ($_GET["menu"]=="thucuong"&&$_GET["action"]!="order") {
                    switch ($_GET["action"]) {
                        case '1':
                            echo "<img class='w-100 mb-1' src='./Content/Image/thumnail_1.jpg'><div class='text-center mt-1'><h1>THỨC UỐNG</h1></div>";
                            break;
                        case '2':
                            echo "<img class='w-100 mb-1' src='./Content/Image/thumnail_13.jpg'><div class='text-center mt-1'><h1>SNACKS</h1></div>";
                            break;
                        case '3':
                            echo "<img class='w-100 mb-1' src='./Content/Image/thumnail_14.jpg'><div class='text-center mt-1'><h1>BAKERY</h1></div>";
                            break;            
                        default:
                            # code...
                            break;
                    }
        ?>
                <div class="text-center mb-3">
                    <img src="./Content/Image/icon_tealeaves.png" alt="">
                </div>
                <div class="text-center mb-2">
                    <?php 
                        $types = $product->getListType();
                        foreach($types as $type) {
                    ?>
                    <a href="./index.php?menu=thucuong&action=<?php echo $type['ID_Type']?>" class="btn btn-outline-success <?php if($_GET["action"]==$type['ID_Type']) echo "active"?>"><?php echo $type['Name_Type']?></a>
                    <?php }?>
                </div>
        <?php
                }
            }
        ?>
<div class="list-thuc-uong">
    <div class="container">
        <div class="row row-cols-4">
            <?php
                $list=$product->getListHangHoa($_GET["action"]);
                foreach ($list as $item){
                    if (!$item['Deleted']) {
            ?>
                    <div class="card rounded-3 border-0 card-product text-center bg-none">
                        
                        <div class="card-body">
                            <img class="img-product" src="./Content/Image/<?php echo $item['Image'];?>">
                            <div class="product-name"><?php echo $item['Name_hh']?></div>
                            <div class="product-sub-name"><?php echo $item['Sub_Name_hh']?></div>
                            <div class="product-price">
                                <?php
                                    echo number_format($item["Price"],0, ',', '.');
                                ?>
                            </div>
                            <a href="index.php?menu=thucuong&action=order&id=<?php echo $item["ID_hh"]?>" class="btn btn-outline-success">ĐẶT HÀNG</a>
                        </div>
                    </div>
            <?php
                }};
            ?>
        </div>
    </div>
</div>
