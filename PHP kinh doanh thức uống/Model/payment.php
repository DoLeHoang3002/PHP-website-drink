<?php
    class bill {
        function __construct() {}
        function getListBill(){
            $db = new database();
            $query = "select hoadon.*,khachhang.Name_kh from hoadon, khachhang where hoadon.ID_kh = khachhang.ID_kh
            ORDER BY Date_Create DESC, Total_Money DESC";
            return $db->getList($query);
        }
        function getBill($ID_Bill){
            $db = new database();
            $query = "select hoadon.* from hoadon where hoadon.ID_Bill = $ID_Bill";
            return $db->getList($query);
        }
        function getDetailBill($ID_detail_hoadon){
            $db = new database();
            $query = "select * from detail_hoadon where detail_hoadon.ID_detail_hoadon = $ID_detail_hoadon";
            return $db->getList($query);
        }
        public function insertOrder($ID_kh,$totalmoney)
        {
            $db = new database();
            $date = date_create("now");
            $datecreate = date_format($date,"Y-m-d");
            $query = "insert into hoadon(ID_Bill, ID_kh, Date_Create, Total_Money) values (NULL, $ID_kh, '$datecreate', $totalmoney)";
            $db->insertData($query);
            $ID_Bill = $db->getList("select ID_Bill from hoadon order by ID_Bill desc limit 1");
            return $ID_Bill[0];
        }
        public function insertOrderDetail($ID_hh, $ID_Size, $ID_Bill, $Amount, $Note, $Total_Price)
        {
            $db = new database();
            $query = "insert into detail_hoadon(ID_detail_hoadon, ID_hh, ID_Size, ID_Bill, Amount, Note, Total_Price) values (NULL, $ID_hh, $ID_Size, $ID_Bill, $Amount, '$Note', $Total_Price)";
            $db->insertData($query);
            $ID_Detail_Bill = $db->getList("select ID_detail_hoadon from detail_hoadon order by ID_detail_hoadon desc limit 1");
            return $ID_Detail_Bill[0];
        }
        public function insertToppingDetail($ID_detail_hoadon, $ID_Topping)
        {
            $db = new database();
            $query = "insert into detail_topping(ID_detail_hoadon, ID_Topping) values ($ID_detail_hoadon, $ID_Topping)";
            $db->insertData($query);
        }
        public function getOrder($ID_Bill)
        {
            $db = new database();
            $query = "select kh.ID_kh, kh.Name_kh, kh.address, r.Name_Rank, kh.phonenumber, kh.email, hd.Date_Create, hd.Total_Money, hd.ID_Bill 
            from khachhang kh 
            INNER join hoadon hd on kh.ID_kh = hd.ID_kh
            INNER join rank r on r.ID_Rank = kh.ID_Rank
            where hd.ID_Bill = $ID_Bill";
            $result = $db->getList($query);
            return $result;
        }
        public function getOrderDetail($ID_Bill) 
        {
            $db = new database();
            $query = "select hd.ID_detail_hoadon, hd.ID_hh, hh.Name_hh, hh.Sub_Name_hh, hh.Image, s.Name_Size, hd.Amount, hd.Note, hd.Total_Price
            from detail_hoadon hd
            INNER join hanghoa hh on hh.ID_hh = hd.ID_hh
            INNER join size s on s.ID_Size = hd.ID_Size
            where hd.ID_Bill = $ID_Bill";
            $result = $db->getList($query);
            return $result;
        }
        public function getToppingDetail($ID_detail_hoadon) 
        {
            $db = new database();
            $query = "select t.Name_Topping, t.Price
            from detail_topping dt
            INNER join topping t on t.ID_Topping = dt.ID_Topping
            where dt.ID_detail_hoadon = $ID_detail_hoadon";
            $result = $db->getList($query);
            return $result;
        }
        // not yet implemented
        public function editBill($ID_Bill,$ID_kh)
        {
            $db=new database();
            $edit = "update hoadon SET ID_kh='$ID_kh' WHERE ID_Bill = $ID_Bill";
            $db->insertData($edit);
        }
        public function delBill($ID_Bill)
        {
            $db=new database();
            $select = "select ID_detail_hoadon from detail_hoadon where ID_Bill = $ID_Bill";
            $list = $db->getList($select);
            foreach ($list as $item) {
                $this->delDetailBill($item["ID_detail_hoadon"]);
            }
            if (count($list) <= 0) {
                $del_bill = "delete from hoadon where ID_Bill = $ID_Bill";
                $db->deleteData($del_bill);
            }
        }
        //chưa xong
        public function editDetailBill($ID_detail_hoadon, $ID_Size, $Amount, $Note)
        {
            if ($Amount === 0) {
                $this->delDetailBill($ID_detail_hoadon);
            } else {
                $db=new database();
                $select1 = "select ID_Bill, ID_hh from detail_hoadon where ID_detail_hoadon = $ID_detail_hoadon";
                $data = $db->getList($select1)[0];
                $ID_Bill = $data['ID_Bill'];
                $ID_hh = $data['ID_hh'];
                $topping_price = "select sum(topping.Price) as Total_Price from topping, detail_topping where detail_topping.ID_detail_hoadon = $ID_detail_hoadon and detail_topping.ID_Topping = topping.ID_Topping";
                $ToppingPrice = $db->getList($topping_price)[0]['Total_Price'];
                $size_price = "select Price from hanghoa_size where ID_hh = $ID_hh and ID_Size = $ID_Size";
                $SizePrice = $db->getList($size_price)[0]['Price'];
                $Total_Price = ($SizePrice + ($ToppingPrice==null ? 0 : $ToppingPrice))*$Amount;
                $edit = "update detail_hoadon SET ID_Size=$ID_Size, Amount=$Amount, Note='$Note', Total_Price = $Total_Price  WHERE ID_detail_hoadon = $ID_detail_hoadon";
                $db->insertData($edit);
                $select2 = "select sum(Total_Price) as Total_Money from detail_hoadon where ID_Bill = $ID_Bill";
                $Total_Money = $db->getList($select2)[0]['Total_Money'];
                if (!empty($Total_Money)) {
                    $update = "update hoadon SET Total_Money=$Total_Money WHERE ID_Bill = $ID_Bill";
                    $db->insertData($update);
                } else {
                    $del_bill = "delete from hoadon where ID_Bill = $ID_Bill";
                    $db->deleteData($del_bill);
                }
            }
        }
        public function delDetailBill($ID_detail_hoadon)
        {
            $db=new database();
            $select1 = "select ID_Bill from detail_hoadon where ID_detail_hoadon = $ID_detail_hoadon";
            $ID_Bill = $db->getList($select1)[0]['ID_Bill'];
            $delete = "delete from detail_hoadon where ID_detail_hoadon = $ID_detail_hoadon; delete from detail_topping where ID_detail_hoadon = $ID_detail_hoadon; ";
            $db->deleteData($delete);
            $select2 = "select sum(Total_Price) as Total_Money from detail_hoadon where ID_Bill = $ID_Bill";
            $Total_Money = $db->getList($select2)[0]['Total_Money'];
            if (!empty($Total_Money)) {
                $update = "update hoadon SET Total_Money=$Total_Money WHERE ID_Bill = $ID_Bill";
                $db->insertData($update);
            } else {
                $del_bill = "delete from hoadon where ID_Bill = $ID_Bill";
                $db->deleteData($del_bill);
            }
        }
        public function thongke($quarter, $year)
        {
            $db = new database();
            $date = date_create("now");
            $now = date_format($date,"Y-m-d");
            $select = "select a.Name_hh, sum(b.Amount) as Amount, c.Date_Create
            from hanghoa a, detail_hoadon b, hoadon c
            where a.ID_hh = b.ID_hh and b.ID_Bill = c.ID_Bill 
            and year(c.Date_Create) = $year and QUARTER(c.Date_Create) = $quarter
            GROUP BY a.Name_hh";
            $result = $db->getList($select);
            return $result;
        }
    }
?>