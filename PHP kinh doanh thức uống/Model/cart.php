<?php
    function TinhTienTopping($price, $list_order_topping)
    {
        return $price+array_sum(array_column($list_order_topping, 'Price'));
    }
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    if (isset($_POST["ID_hh"])&&isset($_POST["amount"])&&isset($_POST["Total_Price"])
    &&isset($_POST["note"])&&isset($_POST["order"])&&$_POST["order"]=="cart") {
        $idhh = $_POST["ID_hh"];

        $product = new thucuong();
        $list = $product->getHangHoa($idhh);
        if (isset($_POST["size"])) {
            $idsize = $_POST["size"];
        } else {
            $idsize = 0;
        }
        if (isset($_POST["topping"])) {
            $idtopping = $_POST["topping"];
        } else {
            $idtopping = [];
        }
        $amount = $_POST["amount"];
        $note = $_POST["note"];
        $totalprice = $_POST["Total_Price"];
        $image = $list[0]["Image"];
        $name = $list[0]["Name_hh"];
        $subname = $list[0]["Sub_Name_hh"];
        

        $arr = array(
            "name" => $name,
            "subname" => $subname,
            "image" => $image,
            "note" => $note,
            "amount" => $amount,
            "idtopping" => $idtopping,
            "idsize" => $idsize,
            "idhh" => $idhh,
            "totalprice" => $totalprice,
        );
        echo "<script>console.log(1);</script>";
        $same = false;
        foreach ($_SESSION["cart"] as $key => $item) {
            echo "<script>console.log(2);</script>";
            if ($arr["idhh"]==$item["idhh"]&&$arr["note"]==$item["note"]&&$arr["idsize"]==$item["idsize"]
            &&count(array_diff($item["idtopping"],$arr["idtopping"]))==0&&count(array_diff($arr["idtopping"],$item["idtopping"]))==0) {
                $_SESSION["cart"][$key]["amount"] += intval($arr["amount"]);
                $_SESSION["cart"][$key]["totalprice"] += intval($arr["totalprice"]);
                $same = true;
                break;
            }
        }
        if ($same === false) {
            echo "<script>console.log(4);</script>";
            $_SESSION["cart"][] = $arr;
        }
        echo "<script>console.log(".$_SESSION["cart"][0]["amount"].");</script>";
    }
    if (isset($_POST["edit-cart"])&&isset($_POST["edit-item"])&&isset($_POST["edit-amount"])) {
        echo "<script>".$_POST["edit-cart"]."</script>";
        if ($_POST["edit-cart"] == "delete" || $_POST["edit-amount"] <= 0) {
            array_splice($_SESSION["cart"],$_POST["edit-item"],1);
            echo "<script>console.log(delete);</script>";
        } elseif ($_POST["edit-cart"] == "edit") {
            $_SESSION["cart"][$_POST["edit-item"]]["amount"] = $_POST["edit-amount"];
            $product = new thucuong();
            $item = $_SESSION["cart"][$_POST["edit-item"]];
            $list_size = $product->getListSize($item["idhh"]);
            $list_topping = $product->getListTopping($item["idhh"]);
            $price = $list_size[array_search($item["idsize"], array_column($list_size, "ID_Size"))]["Price"];
            if (count($item["idtopping"])>0) {
                foreach ( $item["idtopping"] as $ID_topping ) {
                    $list_order_topping[]=$list_topping[array_search($ID_topping,array_column($list_topping, "ID_Topping"))];
                }
                $price = TinhTienTopping($price,$list_order_topping);
            }
            $price = $price*$item["amount"];
            $_SESSION["cart"][$_POST["edit-item"]]["totalprice"] = $price; 
        }
    }
    if (isset($_POST["delete_all"])) {
        $_SESSION["cart"]=[];
    }
?>