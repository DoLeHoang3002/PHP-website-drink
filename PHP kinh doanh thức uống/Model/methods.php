<?php
    include_once "./database.php";
    include_once "./thucuong.php";
    if (isset($_GET['id'])) {
        $ID_hh=$_GET['id'];
        $product = new thucuong();
        $list=$product->getHangHoa($ID_hh);
        $list_topping=$product->getListTopping($ID_hh);
        $order_size = $list[array_search(min(array_column($list, 'Price')), array_column($list, "Price"))]["ID_Size"];
        if (isset($_POST["size"])) {
            $order_size = $_POST["size"];
        }
        $Price = $list[array_search($order_size, array_column($list, "ID_Size"))]["Price"];
        if (isset($_POST["topping"])) {
            $order_topping = $_POST["topping"];
            foreach ( $order_topping as $ID_topping ) {
                $list_order_topping[]=$list_topping[array_search($ID_topping,array_column($list_topping, "ID_Topping"))];
            }
            $Price = TinhTienTopping($Price,$list_order_topping);
        }
        if (isset($_POST["amount"])) {
            $order_amount = $_POST["amount"];
            $Price = $Price*$order_amount;
        }
    }
    function TinhTienTopping($Price, $list_order_topping)
    {
        return $Price+array_sum(array_column($list_order_topping, 'Price'));
    }
    echo json_encode(["Price" => $Price]);
?>