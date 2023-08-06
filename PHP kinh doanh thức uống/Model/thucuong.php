<?php
    class thucuong{
        function __construct(){}
        public function getHangHoa($ID_hh)
        {
            //  case when hanghoa.ID_Group is not null then group_hanghoa.Name_Group end
            // and case when hanghoa.ID_Group is not null then hanghoa.ID_Group = group_hanghoa.ID_Group end
            $db=new database();
            $select="select hanghoa.*, hanghoa_size.ID_Size, size.Name_Size, hanghoa_size.Price, type.Name_Type, group_hanghoa.Name_Group
            from hanghoa, hanghoa_size, size, type, group_hanghoa
            where hanghoa.ID_hh = $ID_hh and hanghoa.ID_hh = hanghoa_size.ID_hh 
                and hanghoa_size.ID_Size = size.ID_Size and type.ID_Type = hanghoa.ID_Type 
                and hanghoa.ID_Group = group_hanghoa.ID_Group
            ORDER BY Price ASC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListType()
        {
            $db = new database();
            $select = "select * from type";
            $result = $db->getList($select);
            return $result;
        }
        public function getListGroup()
        {
            $db = new database();
            $select = "select * from group_hanghoa";
            $result = $db->getList($select);
            return $result;
        }
        public function getListTopping($ID_hh)
        {
            $db=new database();
            $select = "select hanghoa_topping.*, topping.Name_Topping, topping.Price 
            from topping, hanghoa_topping
            where hanghoa_topping.ID_hh = $ID_hh and hanghoa_topping.ID_Topping = topping.ID_Topping
            ORDER BY hanghoa_topping.ID_Topping ASC";
            $result=$db->getList($select);
            return $result;
        }
        public function getTopping()
        {
            $db=new database();
            $select = "select * from topping";
            $result=$db->getList($select);
            return $result;
        }
        public function getListSize($ID_hh)
        {
            $db=new database();
            $select = "select hanghoa_size.*, size.Name_Size 
            from size, hanghoa_size
            where hanghoa_size.ID_hh = $ID_hh and hanghoa_size.ID_Size = size.ID_Size
            ORDER BY hanghoa_size.Price ASC";
            $result=$db->getList($select);
            return $result;
        }
        public function getSize()
        {
            $db=new database();
            $select = "select size.* from size";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa($ID_Type)
        {
            $db=new database();
            $select="select hanghoa.*, MIN(hanghoa_size.Price) as Price
            from hanghoa, hanghoa_size
            where hanghoa.ID_hh = hanghoa_size.ID_hh and hanghoa.ID_Type = $ID_Type
            GROUP BY hanghoa.ID_hh
            ORDER BY ID_Group ASC, Date_Create DESC, Price DESC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa_all()
        {
            $db=new database();
            $select="select hanghoa.*, MIN(hanghoa_size.Price) as Price, type.Name_Type
            from hanghoa, hanghoa_size, type
            where hanghoa.ID_hh = hanghoa_size.ID_hh and hanghoa.ID_Type = type.ID_Type
            GROUP BY hanghoa.ID_hh
            ORDER BY ID_Group ASC, Date_Create DESC, Price DESC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa_thucuong()
        {
            $db=new database();
            $select="select hanghoa.*, MIN(hanghoa_size.Price) as Price
            from hanghoa, hanghoa_size, type
            where hanghoa.ID_hh = hanghoa_size.ID_hh and hanghoa.ID_Type = type.ID_Type and type.Name_Type like 'Thức uống'
            GROUP BY hanghoa.ID_hh
            ORDER BY ID_Group ASC, Date_Create DESC, Price DESC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa_snacks()
        {
            $db=new database();
            $select="select hanghoa.*, MIN(hanghoa_size.Price) as Price
            from hanghoa, hanghoa_size, type
            where hanghoa.ID_hh = hanghoa_size.ID_hh and hanghoa.ID_Type = type.ID_Type and type.Name_Type like 'Snacks'
            GROUP BY hanghoa.ID_hh
            ORDER BY ID_Group ASC, Date_Create DESC, Price DESC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa_bakery()
        {
            $db=new database();
            $select="select hanghoa.*, MIN(hanghoa_size.Price) as Price
            from hanghoa, hanghoa_size, type
            where hanghoa.ID_hh = hanghoa_size.ID_hh and hanghoa.ID_Type = type.ID_Type and type.Name_Type like 'bakery'
            GROUP BY hanghoa.ID_hh
            ORDER BY ID_Group ASC, Date_Create DESC, Price DESC";
            $result=$db->getList($select);
            return $result;
        }
        public function getListHangHoa_Size($ID_hh){
            $db=new database();
            $select="select * from hanghoa_size where ID_hh=$ID_hh";
            $result=$db->getList($select);
            return $result;
        }
        public function addProduct($Name_hh,$Sub_Name_hh,$Image,$ID_Group,$ID_Type,$price_size,$ID_Topping_List) {
            $db = new database();
            $date=new DateTime('now');
            $Date_Create=$date->format("Y-m-d");
            $insert = "insert INTO `hanghoa` (`ID_hh`, `Name_hh`, `Sub_Name_hh`, `Image`, `ID_Group`, `ID_Type`, `Date_Create`, `Amount`)
            VALUES (NULL, '$Name_hh', '$Sub_Name_hh', '$Image', '$ID_Group', '$ID_Type', '$Date_Create', NULL)";
            $success = $db->insertData($insert);
            if ($success) {
                $ID_hh = $db->LastInsertId("ID_hh");
                foreach ($price_size as $size=>$price) {
                    if (!empty($price)) {
                        $insert = "insert INTO `hanghoa_size` (`ID_hh`, `ID_Size`, `Price`) VALUES ('$ID_hh', '$size', '$price')";
                        $db->insertData($insert);
                    }
                }
                foreach ($ID_Topping_List as $ID_Topping) {
                    if (!empty($ID_Topping)) {
                        $insert = "insert INTO `hanghoa_topping` (`ID_hh`, `ID_Topping`) VALUES ('$ID_hh', '$ID_Topping')";
                        $db->insertData($insert);
                    }
                }
            }
            return $success;
        }
        public function deleteProduct($ID_hh) {
            $db = new database();
            $delete = "update hanghoa SET Deleted=1 where ID_hh = $ID_hh";
            $db->insertData($delete);
        }
        public function editProduct($ID_hh,$Name_hh,$Sub_Name_hh,$ID_Group,$ID_Type,$price_size,$ID_Topping_List) {
            $db = new database();
            $edit = "update hanghoa SET Name_hh='$Name_hh', Sub_Name_hh='$Sub_Name_hh', ID_Group='$ID_Group', ID_Type='$ID_Type' WHERE ID_hh = $ID_hh";
            $success = $db->insertData($edit);
            if (true) {
                $delete = "delete from hanghoa_size where ID_hh = $ID_hh;delete from hanghoa_topping where ID_hh = $ID_hh;";
                $db->deleteData($delete);
                foreach ($price_size as $size=>$price) {
                    if (!empty($price)) {
                        $insert = "insert INTO `hanghoa_size` (`ID_hh`, `ID_Size`, `Price`) VALUES ('$ID_hh', '$size', '$price')";
                        $db->insertData($insert);
                    }
                }
                foreach ($ID_Topping_List as $ID_Topping) {
                    if (!empty($ID_Topping)) {
                        $insert = "insert INTO `hanghoa_topping` (`ID_hh`, `ID_Topping`) VALUES ('$ID_hh', '$ID_Topping')";
                        $db->insertData($insert);
                    }
                }
            }
            return $success;
        }
    }
?>